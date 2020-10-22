<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class Details extends Component
{
    public function render()
    {
        return view('livewire.checkout.details');
    }

    function prevStep(){
        $this->emitUp('prev-step');
    }
    function nextStep(){
        $this->emitUp('next-step');
    }
}
