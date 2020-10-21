<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class Shipping extends Component
{
    public function render()
    {
        return view('livewire.checkout.shipping');
    }

    function prevStep(){
        $this->emitUp('prev-step');
    }
    function nextStep(){
        $this->emitUp('next-step');
    }
}
