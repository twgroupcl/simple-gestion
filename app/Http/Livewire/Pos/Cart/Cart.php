<?php

namespace App\Http\Livewire\Pos\Cart;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $products;
    protected $listeners = [
        'add-product-cart:post' => 'addProduct',
        'remove-from-cart:post' => 'remove',
    ];

    public function mount()
    {
        $this->products = [];
    }
    public function render()
    {
        return view('livewire.pos.cart.cart');
    }

    public function addProduct($product)
    {
        $this->products[$product['id']] = $product['id'];
    }

    public function remove($productId)
    {
        unset($this->products[$productId]);
    }
}
