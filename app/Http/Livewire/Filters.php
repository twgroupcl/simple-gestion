<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\ProductBrand;

class Filters extends Component
{

    public $categories;
    public $brands;

    public function render()
    {
        return view('livewire.filters');
    }

    public function mount()
    {
        $this->loadCategories();
        $this->loadBrands();
    }

    public function loadBrands() 
    {
        $this->brands = ProductBrand::where('status','=','1')->with('products')->orderBy('name','ASC')->get();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
