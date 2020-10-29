<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class Filters extends Component
{

    public $categories;

    public function render()
    {
        return view('livewire.filters');
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
