<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use App\Models\Seller;
use Livewire\Component;

class ListProducts extends Component
{
    public $products;
    public $seller;

    public function render()
    {
        return view('livewire.pos.list-products');
    }

    public function mount(Seller $seller)
    {
        $this->seller = $seller;
        $this->products = $this->getProducts();
    }

    public function getProducts()
    {
        return Product::whereSellerId($this->seller->id)->get();
    }
}
