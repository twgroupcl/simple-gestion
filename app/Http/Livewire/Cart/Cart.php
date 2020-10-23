<?php

namespace App\Http\Livewire\Cart;

use App\Http\Livewire\Traits\Cursor;
use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\{Product, CartItem, Customer};
use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Facades\DB;

class Cart extends Component
{
    use Cursor;

    public $subtotal;
    public $cart;

    protected $listeners = [
        'cart:add' => 'add',
        'cart.updateSubtotal' => 'updateSubtotal'
    ];

    public function mount()
    {
        $this->cart = $this->getCart();
        $this->subtotal = $this->cart->sub_total ?? 0;
        
        if (!isset($this->cart->cart_items) || $this->cart->cart_items->count() == 0) {
            $this->setCursor('not-allowed');
        } 
    }

    public function add(Request $request, Product $product, $qty = 1)
    {
        //get update cart
        $this->cart = $this->getCart();
        $this->cart->save();

        $qty = $qty == null ? 1 : $qty;

        $this->addItem($product, $qty);

        $this->updateSubtotal();
    }

    public function updateSubtotal()
    {
        $this->cart->recalculateSubtotal();
        $this->cart->recalculateQtys();
        $this->cart->update();
        $this->subtotal = $this->cart->sub_total;
        $this->setCursor('not-allowed');
        if ($this->cart->cart_items->count() > 0) {
            $this->setCursor('auto');
        }
        
        $this->emit('dropdown.update', $this->cart);
        $this->emit('cart-counter.setCount', $this->cart->items_count);
    }


    public function render(SessionManager $s)
    {
        //Recuperar una $session = \Session::getHandler()->read(\Session::getId())

        return view('livewire.cart.cart');
    }

    private function addItem(Product $product, $qty = 1)
    {
        $item = $this->cart->cart_items->where('product_id', $product->id)->first();
        if ($item !== null) {
            $item->qty = $item->qty + $qty;
            $item->sub_total = $item->price * $item->qty;
            $item->update();
        } else {
            $data = [
                'cart_id' => $this->cart->id,
                'product_id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'width' => $product->width,
                'height' => $product->height,
                'depth' => $product->depth,
                'weight' => $product->weight,
                'sub_total' => $product->price * $qty,
                /*'sub_total' => ,
                'shipping_total' => ,
                'discount_total' => ,
                'tax_amount' => ,
                'tax_total' => ,
                'discount_amount' => ,
                'discount_percent' => ,
                'coupon_code' => ,
                'custom_price' => ,*/
                'total_weight' => $product->weight * $qty,
                'total' => $product->price * $qty,
                'currency_id' => $product->currency_id,
            ];
            if ($product->parent_id) {
                $attributes = [];
                foreach ($product->getAttributesWithNames() as $key) {
                    $attributes[] = [
                        $key['name'] => $key['value']
                    ];
                }

                $data = array_merge($data, ['product_attributes' => json_encode($attributes)]);
            }

            $item = CartItem::create($data);
            
            $this->cart->items_count ++;
            
            if($item){
                session()->flash('message', '¡Éxito! El artículo se añadió al carro.');
            }else{
                session()->flash('error', 'Ocurrió un error al momento de agregar el producto.');                
            }
        }
    }

    private function getCart()
    {
        $session = session()->getId();
        $user = auth()->check() ? auth()->user() : null;
        return CartModel::getInstance($user, $session);
    }
}