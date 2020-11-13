<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class Cart extends Component
{
    public $products;
    protected $listeners = [
        'add-product-cart' => 'addProduct'
    ];
    public function render()
    {
        return view('livewire.pos.cart');
    }

    public function addProduct($product)
    {

      //  $this->products->add($product);
    }
}
