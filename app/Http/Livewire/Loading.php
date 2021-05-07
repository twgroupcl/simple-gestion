<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Loading extends Component
{

    protected $listeners = [
        'set.loading' => 'loading',

    ];

    public function render()
    {
        return view('livewire.loading');
    }

    public function loading()
    {
        // Do Nothing
    }
}
