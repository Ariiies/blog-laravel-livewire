<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class PostDetail extends Component
{
   public Post $post;
    
    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)
                         ->where('is_published', true)
                         ->whereNotNull('published_at')
                         ->firstOrFail();
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
          
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
