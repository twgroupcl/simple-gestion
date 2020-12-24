<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ReservationRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CriticalStockAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $title;
    public $text;
    public $rejectedText;
    public $buttonText, $buttonLink;
    public $logo;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->rejectedText = '';

        $this->company = $product->seller->company ?? null;


        $this->title= 'El producto ' . $this->product->name . ' ha caido por debajo del stock minimo';
        $this->text = 'El product <strong>' . $this->product->name . '</strong> ha caido por debajo del stock minimo (' . $this->product->critical_stock .')';
        $this->buttonText = 'Ir al panel';
        $this->buttonLink = config('app.url') . '/admin';
        $this->logo = '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('El producto ' . $this->product->name . ' ha caido por debajo del stock minimo.')->view('maileclipse::templates.basicEmailTemplate');
    }
}
