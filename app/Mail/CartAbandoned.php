<?php

namespace App\Mail;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartAbandoned extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $logo;
    public $title;
    public $cart;
    public $buttonLink;
    public $buttonText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->subject = $this->cart->customer->email;
        $this->logo = asset('img/logo-pyme.png');
        $this->title = 'Tu carrito ha sido abandonado';
        $this->buttonLink = route('shopping-cart');
        $this->buttonText = 'Ir al carrito';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('maileclipse::templates.abandonedCart');
    }
}
