<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\ProductClassAttribute;
use GuzzleHttp\Client;

class Filters extends Component
{

    public $categories;
    public $brands;
    public $attributes;
    public $min_price;
    public $max_price;
    
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

    public function search(){
        //$client = new Client();
        //$response = $client ->request('GET',url('filter-products'));

        $price = $this->min_price . ',' . $this->max_price;
        //return redirect()->to('/filter-products?price='.$price);
    }

    public function loadBrands() 
    {
        $this->brands = ProductBrand::where('status','=','1')->with('products')->orderBy('name','ASC')->get();
    }

    public function loadAttributes() 
    {
        $this->attributes = ProductClassAttribute::where('json_options','<>','[]')
        ->where('json_attributes->type_attribute','select')
        ->whereHas('product_attributes', function ($query) {
            return $query->where('json_value', '<>', '')->where('json_value', 'NOT LIKE', "%*%")->groupBy('json_value');
        })->get();

     
        //dd($this->attributes);
    }

    public function loadCategories() 
    {
        $this->categories = ProductCategory::with('product_class')->with('products')->orderBy('name','ASC')->get();
    }
}
