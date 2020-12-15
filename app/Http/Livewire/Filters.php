<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use App\Models\Product;
use Livewire\Component;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductClassAttribute;

class Filters extends Component
{

    public $categories;
    public $brands;
    public $attributes;
    public $min_price;
    public $max_price;
    public $filterOptions = []; 
    public $data;
    
    public function render()
    {
        return view('livewire.filters');
    }

    public function mount($data = [])
    {
        $this->data = $data;
        $this->loadCategories();
        $this->loadBrands();
        $this->loadAttributes();
    }

    public function filter() {
        $this->emit('shop-grid.filter', $this->filterOptions);
    }

    public function loadBrands() 
    {
        $this->brands = ProductBrand::where('status','=','1')->with('products')->orderBy('name','ASC')->get();
    }

    public function loadAttributes() 
    {
        $category_id = $this->data['category'] ?? null;

        $this->attributes = ProductClassAttribute::where('json_options','<>','[]')
        ->where('json_attributes->type_attribute','select')
        ->whereHas('product_attributes', function ($query) use ($category_id) {
            return $query->where('json_value', '<>', '')
                         ->where('json_value', 'NOT LIKE', "%*%")
                         ->when($category_id, function ($query) use ($category_id) {
                            return $query->whereHas('product', function ($query) use ($category_id)  {
                                return $query->whereHas('categories', function ($query) use ($category_id)  {
                                    return $query->where('id', $category_id);
                                });
                            });
                        })
                ->groupBy('json_value');
        })->get();
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
