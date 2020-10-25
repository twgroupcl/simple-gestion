<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class CategoriesMenu extends Component
{
    public $categories;

    public function render()
    {
        return view('livewire.categories-menu');
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::orderBy('name','ASC')->get();
    }
}
