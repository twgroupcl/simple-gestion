<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class Product extends Component
{
    public $product;
    public $currentPrice;
    // public $data = [];

    protected $listeners = [
        'addToCart'=> 'addToCart'
    ];

    public function render()
    {
        return view('livewire.pos.product');
    }

    public function mount()
    {
        $this->currentPrice = $this->getCurrentPrice();
    }

    public function shareProductInModal()
    {
        if (! $this->productHasConfigurableDetail()) {
            $this->addToCart();
            return;
        }

        $this->emitTo(
            'pos.product-custom-attributes', 'productShared',
            $this->product->id,
            $this->currentPrice
        );
    }

    public function productHasConfigurableDetail()
    {
        return $this->product->product_type->id == 2;
    }

    public function addToCart()
    {
        $this->emit('add-product-cart:post', $this->product->id);
    }

    public function getCurrentPrice()
    {
        return $this->product
                    ->children
                    ->pluck('real_price')
                    ->sort()
                    ->first() ?? $this->product->price;
    }
}
