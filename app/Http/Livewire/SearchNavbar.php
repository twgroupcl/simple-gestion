<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class SearchNavbar extends Component
{
    public $categories;
    public $query    = '';
    public $selected = 0;

    public function search(){
        //dd($this->selected,$this->query);
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
        $this->categories = ProductCategory::all();
    }
}
