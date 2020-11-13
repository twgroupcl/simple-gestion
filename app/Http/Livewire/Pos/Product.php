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


    public function addToCart()
    {

        dd('ok');
       // $this->emitUp('add-product-cart',$this->product);
    }
}
