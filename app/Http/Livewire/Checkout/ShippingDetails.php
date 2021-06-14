<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;

class ShippingDetails extends Component
{
    public $shippingMethod;
    public $cart;
    public $data;
    public $picking;
    public $invoice;
    public $requiredInvoice;

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->shippingMethod = $this->cart->getShippingMethod();
    }

    public function render()
    {
        return view('livewire.checkout.shipping-details');
    }
}
