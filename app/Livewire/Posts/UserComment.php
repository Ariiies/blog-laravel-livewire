<?php

namespace App\Livewire\Posts;

use Livewire\Component;

class UserComment extends Component
{
    public $post;
    public $user;
    public $userFirstName;
    public $body;

    public function mount($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
        if (!is_null($this->user)) {
           $this->userFirstName = explode(' ', $user->name)[0] ?? 'User'; // Get the first name or default to 'User'
        } else {
            $this->userFirstName = ''; // Default value if user is null
        }
        
    }   

    public function addComment()
    {
        $this->validate([
            'body' => 'required|string|max:500',
        ]);

        $this->post->comments()->create([
            'user_id' => $this->user->id,
            'body' => $this->body,
            'post_id' => $this->post->id
        ]);

        $this->body = ''; // Clear the comment input after submission

        $this->dispatch('commentAdded'); // Dispara el evento para el listener
    }

    public function render()
    {
        return view('livewire.posts.user-comment');
    }
}
