<?php

namespace App\Http\Livewire\Pos;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\InvoiceType;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\DB;
use Backpack\Settings\app\Models\Setting;
use Exception;

class Pos extends Component
{
    //general
    public $seller;
    public $products;
    public $viewMode;
    public $cash;

    //salebox
    public $saleBox;
    public $checked;
    public $isSaleBoxOpen = false;
    // cart
    public $cart;
    public $cartproducts;
    public $customer = null;
    public $customerAddressId;
    public $subtotal = 0;
    public $discount = null;
    public $total = 0;
    protected $listeners = [
        'viewModeChanged' => 'setView',
        'add-product-cart:post' => 'addProduct',
        'customerSelected' => 'setCustomer',
        'confirmPayment' => 'confirmPayment',

    ];

    public function mount()
    {
        $this->seller = Seller::where('user_id', backpack_user()->id)->first();

        if (is_null($this->seller) || $this->seller->is_approved !== $this->seller::REVIEW_STATUS_APPROVED) {
            abort(403);
        }

        $this->products = $this->getProducts();
        //$this->setView('productList');
        $this->validateBox();

        //Check if exist session cart
        if (session()->get('user.pos.cart')) {
            $tmpCart = json_decode(session()->get('user.pos.cart'));

            $tmpProducts = $tmpCart->products;
            $this->cartproducts = [];

            foreach ($tmpProducts as $product) {
                $this->cartproducts[$product->product->id]['qty'] = $product->qty;
                $this->cartproducts[$product->product->id]['product'] = (array) $product->product;
                $this->cartproducts[$product->product->id]['real_price'] = $product->real_price;
            }
            $this->calculateAmounts();
        }

        if (session()->get('user.pos.selectedCustomer')) {
            $this->customer = session()->get('user.pos.selectedCustomer');
        }
    }

    public function render()
    {
        return view('livewire.pos.pos');
    }

    public function setView($view = null)
    {
        $this->viewMode = $view;
    }

    public function confirmPayment($cash)
    {
        $this->customer = session()->get('user.pos.selectedCustomer');
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
            foreach ($this->cartproducts as $item) {
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
            $order->discount_total = $this->discount;
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

            $this->emitInvoice($order);

            $this->clearCart();
            $this->emit('sales.updateOrders');
            $this->emit('showToast', 'Cobro realizado', 'Cobro registrado.', 3000, 'info');

        } else {
            $this->emit('showToast', 'Error', 'Ocurrio un error al registrar el pago.', 3000, 'error');
        }
    }

    protected function clearCart(){
        //Clear cart
        session()->put([
            'user.pos.cart' => null,
            'user.pos.selectedCustomer' => null,
            'user.pos.selectedCustomerAddress' => null,
        ]);
        $this->cartproducts = [];
        $this->total = 0;
        $this->discount = null;
        $this->subtotal = 0;
        $this->cash = 0;
    }

    public function getTotalCart()
    {
        $this->cart = json_decode(session()->get('user.pos.cart'));

        return currencyFormat($this->cart->total ?? 0, 'CLP', true);
    }
    public function getSelectedCustomer()
    {
        $this->customer = session()->get('user.pos.selectedCustomer');

        return json_encode($this->customer);
    }

    public function getProducts()
    {
        return Product::where('status', '=', '1')
            ->where('is_approved', '=', '1')
            ->where('parent_id', '=', null)
            ->whereSellerId($this->seller->id)
            ->get();
    }

    public function validateBox()
    {
        $this->saleBox = $this->seller->sales_boxes()->latest()->first();

        $this->isSaleBoxOpen = optional($this->saleBox)->is_opened ?? false;

        $this->checked = isset($this->saleBox->id);
        // if (! $this->isSaleBoxOpen) {
        //    // $this->showSaleBoxModal();
        //    dd('no hay caja abierta');
        // } else {
        //    // $this->emit('salesBoxUpdated', $this->saleBox->id);
        //    dd('existe caja abierta');
        // }
    }

    // Cart Operations

    public function addProduct(Product $product)
    {

        if (!$this->productHasConfigurableDetail($product)) {
            $this->addToCart($product);
            return;
        } else {
            $this->emitTo(
                'pos.product-custom-attributes', 'productShared',
                $this->product->id,
                $this->currentPrice
            );
        }

    }

    public function addToCart(Product $product)
    {

        // $product = $this->products->firstWhere('id', $idProduct);

        isset($this->cartproducts[$product->id]['qty'])
        ? $this->cartproducts[$product->id]['qty'] += 1
        : $this->cartproducts[$product->id]['qty'] = 1;

        $this->cartproducts[$product->id]['product'] = $product;
        $this->cartproducts[$product->id]['real_price'] = $product->real_price;

        $this->calculateAmounts();
        //$this->cart->emit('item.updatedCustomQty', $product->id, $this->cart->products[$product->id]['qty']);

    }

    public function calculateAmounts()
    {

        $cart = null;
        $this->subtotal = collect($this->cartproducts)->sum(function ($product) {
            // return ($product['product']->price??$product['product']['price']) * $product['qty'];
            return $product['real_price'] * $product['qty'];
        });

        if ($this->discount > $this->subtotal) {
            $this->discount = $this->subtotal;
        }

        $this->total = (float) $this->subtotal - (float) $this->discount;

        $cart['products'] = $this->cartproducts;
        $cart['subtotal'] = $this->subtotal;
        $cart['discount'] = $this->discount;
        $cart['total'] = $this->total;

        // Save cart to session
        session()->put(['user.pos.cart' => json_encode($cart)]);

        // $this->emitUp('pos.updateCart');

    }

    public function productHasConfigurableDetail(Product $product)
    {
        return $product->product_type->id == 2;
    }

    public function removeProductCart($productId)
    {
        unset($this->cartproducts[$productId]);
        $this->calculateAmounts();
    }

    public function updateQty($idProduct, $qty)
    {
        $tmpQty = $this->cartproducts[$idProduct]['qty'] + $qty;
        $this->cartproducts[$idProduct]['qty'] = $tmpQty;

        $this->calculateAmounts();

    }

    public function setCustomer(Customer $customer, array $wildcard = null, $addressId = null)
    {
        $this->customer = session()->get('user.pos.selectedCustomer');
        $this->customerAddressId = $addressId;
    }


    public function emitInvoice(Order $order)
    {
        $currentSeller = Seller::where('user_id', backpack_user()->id)->first();
        DB::beginTransaction();
        try {

            $invoiceType = InvoiceType::firstOrCreate(
                ['name' => "Boleta electrónica"],
                ['country_id' => 43, 'code' => 39], // 41 => exenta, 39 => afecta(con impuestos)
            );

            $order_items = $order->order_items->map(function ($item) {
                $item->price = currencyFormat($item->price, 'CLP', false);
                $item->sub_total = currencyFormat($item->sub_total, 'CLP', false);
                $item->total = currencyFormat($item->total, 'CLP', false);
                $item->discount = 0;
                $item->discount_type = 'amount';
                $item->is_custom = true;
                $item->additional_tax_id = 0;
                $item->additional_tax_amount = 0;
                $item->additional_tax_total = 0;
                return $item;
            })->toJson();

            $invoice = new Invoice($order->toArray());
            $invoice->address_id = $this->customerAddressId;
            $invoice->seller_id = $currentSeller->id;
            $invoice->items_data = $order_items;
            $invoice->invoice_type_id = $invoiceType->id;
            $invoice->invoice_date = now();
            $invoice->save();

            Invoice::withoutEvents(function () use ($invoice, $order) {
                $invoice->uid = $order->uid;
                $invoice->first_name = $order->first_name;
                $invoice->last_name = $order->last_name;
                $invoice->email = $order->email;
                $invoice->phone = $order->phone;
                $invoice->cellphone = $order->cellphone;
                $invoice->address_id = $this->customerAddressId;
                $invoice->discount_amount = $order->discount_total;
                $invoice->discount_total = $order->discount_total;
                $invoice->total = $order->total;

                $invoice->orders()->attach($order->id);
                $invoice->customer()->associate($this->customer);
                $invoice->total = $order->total;
                $invoice->save();
            });

            DB::commit();

            return $invoice;

        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return false;
        }
    }

    public function updateAddress($addressId)
    {
        $this->customerAddressId = $addressId;
    }

    public function updatedDiscount()
    {
        $this->calculateAmounts();
    }
}
