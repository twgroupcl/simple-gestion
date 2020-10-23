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
        $this->getCart();
        $this->cart->company_id = 1;
        $this->subtotal = $this->cart->sub_total ?? 0;

        if ($this->cart->cart_items->count() == 0) {
            $this->setCursor('not-allowed');
        } 
    }

    public function add(Request $request, Product $product, $qty = 1)
    {
        //get update cart
        $this->getCart();
        if (!$this->cart->company_id) {
            $this->cart->company_id = 1;
            $this->cart->save();
        }

        $qty = $qty == null ? 1 : $qty;

        $this->addItem($this->cart, $product, $qty);

        $this->cart->recalculateSubtotal();
        $this->cart->save();
        
        $this->updateSubtotal();

    }

    public function updateSubtotal()
    {
        $this->subtotal = $this->cart->sub_total;
        $this->setCursor('not-allowed');
        if ($this->cart->cart_items->count() > 0) {
            $this->setCursor('auto');
        }
    }


    public function render(SessionManager $s)
    {
        //Recuperar una $session = \Session::getHandler()->read(\Session::getId())

        return view('livewire.cart.cart');
    }

    private function addItem(CartModel $cart, Product $product, $qty = 1)
    {
        $item = $cart->cart_items->where('product_id', $product->id)->first();
        if ($item !== null) {
            $item->qty = $item->qty + $qty;
            $item->sub_total = $item->price * $item->qty;
            $item->update();
        } else {
            $data = [
                'cart_id' => $cart->id,
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

            $cart = CartItem::create($data);
            $this->emit('cart-counter:increment');

            if($cart){
                session()->flash('message', '¡Éxito! El artículo se añadió al carro.');
            }else{
                session()->flash('error', 'Ocurrió un error al momento de agregar el producto.');                
            }
        }

        $this->emit('dropdown.update');
    }

    private function getCart()
    {
        $session = session();
        if (auth()->check()) {
            $user = auth()->user();
            $this->cart = CartModel::getInstance($user,$session); 
        } else {
            $this->cart = CartModel::getInstance(null, $session); 
        }
    }
}