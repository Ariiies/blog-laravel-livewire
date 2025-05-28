<?php

namespace App\Livewire\Posts;

use Livewire\Component;

class ProfileUser extends Component
{
    public $user, $name, $email;

    public function mount($id)
    {
        $this->user = \App\Models\User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $this->user->id,
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('swal', ['icon' => 'success', 'title' => 'Profile updated successfully.']);
        return redirect()->route('user.profile', ['id' => $this->user->id]);
    }

    public function render()
    {

        return view('livewire.posts.profile-user');
    }
}
