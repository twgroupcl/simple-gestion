<?php

namespace App\Mail;

use App\Models\Commune;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPayedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $publicaddressInfo;
    public $shippingInfo;
    public $communeShipping;
    public $receiver;
    public $subject;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, int $receiver)
    {
        $this->order = $order;

        if ($receiver === 1) {
            $this->title = '¡Gracias por tu compra!';
            $this->subject = '¡Gracias por tu compra! Orden #' . $order->id; 
        } else if ($receiver === 2) {
            $this->title = '¡Se ha generado una nueva venta!';
            $this->subject = '!Se ha generado una nueva venta! Orden #' . $order->id;
        }

        $this->addressInfo = $order->json_value;
        $this->shippingInfo = $this->addressInfo['addressShipping'];
        $this->communeShipping = Commune::find($this->shippingInfo->address_commune_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('order.email_order');
    }
}
