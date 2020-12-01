<?php

namespace App\Http\Livewire\Pos\Cart;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $products;
    public $subtotal = 0;
    public $discount = 0;
    public $total = 0;
    public $qty = [];
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

    public function addProduct(Product $product)
    {
        isset($this->products[$product->id]['qty'])
            ? $this->products[$product->id]['qty'] += 1
            : $this->products[$product->id]['qty'] = 1;

        $this->products[$product->id]['product'] = $product;
        $this->calculateAmounts();
    }

    public function remove($productId)
    {
        unset($this->products[$productId]);
        $this->calculateAmounts();
    }

    public function calculateAmounts()
    {
        $this->subtotal = collect($this->products)->sum(function ($product) {
            return $product['product']['price'] * $product['qty'];
        });

        $this->total = $this->subtotal - $this->discount;
    }
}
