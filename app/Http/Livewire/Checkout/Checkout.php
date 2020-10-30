<?php

namespace App\Http\Livewire\Checkout;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class Checkout extends Component
{
    public $steps;
    public $activeStep;
    public $subtotal;
    public $shippingtotal;
    public $total;
    public $cart;
    public $items;
    public $loading;
    public $canContinue;

    protected $listeners = [
        'prev-step' => 'prevStep',
        'next-step' => 'nextStep',
        'set-detail' => 'setDetails',
        'finishTask' => 'finishTask',
        'notFinishTask' => 'notFinishTask',
        'select-shipping' => 'addShipping',
        'pay' => 'pay',
        'change' => 'updateTotals',
        'cartpreview' => 'cartpreview',
    ];

    public function mount()
    {
        $this->steps = [
            [
                'name' => 'Carro',
                'status' => 'active',
                'number' => 1,
                'icon' => 'czi-cart',
                'prev-button' => 'Volver a comprar',
                'next-button' => 'Ingresar datos envío',
                'event-prev' => null,
                'event-next' => null,

            ],
            [
                'name' => 'Detalle',
                'status' => 'active',
                'number' => 2,
                'icon' => 'czi-user-circle',
                'prev-button' => 'Volver al carro',
                'next-button' => 'Seleccionar métodos de envío',
                'event-prev' => 'cartpreview',
                'event-next' => 'details:save',

            ],
            [
                'name' => 'Envío',
                'status' => '',
                'number' => 3,
                'icon' => 'czi-package',
                'prev-button' => 'Volver a información de envío',
                'next-button' => 'Seleccionar método de pago',
                'event-prev' => null,
                'event-next' => null,

            ],
            [
                'name' => 'Pago',
                'status' => '',
                'number' => 4,
                'icon' => 'czi-card',
                'prev-button' => 'Volver a método de pago',
                'next-button' => '',
                'event-prev' => null,
                'event-next' => null,

            ],
            [
                'name' => 'Revisión',
                'status' => '',
                'number' => 5,
                'icon' => 'czi-check-circle',
                'prev-button' => 'Continuar comprando',
                'next-button' => 'Descargar',
                'event-prev' => null,
                'event-next' => null,

            ],

        ];

        //Initialize active step
        $this->activeStep = $this->steps[1];

        //Get items
        $this->items = $this->getItems();

        $this->subtotal = $this->getSubTotal();
        $this->total = $this->getTotal();
//dd($this->cart);
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }

    public function prevStep()
    {
        if ($this->activeStep['event-prev']) {
            $this->emit($this->activeStep['event-prev']);
        } else {
            $currentStep = array_search($this->activeStep, $this->steps);

            if ($currentStep > 0) {
                $this->steps[$currentStep]['status'] = '';
                $this->activeStep = $this->steps[$currentStep - 1];
            }
        }
    }
    public function nextStep()
    {
        $this->loading = true;

        //$currentStep  = array_search($this->activeStep, $this->steps);

        if ($this->activeStep['event-next']) {
            $this->emit($this->activeStep['event-next']);
        } else {
            $this->finishTask();
        }
//        $this->activeStep = $this->steps[$currentStep + 1];
        //$this->

    }

    public function getItems()
    {
        return CartItem::whereCartId($this->cart->id)->with('product')->get();

    }

    public function addShipping($selected, $item)
    {



        $cartItem = CartItem::find($item);

        $shippingId = $selected['id'];
        $shippingTotal = $selected['price']; // * $cartItem->qty;

        $cartItem->shipping_id = $shippingId;
        $cartItem->shipping_total = $shippingTotal; // * $cartItem->qty; ;
        $cartItem->update();
        //$this->shippingtotal += $shippingTotal;

        $this->total = $this->getTotal();
        $this->cart->total = $this->total;
        $this->cart->shipping_total = $this->shippingtotal; // //$shippingTotal;// *  $cartItem->qty);
        $this->cart->update();
    }

    private function getSubTotal(): float
    {
        $subtotal = 0;
        foreach ($this->getItems() as $item) {
            $subtotal += $item->price * $item->qty;
        }
        return $subtotal;
    }
    private function getTotal(): float
    {
        $this->shippingtotal = 0;
        $total = 0;
        foreach ($this->getItems() as $item) {

            $total += $item->price * $item->qty;
            $this->shippingtotal += ($item->shipping_total * $item->qty);
        }
        $total += $this->shippingtotal;
        if ($total <= 0) {
            $subtotal = 0;
            $total = 0;
            $shippingtotal;
            $this->canContinue = false;
        } else {
            $this->canContinue = true;
        }
        return $total;
    }

    public function finishTask()
    {

        $currentStep = array_search($this->activeStep, $this->steps);
        $this->steps[$currentStep + 1]['status'] = 'active';
        $this->activeStep = $this->steps[$currentStep + 1];

        $this->loading = false;
    }

    public function notFinishTask()
    {

        $this->loading = false;
    }

    public function pay()
    {

        //get cart addresses ;
        $addressShipping = [
            'address_street' => $this->cart->address_street,
            'address_number' => $this->cart->address_number,
            'address_office' => $this->cart->address_office,
            'address_commune_id' => $this->cart->address_commune_id,
        ];
        $addressShipping = json_encode($addressShipping);
        $addressInvoiceCart = null;
        if ($this->cart->invoice_value) {
            $addressInvoiceCart = $this->cart->invoice_value;
        }

        $addressData = [
            'addressShipping' => $addressShipping,
            'addressInvoice' => $addressInvoiceCart,
        ];

        $order = new Order();
        $order->company_id = $this->cart->company_id;
        $order->uid = $this->cart->uid;
        $order->first_name = $this->cart->first_name;
        $order->last_name = $this->cart->last_name;
        $order->email = $this->cart->email;
        $order->phone = $this->cart->phone;
        $order->cellphone = $this->cart->cellphone;
        $order->currency_id = $this->cart->currency_id;
        $order->customer_id = $this->cart->customer_id;
        $order->json_value = json_encode($addressData);
        $order->status = 1; //initiated
        $order->save();

        $shippingtotal_order = 0;
        $subtotal_order = 0;
        $total_order = 0;

        //Add Order Item
        foreach ($this->getItems() as $item) {
            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->seller_id = $item->product->seller->id;
            $orderitem->currency_id = 63;
            $orderitem->product_id = $item->product->id;
            $orderitem->name = $item->product->name;
            $orderitem->sku = $item->product->sku;
            $orderitem->price = $item->product->price;
            $orderitem->qty = $item->qty;
            $orderitem->shipping_id = $item->shipping_id;
            $orderitem->shipping_total = $item->shipping_total;
            $orderitem->sub_total = $item->price * $item->qty;
            $orderitem->total = ($item->price * $item->qty) + $item->shipping_total;
            $orderitem->save();
            $shippingtotal_order += $item->shipping_total * $item->qty;
            $subtotal_order += $item->price * $item->qty;
            $total_order += ($item->price + $item->shipping_total) * $item->qty;

        }

        $order->shipping_total = $shippingtotal_order;
        $order->sub_total = $subtotal_order;
        $order->total = $total_order;

        $order->save();



        return redirect()->to(route('transbank.webpayplus.mall.redirect', ['order' => $order]));
    }

    public function updateTotals()
    {

        $this->cart->recalculateSubtotal();
        $this->cart->update();
        $this->subtotal = $this->getSubTotal();
        $this->total = $this->getTotal();
        $this->emit('dropdown.update');
        $this->emit('cart.updateSubtotal');

    }

    public function cartpreview()
    {
        return redirect('shopping-cart');
    }

}
