<?php

namespace App\Mail;

use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerChangeStatus extends Mailable
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
    public function __construct(Seller $seller)
    {
        $this->rejectedText = '';
        if ($seller->getReviewStatus() == 'Aprobado') {
            $this->title = '¡Buenas noticias!';
            $this->text = 'Felicitaciones ' . $seller->visible_name . ', hemos aprobado su cuenta de vendedor.';

            $this->buttonText = 'Agregar productos';
            $this->buttonLink = config('app.url') . '/admin';
        } else {
            $this->title = 'Se ha rechazado la solicitud.';
            $this->text = 'Lo sentimos ' . $seller->visible_name . ', hemos rechazado su solicitud para abrir una cuenta de vendedor.';
            if (strlen($seller->rejected_reason) > 0) {
                $this->rejectedText = 'Motivo de rechazo: ' . $seller->rejected_reason;
            }

            $this->buttonText = 'Ir al sitio';
            $this->buttonLink = config('app.url');
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
        return $this->subject('Respuesta de su solicitud')->view('maileclipse::templates.basicEmailTemplate');
    }
}
