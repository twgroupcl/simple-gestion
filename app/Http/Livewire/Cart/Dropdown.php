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
        'deleteItem'
    ];

    public function update()
    {

        $this->cart = $this->getCart();
        $this->items = CartItem::whereCartId($this->cart->id)->get();
        $this->emitTo('cart.item', 'cart-item.updateQty');
    }

    public function deleteItem()
    {
        $this->emit('cart.updateSubtotal');
    }

    public function mount()
    {
        $this->cart = $this->getCart();
        $this->items = $this->cart->cart_items;
    }

    public function render()
    {
        return view('livewire.cart.dropdown');
    }

    private function getCart()
    {
        $session = session()->getId();
        $user = auth()->check() ? auth()->user() : null;
        return Cart::getInstance($user, $session);
    }
}
