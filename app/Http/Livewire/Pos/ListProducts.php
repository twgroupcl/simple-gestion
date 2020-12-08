<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use App\Models\Seller;
use Livewire\Component;

class ListProducts extends Component
{
    public $products;
    public $seller;

    public $listeners = [
        'searchProduct' => 'filterProduct',
    ];

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
        return Product::where('status','=','1')
                        ->where('is_approved','=','1')
                        ->where('parent_id', '=', null)
                        ->whereSellerId($this->seller->id)
                        ->get();
    }

    public function filterProduct(string $name)
    {
        $this->products = Product::where('status','=','1')
                            ->where('is_approved','=','1')
                            ->where('parent_id', '=', null)
                            ->whereSellerId($this->seller->id)
                            ->where('name', 'LIKE', '%'.$name.'%')
                            ->get();
    }
}
