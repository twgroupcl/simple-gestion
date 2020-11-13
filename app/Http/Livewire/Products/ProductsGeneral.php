<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductsGeneral extends Component
{
    public $idCategory;

    public function render()
    {
        return view('livewire.products.short-list')->with('productsShort', $this->getProducts($this->idCategory));
    }

    public function mount($idCategory)
    {
        $this->idCategory = $idCategory;
    }
    
    public function getProducts($idCategory)
    {
        return Product::where('status','=','1')
        ->where('is_approved','=','1')
        ->where('parent_id', '=', null)
        ->whereHas('categories', function ($query) use ($idCategory) {
            $query->where('id', $idCategory);
        })
        ->limit(5)->inRandomOrder()->get();
    }

}
