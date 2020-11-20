<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $text;
    public $rejectedText;
    public $buttonText, $buttonLink;
    public $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, $seller)
    {
        $this->rejectedText = '';
        $this->title= 'Un nuevo libro ha sido creado';
        $this->text = 'La tienda <strong>' . $seller . '</strong> ha publicado el siguiente libro: <strong>' . $product->name . '</strong>.<br><br> Puedes acceder al panel de administrador para aprobarlo o rechazarlo.';
        $this->buttonText = 'Ir al panel';
        $this->buttonLink = config('app.url') . '/admin';
        $this->logo = 'img/filsa-banner.jpg';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Un nuevo libro ha sido publicado')->view('maileclipse::templates.welcomeCustomer');
    }
}
