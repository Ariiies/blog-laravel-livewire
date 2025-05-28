<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    public $post;
    //public $comments;
    protected $listeners = ['commentAdded' => 'updateComments'];
    public function updateComments()
    {
        $this->resetPage(); 
    }
    public function mount($post)
    {
        //$this->comments = $this->post->comments()->latest()->get();
    }
    public function render()
    {
        $comments = $this->post->comments()->latest()->paginate(3);
        return view('livewire.posts.comments', compact('comments'));
    }
}
