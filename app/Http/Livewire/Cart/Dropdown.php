<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class Dropdown extends Component
{
    public $cart;
    public $items;
    
    protected $listeners = [
        'dropdown.update' => 'update',
        'deleteItem' => 'deleteItem'
    ];

    public function update()
    {
        $this->cart = Cart::getInstance(null,session());
        $this->items = $this->cart->cart_items;
        $this->emitTo('cart.item', 'cart-item.updateQty');
        $this->emit('cart.updateSubtotal');
    }

    public function deleteItem()
    {
        $this->update();
        $this->emit('cart-counter:decrease');
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
