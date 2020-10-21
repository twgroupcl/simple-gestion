<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use \Illuminate\Session\SessionManager;
use Livewire\Component;

class CartCounter extends Component
{
    public $count;
    public $cart;

    protected $listeners = [
        'cart-counter:increment' => 'increment',
        'cart-counter:decrease' => 'decrease',
    ];

    public function mount()
    {
        $this->cart = $this->getCart();
        $this->count = $this->cart->items_count ? $this->cart->items_count : 0;
    }


    public function increment()
    {
        $this->count++;
        $this->cart = $this->getCart();
        $this->cart->items_count = $this->count;
        $this->cart->update();
    }

    public function decrease()
    {
        $this->count--;
        $this->cart = $this->getCart();
        $this->cart->items_count = $this->count;
        $this->cart->update();
    }

    public function render(SessionManager $s)
    {
        return view('livewire.cart.counter');
    }

    private function getCart(): Cart
    {
        $session = session()->getId();
        $user = auth()->check() ? auth()->user() : null;
        $cart = Cart::getInstance($user, $session);

        return $cart;
    }
}
