<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use Livewire\Component;

class Dropdown extends Component
{
    public $cart;
    public $items;
    
    protected $listeners = [
        'dropdown.update' => 'update'
    ];

    public function update()
    {
        $this->cart = Cart::getInstance(null,session());
        $this->items = $this->cart->cart_items;
    }

    public function mount()
    {
        $this->cart = Cart::getInstance(null,session());
        $this->items = $this->cart->cart_items;
    }

    public function render()
    {
        return view('livewire.cart.dropdown');
    }
}
