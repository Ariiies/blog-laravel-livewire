<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(12);
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

        //return $request->all();

        Post::create($request->all());
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
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'image_path' => 'nullable|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string|max:255',
            'is_published' => 'boolean'
        ]);

        $data = $request->except('user_id');
        $post->update($data);
        session()->flash('swal', ['icon' => 'success', 'title' => 'Post updated successfully.']);
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
