<?php

namespace App\Http\Livewire\Pos\Cart;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $products;
    protected $listeners = [
        'add-product-cart:post' => 'addProduct'
    ];

    public function mount()
    {
        $this->products = [];
    }
    public function render()
    {
        return view('livewire.pos.cart.cart');
    }

    public function addProduct($productId)
    {
        if (in_array($productId, $this->products)) {
            return;
        }

        array_push($this->products,$productId);

    }
}
