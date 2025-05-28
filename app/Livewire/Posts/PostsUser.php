<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class PostsUser extends Component
{
    
    public function render()
    {
        // Aquí podrías cargar los posts del usuario autenticado si es necesario
        $posts = Post::where('user_id', auth()->id())
            ->latest('published_at')
            ->paginate(12);
        return view('livewire.posts.posts-user', compact('posts'));
    }
}
