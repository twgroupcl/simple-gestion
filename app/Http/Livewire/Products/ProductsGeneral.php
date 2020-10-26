<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductsGeneral extends Component
{
    public $emitTo = null;

    public function render()
    {        
        if($this->emitTo == "products.card-general"){
            $products = Product::where('status','=','1')->get();
        }else{
            $products = Product::where('status','=','1')->where('is_approved','=','1')->where('parent_id','=', null)->limit(5)->get();
        }
        return view('livewire.'.$this->emitTo)->with('products', $products);
    }
}
