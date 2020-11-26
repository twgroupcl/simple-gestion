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
        if (! $this->productHasConfigurableDetail()) {
            $this->addToCart();
            return;
        }

        $attributes = $this->product->getAttributesWithNames();
        $this->emitTo('pos.product-custom-attributes', 'productShared', $this->product, $attributes);
    }

    public function productHasConfigurableDetail()
    {
        return $this->product->product_type->id == 2;
    }

    public function addToCart()
    {
        $this->emit('add-product-cart:post',$this->product->id);
    }
}
