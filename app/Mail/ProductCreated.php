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
    public function __construct(Product $product)
    {
        $this->rejectedText = '';
        $this->title= 'Un nuevo producto ha sido creado';
        $this->text = 'La tienda <strong>' . $product->seller->visible_name . '</strong> ha publicado el siguiente producto: <strong>' . $product->name . '</strong>.<br><br> Puedes acceder al panel de administrador para aprobarlo o rechazarlo.'; 
        $this->buttonText = 'Ir al panel';
        $this->buttonLink = config('app.url') . '/admin';
        $this->logo = 'img/logo-pyme.png';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Un nuevo producto ha sido creado')->view('maileclipse::templates.basicEmailTemplate');
    }
}
