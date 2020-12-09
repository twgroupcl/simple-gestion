<?php

namespace App\Http\Livewire\Pos\Cart;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $products;
    public $subtotal = 0;
    public $discount = 0;
    public $total = 0;
    public $qty = 0;
    public $customer = null;
    protected $listeners = [
        'add-product-cart:post' => 'addProduct',
        'remove-from-cart:post' => 'remove',
        'remove-from-cart:post' => 'remove',
        'quantityUpdated' => 'updateQuantity',
        'customerSelected' => 'setCustomer',
    ];

    public function mount()
    {
        if (session()->get('user.pos.cart')) {
            $tmpCart = json_decode(session()->get('user.pos.cart'));

            $tmpProducts = $tmpCart->products;
            $this->products = [];

            foreach ($tmpProducts as $product) {
                $this->products[$product->product->id]['qty'] = $product->qty;
                $this->products[$product->product->id]['product'] = (array) $product->product;
            }
            $this->calculateAmounts();
        } else {
            $this->products = [];
        }
        if (session()->get('user.pos.selectedCustomer')) {
            $this->customer = Customer::find(session()->get('user.pos.selectedCustomer')->id);
        }
    }
    public function render()
    {
        return view('livewire.pos.cart.cart');
    }

    public function addProduct(Product $product)
    {
        isset($this->products[$product->id]['qty'])
        ? $this->products[$product->id]['qty'] += 1
        : $this->products[$product->id]['qty'] = 1;

        $this->products[$product->id]['product'] = $product;
        $this->emit('item.updatedCustomQty', $product->id, $this->products[$product->id]['qty']);
        $this->calculateAmounts();
    }

    public function remove($productId)
    {
        unset($this->products[$productId]);
        $this->calculateAmounts();
    }

    public function calculateAmounts()
    {

        $cart = null;
        $this->subtotal = collect($this->products)->sum(function ($product) {
            // return ($product['product']->price??$product['product']['price']) * $product['qty'];
            return $product['product']['price'] * $product['qty'];
        });

        $this->total = $this->subtotal - $this->discount;

        $cart['products'] = $this->products;
        $cart['subtotal'] = $this->subtotal;
        $cart['discount'] = $this->discount;
        $cart['total'] = $this->total;

        // Save cart to session
        session()->put(['user.pos.cart' => json_encode($cart)]);

    }

    public function updateQuantity(Product $product, $qty)
    {
        $this->products[$product->id]['qty'] = $qty;
        $this->calculateAmounts();
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }
}
