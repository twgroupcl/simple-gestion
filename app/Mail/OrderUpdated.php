<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Commune;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ShippingMethod;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;
    public $orderItems;
    public $logo;
    public $addressShipping;
    public $addressInvoice;
    public $communeShipping;
    public $communeInvoice;
    public $paymentData;
    public $title;
    /**
     * Create a new message instance.
     *
     * Int receiver
     * 1-Customer
     * 2-Filter Sellers
     * 3-Admin
     */
    public function __construct(Order $order, Int $receiver, Seller $seller = null)
    {

        //
        if ($order) {
            $this->orderData['id'] = $order->id;
            $this->orderData['fecha'] =  $order->created_at->format('d/m/Y H:i:s');
            $this->orderData['first_name'] =  $order->first_name;
            $this->orderData['last_name'] =  $order->last_name;
            $this->orderData['cellphone'] =  $order->cellphone;



            $addressData = $order->json_value;


            $this->addressShipping = null;
            if (isset($addressData['addressInvoice'])) {

                $this->addressShipping = $addressData['addressShipping'];
            }


            $this->addressInvoice = null;
            if (isset($addressData['addressInvoice'])) {
                $this->addressInvoice = $addressData['addressInvoice'];
            }

            $this->communeShipping = null;
            $this->communeInvoice = null;

            if ($this->addressShipping) {
                $this->communeShipping = Commune::where('id', $this->addressShipping->address_commune_id)->first();
            }

            if ($this->addressInvoice) {
                $this->communeInvoice = Commune::where('id', $this->addressInvoice->address_commune_id)->first();
            }

            //If receiver is seller, filter items by seller
            if ($receiver == 2) {
                $this->title = 'Orden generada';
                //$this->orderItems = $order->order_items()->;
                foreach ($order->order_items as $item) {
                    if ($item->product->seller->id == $seller->id) {
                        $shipping_method = ShippingMethod::where('id', $item->shipping_id)->first();
                        $item->shipping_method = $shipping_method;
                        $this->orderItems[] = $item;
                    }
                }
            } else {
                if ($receiver == 1) {
                    $this->paymentData['title'] = $order->order_payments->first()->method_title;
                    $this->paymentData['date'] = Carbon::createFromFormat('Y-m-d H:i:s', $order->order_payments->first()->created_at)->format('d/m/Y H:i:s');
                    $this->paymentData['total'] =  currencyFormat($order->total ? $order->total : 0, 'CLP', true);

                    $this->title = '¡Tu orden está lista!';
                }
                // $this->orderItems = $order->order_items;
                foreach ($order->order_items as $item) {

                    $shipping_method = ShippingMethod::where('id', $item->shipping_id)->first();
                    $item->shipping_method = $shipping_method;
                    $this->orderItems[] = $item;
                }
            }
        }
        $this->logo = 'img/logo-pyme.png';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('maileclipse::templates.orderEmailTemplate');
    }
}
