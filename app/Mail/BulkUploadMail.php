<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BulkUploadMail extends Mailable
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
    public function __construct($seller, $nroProducts)
    {
        $this->seller = $seller;
        $this->nroProducts = $nroProducts;
        $this->rejectedText = '';
        $this->title= 'La libreria ' . $seller . ' ha publicado nuevos libros';
        $this->text = 'La libreria <strong>' . $seller . '</strong> ha publicado <strong>' . $nroProducts . '</strong> libros utilizando la carga masiva.<br><br> Puedes acceder al panel de administrador para aprobarlos o rechazarlos.';
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
        return $this->subject($this->seller . ' ha publicado ' . $this->nroProducts .' libros')->view('maileclipse::templates.welcomeCustomer');
    }
}
