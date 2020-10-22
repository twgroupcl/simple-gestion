<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class SearchNavbar extends Component
{
    public $categories;
    
    public function render()
    {
        return view('livewire.search-navbar');
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::all();
    }
}
