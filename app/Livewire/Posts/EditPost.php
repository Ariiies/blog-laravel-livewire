<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class EditPost extends Component
{
    use WithFileUploads;

    public Post $post;
    public $categories;
    public $title, $slug, $body, $category_id, $excerpt, $image_path, $is_published, $tags;

   public $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:posts,slug',
        'body' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'excerpt' => 'nullable|string|max:255',
        'image_path' => 'nullable', // 1MB Max
        'is_published' => 'boolean',
    ];

    public function mount($slug)
{
    $this->post = Post::where('slug', $slug)->firstOrFail();
    $this->categories = Category::all();
    $this->title = $this->post->title;
    $this->slug = $this->post->slug;
    $this->body = $this->post->body;
    $this->category_id = $this->post->category_id;
    $this->excerpt = $this->post->excerpt;
    $this->image_path = $this->post->image_path;
    $this->is_published = $this->post->is_published;
    
    // Inicializar tags como una cadena separada por comas
    $this->tags = $this->post->tags->pluck('name')->implode(', ');
}
    
    public function updatePost()
{
    // Modificar la regla de validación del slug para ignorar el post actual
    $this->validate([
        'title' => 'required|string|max:255',
        'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($this->post->id)],
        'body' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'excerpt' => 'nullable|string|max:255',
        'image_path' => 'nullable',
        'is_published' => 'boolean',
        'tags' => 'nullable|string', // Validar que tags sea una cadena
    ]);

    // Actualizar el post
    $this->post->update([
        'title' => $this->title,
        'body' => $this->body,
        'slug' => $this->slug,
        'category_id' => $this->category_id,
        'excerpt' => $this->excerpt,
        'image_path' => $this->image_path,
        'is_published' => $this->is_published,
    ]);

    // Manejar las etiquetas
    if ($this->tags) {
        // Convertir la cadena de tags (separada por comas) en un array
        $tagNames = array_map('trim', explode(',', $this->tags));
        $tagIds = [];

        // Buscar o crear cada etiqueta y obtener sus IDs
        foreach ($tagNames as $tagName) {
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        // Sincronizar las etiquetas con el post
        $this->post->tags()->sync($tagIds);
    } else {
        // Si no hay tags, desvincular todas las etiquetas
        $this->post->tags()->detach();
    }

    session()->flash('swal', ['icon' => 'success', 'title' => 'Post updated successfully.']);
    return redirect()->route('post.show', $this->post->slug);
}

        
        

    public function render()
    {
        return view('livewire.posts.edit-post');
    }
}
