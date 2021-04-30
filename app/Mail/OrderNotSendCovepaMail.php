<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNotSendCovepaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $apiResponse;
    public $jsonData;
    public $e;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $apiResponse, $e = null, $jsonData = null)
    {
        $this->order = $order;
        $this->apiResponse = $apiResponse;
        $this->jsonData = $jsonData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('order.order_not_send');
    }
}
