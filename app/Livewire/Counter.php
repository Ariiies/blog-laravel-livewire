<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
     public $count = 0;
 
    public function increment($amout)
    {
        $this->count += $amout;
    }
     

    public function decrement()
    {
        $this->count--;
    }
    public function resetCount()
    {
        $this->count = 0;
    }

    public function render()
    {

        return view('livewire.counter');
    }
}
