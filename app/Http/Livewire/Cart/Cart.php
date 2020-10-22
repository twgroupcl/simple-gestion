<?php

namespace App\Http\Livewire\Cart;


use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\{Product, CartItem, Customer};

class Cart extends Component
{

    protected $listeners = [
        'cart:add' => 'add',
    ];

    public function add(Request $request, Product $product, $qty = 1)
    {

        $qty = $qty == null ? 1 : $qty;

        $session = session();
        if (auth()->check()) {
            $user = auth()->user();
            $cart = CartModel::getInstance($user,$session); 
        } else {
            $cart = CartModel::getInstance(null, $session); 
        }
        $cart->company_id = 1;
        
        $cart->save();

        $this->addItem($cart, $product, $qty);
        $this->emit('dropdown.update');

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
    }
}