<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.flash-message');
    }
}
