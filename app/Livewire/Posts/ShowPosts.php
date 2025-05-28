<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ShowPosts extends Component
{
    use WithPagination;
    #[Url(as:'s')]
    public $search='';
    
    
    public function render()
    {
        $posts = Post::where('is_published', true)
                          ->whereNotNull('published_at')
                          ->latest('published_at')
                          ->when($this->search, fn ($query) => $query->where('title', 'like', '%' . $this->search . '%'))
                          ->paginate(12);
        return view('livewire.posts.show-posts', compact('posts'));
    }
}