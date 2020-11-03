<?php

namespace App\Http\Livewire\Checkout;

use App\Models\Cart;
use App\Models\Seller;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;

class Shipping extends Component
{
    public $cart;
    public $items;
    public $sellers;
    protected $listeners = [
        'deleteItem' => 'deleteItem'
    ];


    public function mount()
    {
        $this->sellers = $this->getSellers();

    }
    public function render()
    {
        return view('livewire.checkout.shipping');
    }



    private function getSellers()
    {
        $products_id = CartItem::whereCartId($this->cart->id)->select('product_id')->with('product')->get();
        foreach($products_id as $id){
            $ids[] = $id['product_id'];
        }

        if (count($products_id)>0) {
            $sellers_id = Product::whereIn('id', $ids)->select('seller_id')->groupBy('seller_id')->get();
            return Seller::whereIn('id', $sellers_id)->select('id', 'name')->get();
        }else{
            return null;
        }


    }

    public function deleteItem()
    {
        $this->change();

    }


    public function change()
    {
        $this->sellers = $this->getSellers();
        $this->emit('cart.updateSubtotal',null);
        $this->emitUp('updateTotals');

    }
}
