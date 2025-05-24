<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;

class ShowPost extends Component
{
    public $post;
    public function mount(){
        $this->post = Post::findOrFail(150);
    }
    
    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
