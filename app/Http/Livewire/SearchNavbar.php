<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class SearchNavbar extends Component
{
    public $categories;
    public $query;
    public $selected = 0;

    public function search(){
        return redirect()->to('/search-products/'.$this->selected.'/'.$this->query);
    }

    public function updatedSelected($value)
    {
        $this->selected = $value;
    }
    
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
        $this->categories = ProductCategory::whereHas('products', function ($query) {
            return $query->where('id', '<>', '');
        })->orderBy('name','ASC')->get();
    }
}
