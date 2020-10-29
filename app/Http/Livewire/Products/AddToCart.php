<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Barryvdh\Debugbar\Facade as Debugbar;

class AddToCart extends Component
{
    public $view = 'standard';
    public $product;
    public $qty;

    protected $listeners = [
        'addtocart.cant' => 'cant',
        'addToCart.setProduct' => 'setProduct',
    ];

    protected $rules = [
        'qty' => 'numeric|gte:1|lte:16000000',
    ];

    protected $messages = [
        'gte' => 'La cantidad mayor o igual a 1.',
        'lte' => 'La cantidad supera el límite',
        'integer' => 'El campo debe ser un entero.'
    ];

    public function setProduct(Product $prod)
    {
        $this->product = $prod;
    }

    public function cant($cant)
    {
        $this->qty = $cant;
    }

    public function addToCart()
    {

        $this->validate();

        $this->emit('cart:add', $this->product, $this->qty);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart.' . $this->view);
    }
}
