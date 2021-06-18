<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Http\Livewire\Checkout\Shipping;

class Overview extends Component
{
    public $cart;
    public $shippingMethod;
    public $step; 

    /*  protected $listeners = [
        'shipping-update' => 'calculateShipping',
    ]; */

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->shippingMethod = $this->cart->getShippingMethod();
    }
    
    public function render()
    {
        return view('livewire.checkout.overview');
    }

    /* public function calculateShipping()
    {
        $shippingComponent = New Shipping($this->cart, $this->step);

         $shippingComponent->mount($this->cart, $this->step);

        $shippings = $shippingComponent->updateSellersShippings();
        
        $this->emitUp('update-shipping-totals', $shippings);
    } */
}
