<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Str;

class CreatePost extends Component
{
    public $title, $body, $excerpt, $slug, $image_path, $tags, $is_published = false;
    public $image;
    public $category_id;
    public $categories = [];
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'body' => 'required|min:5',
        'excerpt' => 'required|string|max:255',
        'slug' => 'required|alpha_dash|unique:posts,slug',
        'image_path' => 'nullable|url',
        'tags' => 'nullable|string|max:255',
        'is_published' => 'boolean',
        'category_id' => 'required|exists:categories,id'
    ];

    protected $messages = [
        'title.required' => 'El título es obligatorio',
        'body.required' => 'El contenido del post es obligatorio',
        'slug.unique' => 'Este slug ya está en uso',
        'image_path.url' => 'Debe ser una URL válida',
        'category_id.required' => 'La categoría es obligatoria',
        'category_id.exists' => 'La categoría seleccionada no existe'
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->slug = Str::slug($this->title ?? '');
    }

    public function addPost()
    {
        $this->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:5',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|alpha_dash|unique:posts,slug',
            'image_path' => 'nullable|url',
            'tags' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'category_id' => 'required|exists:categories,id'
        ]);
 
        $tagsArray = $this->tags ? explode(',', $this->tags) : [];
        $tagsArray = array_map('trim', $tagsArray);
        $tagsArray = array_filter($tagsArray);

        $post = Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'excerpt' => $this->excerpt,
            'slug' => $this->slug,
            'image_path' => $this->image_path,
            'is_published' => $this->is_published,
            'user_id' => auth()->id(),
            'category_id' => $this->category_id
        ]);

        if (!empty($tagsArray)) {
            $tagIds = [];
            foreach ($tagsArray as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower($tagName)]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }

        $this->reset([
            'title', 'body', 'excerpt', 'slug', 'image_path', 'tags', 'is_published', 'category_id'
        ]);

        session()->flash('swal', ['icon' => 'success', 'title' => 'Post created successfully.']);
        return redirect()->route('home');
    }
    
    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
