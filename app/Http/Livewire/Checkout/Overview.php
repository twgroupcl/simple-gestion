<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class Overview extends Component
{
    public $cart;
    public $shippingMethod;

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->shippingMethod = $this->cart->getShippingMethod();
    }
    
    public function render()
    {
        return view('livewire.checkout.overview');
    }
}
