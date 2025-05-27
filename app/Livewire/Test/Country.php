<?php

namespace App\Livewire\Test;

use Livewire\Component;

class Country extends Component
{
    public $countries = [
        'Brazil',
        'Uruguay',
        'Argentina',
    ];
    public $pais;
    public $active;
    public $count=0;
    public $show= true;
    public function add()
    {
    $this->validate([
        'pais' => 'required|string|min:2|max:50',
    ]);

    if (in_array($this->pais, $this->countries)) {
        $this->addError('pais', 'The country already exists in the list.');
        return;
    }

        array_push($this->countries, $this->pais);
        $this->pais = ''; // Reset the input field after adding
    }


    public function remove($country)
    {
        $this->countries = array_filter($this->countries, function ($c) use ($country) {
            return $c !== $country;
        });
    }

    public function changeActive($country)
    {
        $this->active = $country;
    }

    public function incrementCount()
    {
        $this->count++;
    }
    public function mount()
    {
        //.
    }

    public function render()
    {
        return view('livewire.test.country');
    }
}
