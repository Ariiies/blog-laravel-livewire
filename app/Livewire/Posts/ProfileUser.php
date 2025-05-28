<?php

namespace App\Livewire\Posts;

use Livewire\Component;

class ProfileUser extends Component
{
    public $user, $name, $email;

    public function mount($id)
    {
        $this->user = \App\Models\User::find($id);
        if (is_null($this->user)) {
            return redirect()->route('home')->with('error', 'User not found.');
        }
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile(): object {
        
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

    public function render(): object {

        return view('livewire.posts.profile-user');
    }
}
