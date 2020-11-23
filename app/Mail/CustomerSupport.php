<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerSupport extends Mailable
{
    use Queueable, SerializesModels;

    public $logo;
    public $title;
    public $text;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logo = 'img/filsa-banner.jpg';
        $this->title = '¡Tu solicitud ha sido recibida!';
        $this->text = 'Muchas gracias por contactarte con nosotros y ayudarnos a mejorar tu experiencia. Vamos a revisar el detalle de lo enviado y te responderemos a la brevedad. Que tengas un buen día.';
        $this->subject = $this->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('¡Tu solicitud ha sido recibida!')
                    ->cc(env('MAIL_FILSA_ADDRESS'))
                    ->view('maileclipse::templates.customerSupport');
    }
}
