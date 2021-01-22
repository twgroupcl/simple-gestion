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
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, $seller)
    {
        $this->company = $product->company;
        $this->rejectedText = '';
        $this->title= 'Un nuevo producto ha sido creado';
        $this->text = 'El venedor <strong>' . $seller . '</strong> ha agregado el siguiente producto: <strong>' . $product->name . '</strong>.<br><br> Puedes acceder al panel de administrador para ver los detalles.';
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
        return $this->subject('Un nuevo producto ha sido creado - '. $this->company->name)->view('maileclipse::templates.basicEmailTemplate');
    }
}
