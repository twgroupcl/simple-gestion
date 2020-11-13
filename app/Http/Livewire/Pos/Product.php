<?php

namespace App\Http\Livewire\Pos;

use Livewire\Component;

class Product extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.pos.product');
    }
}
