<?php

namespace App\Http\Livewire\Pos;

use App\Models\Product;
use App\Models\Seller;
use Livewire\Component;

class ListProducts extends Component
{
    public $products;
    public $seller;
    public $searchProduct;
    public $showAddToCart = false;
    public $productSelected = null;
    public $productNotFound = false;
    public $cartproducts =0 ;
    protected $listeners =[
        'list-product-qty' => 'productsQty'
    ];



    public function render()
    {
        $this->products = $this->getProducts($this->searchProduct);
        $isBarcode = is_numeric($this->searchProduct);
        //si es un solo producto lo agrego al carro
        if(count($this->products) == 1 && $isBarcode) {
            $this->productSelected = $this->products->first();
           // $this->dispatchBrowserEvent('showAddFastProduct');
           $this->emit('product:addToCartFast', $this->productSelected->id);
           $this->searchProduct = null;
           $this->productSelected = null;

        }else{
            if(count($this->products) == 0) {
                $this->productNotFound = true;
            }else{
                $this->productNotFound = false;
            }
        }


        return view('livewire.pos.list-products');
    }

    public function mount(Seller $seller, $cartproducts)
    {
        $this->seller = $seller;
        $this->cartproducts = $cartproducts;

        //$this->products = $this->getProducts($this->searchProduct);
    }

    public function getProducts($searchProduct)
    {
        return Product::where('status','=','1')
                        ->where('is_approved','=','1')
                        ->where('parent_id', '=', null)
                        //->whereSellerId($this->seller->id)
                        ->Where('deleted_at', '=', null)
                        ->Where('name', 'like', '%'.$searchProduct.'%')
                        ->orWhere('sku', '=', $searchProduct)

                        ->limit(20)
                        ->get();
    }

    public function addToCart(){
        $this->emit('product:addToCartFast', $this->productSelected->id);
        $this->searchProduct = null;
        $this->showAddToCart = false;
        $this->productSelected = null;
    }

    /* public function searchProductUpdated(){
        $this->products = $this->getProducts($this->searchProduct);

        //si es un solo producto lo agrego al carro
        if(count($this->products) == 1) {
            $this->productSelected = $this->products->first();
           // $this->dispatchBrowserEvent('showAddFastProduct');
           $this->emit('product:addToCartFast', $this->productSelected->id);
           $this->searchProduct = null;
           $this->productSelected = null;

        }else{
            if(count($this->products) == 0) {
                $this->productNotFound = true;
            }else{
                $this->productNotFound = false;
            }
        }
    } */

    public function showAddProductModal()
    {
        $this->dispatchBrowserEvent('showAddFastProduct');

    }

    public function productsQty($productsqty)
    {
        $this->cartproducts = $productsqty;
    }
}
