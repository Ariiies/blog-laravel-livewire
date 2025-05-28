<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;

    public Post $post;
    public $categories;
    public $title, $slug, $body, $category_id, $excerpt, $image_path, $is_published, $tags, $image, $previewUrl;

    public $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:posts,slug',
        'body' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'excerpt' => 'nullable|string|max:255',
        'image' => 'nullable',
        'is_published' => 'boolean',
        'tags' => 'nullable|string',
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
        $this->image = $this->post->image_path;
        $this->previewUrl = $this->image_path ? Storage::url($this->image_path) : null;
        $this->tags = $this->post->tags->pluck('name')->implode(', ');
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable',
        ]);

        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $this->previewUrl = 'data:image/' . $this->image->extension() . ';base64,' . base64_encode(file_get_contents($this->image->getRealPath()));
        } else {
            $this->previewUrl = $this->image_path ? Storage::url($this->image_path) : null;
        }
    }

    public function removeImage()
    {
        $this->image = null;
        $this->image_path = null;
        $this->previewUrl = null;
    }

    public function updatePost()
    {
        // Validar los datos
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($this->post->id)],
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string|max:255',
            'image' => 'nullable',
            'is_published' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        // Almacenar la ruta de la imagen antigua para eliminarla si es necesario
        $oldImagePath = $this->post->image_path;

        // Manejar la imagen
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            // Subir la nueva imagen
            $this->image_path = $this->image->store('images', 'public');
            $this->previewUrl = Storage::url($this->image_path);
        } elseif ($this->image === null) {
            // Si se quitó la imagen
            $this->image_path = null;
            $this->previewUrl = null;
        }

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

        // Eliminar la imagen antigua si existía y fue reemplazada o quitada
        if ($oldImagePath && ($this->image_path !== $oldImagePath || $this->image_path === null)) {
            Storage::disk('public')->delete($oldImagePath);
        }

        // Manejar las etiquetas
        if ($this->tags) {
            $tagNames = array_map('trim', explode(',', $this->tags));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
            $this->post->tags()->sync($tagIds);
        } else {
            $this->post->tags()->detach();
        }

        session()->flash('swal', ['icon' => 'success', 'title' => 'Post updated successfully.']);
        return redirect()->route('post.show', $this->post->slug);
    }

    public function render()
    {
        return view('livewire.posts.edit-post', [
            'imageUrl' => $this->previewUrl ?? 'https://dicesamexico.com.mx/wp-content/uploads/2021/06/no-image.jpeg',
        ]);
    }
}
?>