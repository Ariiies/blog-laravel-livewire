<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostDetail extends Component
{
   public Post $post;
   public $relatedposts;
    
    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)
                         ->where('is_published', true)
                         ->whereNotNull('published_at')
                         ->firstOrFail();

        
        $this->relatedposts = Post::where('id', '!=', $this->post->id)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->whereHas('tags', function ($query) {
            $query->whereIn('tags.id', $this->post->tags->pluck('id'));
            })
            ->latest('published_at')
            ->take(4)
            ->get();
        }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);

        // Eliminar la imagen asociada si existe
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
          
        // Delete the post
        $post->delete();
        
        session()->flash('swal', ['icon' => 'success', 'title' => 'Post Deleted successfully.']);
        
        // Redirect to the posts list or another appropriate page
        return redirect()->route('home');

    }
    
    public function render()
    {
        return view('livewire.posts.post-detail');
    }
}
