<?php

namespace App\Http\Livewire\Pos\Cart;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\SalesBox;
use App\Models\Seller;
use Backpack\Settings\app\Models\Setting;
use Carbon\Carbon;
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
        'cart.confirmPayment' => 'confirmPayment',
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
        $this->products[$product->id]['product']['real_price'] = $product->real_price;
        $this->calculateAmounts();
        $this->emit('item.updatedCustomQty', $product->id, $this->products[$product->id]['qty']);
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
            return $product['product']['real_price'] * $product['qty'];
        });

        $this->total = $this->subtotal - $this->discount;

        $cart['products'] = $this->products;
        $cart['subtotal'] = $this->subtotal;
        $cart['discount'] = $this->discount;
        $cart['total'] = $this->total;

        // Save cart to session
        session()->put(['user.pos.cart' => json_encode($cart)]);

       // $this->emitUp('pos.updateCart');

    }

    public function updateQuantity(Product $product, $qty)
    {
        $this->products[$product->id]['qty'] = $qty;
        $this->calculateAmounts();
        // $this->emit('payment.updated');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function confirmPayment($cash)
    {
        if ($cash >= $this->total) {
            $currency = Currency::where('code', Setting::get('default_currency'))->firstOrFail();
            //Make order
            $order = new Order();
            $order->company_id = $this->customer->company_id;
            $order->uid = $this->customer->uid;
            $order->first_name = $this->customer->first_name;
            $order->last_name = $this->customer->last_name;
            $order->email = $this->customer->email;
            $order->phone = $this->customer->phone;
            $order->cellphone = $this->customer->cellphone;
            $order->currency_id = $currency->id;
            $order->customer_id = $this->customer->id;

            $order->status = 1; //initiated
            $order->save();

            //Add Order Item
            foreach ($this->products as $item) {
                $product = Product::whereId($item['product']['id'])->firstOrFail();
                $orderitem = new OrderItem();
                $orderitem->order_id = $order->id;
                $orderitem->seller_id = $product->seller_id;
                $orderitem->currency_id = $currency->id;
                $orderitem->product_id = $product->id;
                $orderitem->name = $product->name;
                $orderitem->sku = $product->sku;
                $orderitem->price = $product->real_price;
                $orderitem->qty = $item['qty'];
                $orderitem->sub_total = $product->real_price * $item['qty'];
                $orderitem->total = $product->real_price * $item['qty'];
                $orderitem->save();
            }

            $order->sub_total = $this->subtotal;
            $order->total = $this->total;

            $order->save();

            //Register payment
            $orderpayment = new OrderPayment();
            $data = [
                'event' => 'Cash Payment',
                'data' => $cash,

            ];
            $orderpayment->order_id = $order->id;
            $orderpayment->method = 'cash';
            $orderpayment->method_title = 'cash';
            $orderpayment->json_in = json_encode($data);
            $orderpayment->date_in = Carbon::now();
            $orderpayment->save();

            //Add register to box sales
            $currentSeller = Seller::firstWhere('user_id', backpack_user()->id);
            $salebox = $currentSeller->sales_boxes()->latest()->first();
            $salebox->logs()->create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'event' => 'Nueva orden generada',
            ]);


            $this->clearCart();
            $this->emit('sales.updateOrders');
            $this->emit('showToast', 'Cobro realizado', 'Cobro registrado.', 3000, 'info');

        } else {
            $this->emit('showToast', 'Error', 'Ocurrio un error al registrar el pago.', 3000, 'error');
        }
// dd($salebox, $salebox->logs, $order);
    }

    protected function clearCart(){
        //Clear cart
        session()->put(['user.pos.cart' => null]);
        $this->products = [];
        $this->total = 0;
        $this->subtotal = 0;
        $this->cash = 0;
    }
}
