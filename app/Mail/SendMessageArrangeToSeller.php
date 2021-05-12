<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Seller;

class NotificationSuscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //public $data;
    public $order;
    public $seller;

    public function __construct(Seller $seller, Order $order)
    {
        $this->seller = $seller;
        $this->order = $order;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Un cliente ha dejado un mensaje para acordar envío.')->view('maileclipse::templates.notificationSuscriptionTemplate');
    }
}
