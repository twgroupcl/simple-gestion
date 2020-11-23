<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class Product extends Component
{
    public $product;

    protected $listeners = [
        'addToCart'=> 'addToCart'
    ];

    public function render()
    {
        return view('livewire.pos.product');
    }

    public function shareProductInModal()
    {
        $attributes = $this->product->getAttributesWithNames();
        if (filled($attributes)) {
            $this->emitTo('pos.product-custom-attributes', 'productShared', $this->product, $attributes);
        }
    }

    public function addToCart()
    {
        $this->emit('add-product-cart:post',$this->product->id);
    }
}
