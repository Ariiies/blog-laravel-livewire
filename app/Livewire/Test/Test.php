<?php

namespace App\Livewire\Test;

use Livewire\Component;
use App\Models\User;

class Test extends Component
{
    public $name, $email;
    
/*
    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
    }*/

    public function check(){

    }

    public function render()
    {
        return view('livewire.test.test');
    }
}
