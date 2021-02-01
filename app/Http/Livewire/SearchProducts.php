<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchProducts extends Component
{

    public $search;
    public $post;
    protected $queryString = ['search'];

    public function render()
    {
        $render = [
            'products' => $this->getProducts()
        ];

        return view('livewire.search-products',$render);
    }

    public function getProducts()
    {
        return Product::where('status', '=', '1')
            ->where('parent_id', '=', null)
            ->where('is_approved', '=', '1')
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->with('categories')
            ->whereHas('seller', function ($query) {
                return $query->where('is_approved', '=', '1');
            })->get();
    }

    
}
