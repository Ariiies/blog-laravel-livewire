<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.posts.show-posts', [
            'posts' => Post::where('is_published', true)
                          ->whereNotNull('published_at')
                          ->latest('published_at')
                          ->paginate(12)
        ]);
    }
}