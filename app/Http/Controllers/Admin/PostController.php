<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ResizeImage;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\image\laravel\Facades\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [Middleware::class => ['auth', 'can:manage posts']];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        
        if(isset($data['only_mine'])) {
            $posts = Post::orderBy('id', 'desc')
            ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->paginate(12);
        return view('admin.posts.index', compact('posts'));
        }
            
        $posts = Post::orderBy('id', 'desc')
        ->paginate(12);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'image_path' => 'nullable|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'excerpt' => 'nullable|string|max:255',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();

        if (!empty($data['is_published']) && $data['is_published']) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('image')) {
        if ($data['image_path']) {
            Storage::delete($data['image_path']);
        }
        $extension = $request->image->extension();
        $filename = $data['slug'] . '.' . $extension;
        while(Storage::exists('posts/' . $filename)) {
            $filename = str_replace('.' . $extension, '-copia'.$extension, $filename);
            }
        $data['image_path'] = Storage::putFileAs('posts', $request->file('image'), $filename);  
        ResizeImage::dispatch($data['image_path']);      
        }

        if ($data['image_path'] == 'delete' || $data['image_path'] == "") {
            $data['image_path'] = null;
            }
        //return $data;
        Post::create($data);
        $posts = Post::orderBy('id', 'desc')->paginate(12);
        session()->flash('swal', ['icon' => 'success', 'title' => 'Post created successfully.']);
        return redirect()->route('posts.index', compact('posts'))
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post){

        $post = Post::find($post->id);
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post){
        // Gate para autorizar la edicion solo de posts publicados por el autor
        //Gate::authorize('author', $post);
      
         $tags = $post->tags->pluck('id')->toArray();
         
        $categories = \App\Models\Category::all();
        $tags = Tag::all();
             
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
   
        

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image_path' => 'nullable|max:255',
        'body' => 'required|string',
        'slug' => [
            Rule::requiredIf(function () use ($post) {
                return !$post->published_at;
            }),
            'string',
            'max:255',
            'unique:posts,slug,' . $post->id,
        ],
        'tags' => 'nullable|array',
        'category_id' => 'required|exists:categories,id',
        'excerpt' => 'nullable|string|max:255',
        'is_published' => 'boolean',
        'published_at' => 'nullable|date',
        'image' => 'nullable|image|max:2048', // Validación para la imagen
    ]);


    $data = $request->except('user_id');
   
    // Manejar is_published y published_at
    if (isset($data['is_published'])) {
        $data['is_published'] = filter_var($data['is_published'], FILTER_VALIDATE_BOOLEAN);
        // Solo asignar published_at si no está presente en la solicitud
        if (!isset($data['published_at'])) {
            $data['published_at'] = $data['is_published'] ? now() : null;
        }
    }
    if ($request->hasFile('image')) {
        if ($post->image_path) {
            Storage::delete($post->image_path);
        }
        $extension = $request->image->extension();
        $filename = $post->slug . '.' . $extension;
        while(Storage::exists('posts/' . $filename)) {
            $filename = str_replace('.' . $extension, '-copia'.$extension, $filename);
            } 

        $data['image_path'] = Storage::putFileAs('posts', $request->file('image'), $filename);
        ResizeImage::dispatch($data['image_path']);
            /* //para redimensionar la imagen
        $upload = $request->file('image');
        $image = Image::read($upload)
        ->scale(1200)
        ->encodeByExtension($upload->getClientOriginalExtension(), quality: 75);
        Storage::put('posts/' . $filename, (string) $image, 'public');
        $data['image_path'] = 'posts/' . $filename;
        */
    }
    
    if ($data['image_path'] == 'delete') {
        if (isset($data['current_image_path']) && $data['current_image_path']) {
            Storage::delete($data['current_image_path']);
        }
        $data['image_path'] = null;
    }
    
    $post->update($data);

    // Sincronizar tags
    $tags = [];
    foreach ($request->tags ?? [] as $tag) {
        $tags[] = Tag::firstOrCreate(['name' => $tag])->id;
    }
    $post->tags()->sync($tags);

    session()->flash('swal', ['icon' => 'success', 'title' => 'Post updated successfully.']);
    return redirect()->route('posts.index')
        ->with('success', 'Post updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Gate para autorizar la eliminacion solo de posts publicados por el autor
        //Gate::authorize('author', $post);
        if ($post->image_path) {
            Storage::delete($post->image_path);
        }
        $post->delete();
        session()->flash('swal', ['icon' => 'success', 'title' => 'Post deleted successfully.']);
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
