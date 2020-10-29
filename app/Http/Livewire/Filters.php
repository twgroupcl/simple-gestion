<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\ProductClassAttribute;

class Filters extends Component
{

    public $categories;
    public $brands;
    public $attributes;

    public function render()
    {
        return view('livewire.filters');
    }

    public function mount()
    {
        $this->loadCategories();
        $this->loadBrands();
        $this->loadAttributes();
    }

    public function loadBrands() 
    {
        $this->brands = ProductBrand::where('status','=','1')->with('products')->orderBy('name','ASC')->get();
    }

    public function loadAttributes() 
    {
        $this->attributes = ProductClassAttribute::where('json_options','<>','[]')->with('product_attributes')->get();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
