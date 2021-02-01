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
    protected $product; 

    public function render()
    {
        return view('livewire.filters');
    }

    public function mount($products = null)
    {
        //$this->loadCategories();
        $this->products = $products;
        $this->loadBrands();
        $this->loadAttributes();
    }

    public function filter() {
        $this->emit('shop-grid.filter', $this->filterOptions);
    }

    public function loadBrands() 
    {
        if ($this->products) {
            $this->brands = $this->products->load(['product_brands' => function($query) {
                $query->where('status', 1)->orderBy('name', 'ASC');
            }])->pluck('product_brands', 'product_brands.id')->flatten();
        } else {

            $this->brands = ProductBrand::where('status','=','1')
                 ->with('products')->orderBy('name','ASC')->get();
        }
    }

    public function loadAttributes() 
    {
        if (isset($this->products)) {
            $this->attributes = $this->products->load([
                'product_class_attributes' => function ($query) {

                    $query->where('json_options','<>','[]')
                          ->where('json_attributes->type_attribute','select')
                          ->whereHas('product_attributes', function ($query) {
                                return $query->where('json_value', '<>', '')
                                             ->where('json_value', 'NOT LIKE', "%*%")
                                             ->groupBy('json_value');
                           });
                }
            ])->pluck('product_class_attributes', 'product_class_attributes.id')->flatten();

        } else {
            $this->attributes = ProductClassAttribute::where('json_options','<>','[]')
            ->where('json_attributes->type_attribute','select')
            ->whereHas('product_attributes', function ($query) {
                return $query->where('json_value', '<>', '')
                             ->where('json_value', 'NOT LIKE', "%*%")->groupBy('json_value');
            })->get();

        }
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
