<?php

namespace App\Http\Livewire\Pos;

use App\Mail\PosBill;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\SalesBox;
use App\Models\SalesBoxMovement;
use App\Models\Seller;
use App\Models\MovementType;
use Backpack\Settings\app\Models\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Pos extends Component
{
    //general
    public $seller;
    public $products;
    public $viewMode;
    public $cash;
    public $user;
    public $branches;

    //salebox
    public $saleBox;
    public $checked;
    public $branch_id;
    public $opening_amount;
    public $closing_amount;
    public $remarks_open;
    public $remarks_close;
    public $isSaleBoxOpen = false;

    //movements
    public $movement;
    public $movements;
    public $movementtypes;
    public $updateMovements;

    // cart
    public $cart;
    public $cartproducts;
    public $customer = null;
    public $customerAddressId;
    public $subtotal = 0;
    public $discount = null;
    public $taxes = 0;
    public $total = 0;
    public $totalProducts = 0;
    public $existsOrder = null;

    // document
    public $selected_type_document;

    protected $listeners = [
        'viewModeChanged' => 'setView',
        'add-product-cart:post' => 'addProduct',
        'customerSelected' => 'setCustomer',
        'confirmPayment' => 'confirmPayment',

    ];

    protected $rules = [
        'movement.date' => ['required'],
        'movement.movement_type_id' => ['required'],
        'movement.amount' => ['required'],
        'movement.notes' => ['nullable'],

    ];

    public function mount()
    {
        $this->user = backpack_user();

        $this->seller = Seller::where('user_id', backpack_user()->id)->first();

        if (is_null($this->seller) || $this->seller->is_approved !== $this->seller::REVIEW_STATUS_APPROVED) {
            abort(403);
        }

        $this->branches = $this->user->branches;
        if (isset($this->branches)) {
            if (count($this->branches) > 0) {
                $this->branch_id = $this->branches->first()->id;
            }
        }
        //dd($this->branches);
        //$this->products = $this->getProducts();
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
            $this->totalProducts = count($this->cartproducts);
        }

        if (session()->get('user.pos.selectedCustomer')) {
            $this->customer = session()->get('user.pos.selectedCustomer');
        }

        $this->movement = new SalesBoxMovement();

        //Load Movements
        $this->movementtypes = MovementType::orderBy('name','asc')->get();

        $this->updateMovements = 0;

    }

    public function render()
    {
        if($this->isSaleBoxOpen){
            $this->loadMovements();
        }
        return view('livewire.pos.pos');
    }

    public function setView($view = null)
    {
        $this->viewMode = $view;
    }

    public function confirmPayment($cash, $tip = null, $typeDocument = null, $businessActivity = null)
    {
        $this->customer = session()->get('user.pos.selectedCustomer');

        if ($cash >= $this->total && !is_null($this->saleBox)) {
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

            if (!is_null($tip) && (int) $tip > 0) {
                $order->json_value = json_encode([
                    'tip' => $tip,
                    'addressShipping' => '',
                    'addressInvoice' => '',
                ]);
            }

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

            $this->saleBox->logs()->create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'event' => 'Nueva orden generada',
            ]);
            $this->emit('sales.updateOrders');

            $this->existsOrder = $order;

            $this->emitInvoice($order, $typeDocument, $businessActivity);

            $this->clearCart();

            $this->emit('showToast', 'Cobro realizado', 'Cobro registrado.', 3000, 'info');

        } else {
            $this->emit('showToast', 'Error', 'Ocurrio un error al registrar el pago.', 3000, 'error');
        }
    }

    protected function clearCart()
    {
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
        $this->taxes = 0;
        $this->existOrder = null;
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

    public function getSelectedCustomerAddress()
    {
        $this->customer = session()->get('user.pos.selectedCustomer');

        /*   if (!is_null($this->customer->addresses) && count($this->customer->addresses)>0) {
        return json_encode($this->customer->addresses);
        }else{ */
        return null;
        /*  } */
    }

    public function getProducts()
    {
        return Product::where('status', '=', '1')
            ->where('is_approved', '=', '1')
            ->where('parent_id', '=', null)
        // ->whereSellerId($this->seller->id)
            ->limit(15)
            ->get();
    }

    public function validateBox()
    {
        $this->saleBox = $this->seller->sales_boxes()->latest()->first();

        $this->isSaleBoxOpen = optional($this->saleBox)->is_opened ?? false;

        $this->checked = isset($this->saleBox->id);
        if (!$this->isSaleBoxOpen) {
            $this->saleBox = null;
            $this->dispatchBrowserEvent('openSaleBoxView');
        }else{
            $this->loadMovements();
            //
        }
    }

    public function updateBoxDetails(SalesBox $saleBox = null)
    {
        $this->saleBox = $saleBox;

        $this->checked = isset($this->saleBox->id);
    }

    public function openSaleBox()
    {

        $this->saleBox = $this->seller->sales_boxes()->create([
            'branch_id' => $this->branch_id,
            'opening_amount' => $this->opening_amount,
            'remarks_open' => $this->remarks_open,
            'opened_at' => now(),
        ]);

        $this->isSaleBoxOpen = true;
        $this->opening_amount = null;
        $this->closing_amount = null;
        $this->remarks_open = null;
        $this->updateBoxDetails($this->saleBox);
        $this->dispatchBrowserEvent('closeSaleBoxView');
    }

    public function closeSaleBox()
    {
        $this->saleBox->closing_amount = $this->closing_amount;
        $this->saleBox->closed_at = now();
        $this->saleBox->closing_amount = $this->saleBox->calculateClosingAmount();
        $this->saleBox->save();
        $this->isSaleBoxOpen = false;
        $this->updateBoxDetails($this->saleBox);
        $this->dispatchBrowserEvent('closeSaleBoxView');
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

        $this->cartproducts = $this->getCartProducts();

        isset($this->cartproducts[$product->id]['qty'])
        ? $this->cartproducts[$product->id]['qty'] += 1
        : $this->cartproducts[$product->id]['qty'] = 1;

        $this->cartproducts[$product->id]['product'] = $product;
        $this->cartproducts[$product->id]['real_price'] = $product->real_price;

        $this->calculateAmounts();
        //$this->cart->emit('item.updatedCustomQty', $product->id, $this->cart->products[$product->id]['qty']);
        $this->totalProducts = count($this->cartproducts);

    }

    public function calculateAmounts()
    {

        $cart = null;
        $this->subtotal = collect($this->cartproducts)->sum(function ($product) {
            // return ($product['product']->price??$product['product']['price']) * $product['qty'];
            return $product['real_price'] * $product['qty'];
        });

        // if ($this->discount > $this->subtotal) {
        //     $this->discount = $this->subtotal;
        // }

        // $this->total = (float) $this->subtotal - (float) $this->discount;

        $this->total = $this->subtotal;
        $tmptaxes = ($this->total * 19) / 119;
        $this->subtotal = $this->total - $tmptaxes;
        $this->taxes = $tmptaxes;
        //$this->total += $tmptaxes;

        $cart['products'] = $this->cartproducts;
        $cart['subtotal'] = $this->subtotal;
        $cart['discount'] = $this->discount;
        $cart['taxes'] = $this->taxes;
        $cart['total'] = $this->total;

        // Save cart to session
        session()->put(['user.pos.cart' => json_encode($cart)]);

        $this->emit('list-product-qty', $this->totalProducts);

    }

    public function productHasConfigurableDetail(Product $product)
    {
        return $product->product_type->id == 2;
    }

    public function removeProductCart($productId)
    {
        $this->cartproducts = $this->getCartProducts();

        unset($this->cartproducts[$productId]);
        $this->calculateAmounts();
        $this->totalProducts = count($this->cartproducts);

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

    public function getCartProducts()
    {
        return json_decode(session()->get('user.pos.cart') ?? '[]', true)['products'] ?? [];
    }

    public function emitInvoice(Order $order, $typeDocument, $businessActivity)
    {

        $currentSeller = Seller::where('user_id', backpack_user()->id)->first();
        DB::beginTransaction();
        try {

            $invoiceType = InvoiceType::where('code', $typeDocument)->first();

            $order_items = $order->order_items()->get()->map(function ($item) {

                // Since the items in the POS are assumed with IVA, we must subtract it
                // and make the total calculations again to save it in the invoice table

                $item_iva = 19 * $item->price / 119;
                $subtotal_iva = 19 * $item->sub_total / 119;
                $total = (($item->price - $item_iva) * $item->qty) - $item->discount;

                $item->price = currencyFormat($item->price - $item_iva, 'CLP', false);
                $item->sub_total = currencyFormat($item->sub_total - $subtotal_iva, 'CLP', false);
                $item->total = currencyFormat($total, 'CLP', false);
                $item->discount = 0;
                $item->discount_type = 'amount';
                $item->is_custom = "0";
                $item->additional_tax_id = 0;
                $item->additional_tax_amount = 0;
                $item->additional_tax_total = 0;
                return $item;
            })->toJson();

            $invoice = new Invoice($order->toArray());
            $invoice->address_id = $this->customerAddressId;
            $invoice->seller_id = $currentSeller->id;
            $invoice->items_data = $order_items;
            $invoice->invoice_date = now();
            $invoice->tax_amount = 19 * $invoice->total / 119;
            $invoice->net = $invoice->total - $invoice->tax_amount;
            $invoice->json_value = ['source' => 'pos'];

            $invoice->invoice_type_id = $invoiceType->id;

            if ($invoiceType->code == 33) {
                $invoice->business_activity_id = $businessActivity;
            }

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
        //return redirect()->route('pos.order', ['id' => $order->id]);
    }

    public function updateAddress($addressId)
    {
        $this->customerAddressId = $addressId;
    }

    public function updatedDiscount()
    {
        $this->calculateAmounts();
    }

    public function sendMail(Invoice $invoice = null)
    {
        Mail::to($invoice->email)->send(new PosBill($invoice));
    }

    public function showSalesBoxModal()
    {
        $this->dispatchBrowserEvent('showSalesBoxModal');
    }

    public function storeMovement()
    {
        /* $validated = $this->validate([
            'movement.date' => 'required',
            'movement.movement_type_id' => 'required',
            'movement.amount' => 'required',
            'movement.notes' => 'nulleable',

        ]); */
        $this->validate([
            'movement.date' => ['required'],
            'movement.movement_type_id' => ['required'],
            'movement.amount' => ['required'],
            'movement.notes' => ['nullable'],
        ]);

        //Convert date
        $tmpDate = Carbon::parse($this->movement->date);


        $tmpMovement = new SalesBoxMovement();

        //Set sale_box_id
        $tmpMovement->sales_box_id = $this->saleBox->id;
        $tmpMovement->movement_type_id = $this->movement->movement_type_id;
        $tmpMovement->date = $tmpDate;
        $tmpMovement->amount = $this->movement->amount;
        $tmpMovement->notes = $this->movement->notes;
        $tmpMovement->save();





        //Clear movement
        $this->movement->date = null;
        $this->movement->movement_type_id = null;
        $this->movement->amount = null;
        $this->movement->notes = null;

        //Distpatch browser event
        $this->dispatchBrowserEvent('hideMovementSalesBoxModal');

        $this->loadMovements();



    }

    public function loadMovements()
    {
        $this->movements = $this->saleBox->movements;
        $this->updateMovements +=1;
    }

}
