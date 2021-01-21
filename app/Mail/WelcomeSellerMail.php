<?php

namespace App\Mail;

use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeSellerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $text;
    public $rejectedText;
    public $buttonText, $buttonLink;
    public $logo;
    public $receiver;

    /**
     * Create a new message instance.
     *
     * @param Seller $seller
     * @param int $receiver // 1 - Vendedor, 2 - Administrador
     * @return void
     */
    public function __construct(Seller $seller, int $receiver)
    {
        $this->receiver = $receiver;
        $this->rejectedText = '';
        $this->logo = 'img/logo-pyme.png';
        if ($this->receiver === 1) {
            $this->title = '¡Bienvenido a ContigoPYME!';
            $this->text = 'Bienvenido <strong>' . $seller->visible_name . '</strong>, tu cuenta de vendedor ha sido creada, pero se encuentra
            en espera de aprobación.<br /><br />El administrador se pondrá en contacto contigo para solicitarte los datos necesarios 
            para unirte a ContigoPYME. Una vez que esté todo gestionado recibirás un correo con tus datos de acceso';
            $this->buttonText = '';
            $this->buttonLink = '';
        } else if ($this->receiver === 2) {
            $this->title = '¡Un nuevo vendedor se ha registrado!';
            $this->text = 'El vendedor <strong>' . $seller->visible_name . '</strong> se ha registrado y requiere tu aprobación. 
            <br /><br />Para aprobrarlo o rechazarlo ingresa al panel de administrador.';
            $this->buttonText = 'Panel administrador';
            $this->buttonLink = config('app.url') . '/admin';
        }
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->receiver === 1) $title = 'Tu cuenta de vendedor ha sido creada.';
        if ($this->receiver === 2) $title = 'Un nuevo vendedor se ha registrado y espera tu aprobacion';

        return $this->subject($title)->view('maileclipse::templates.basicEmailTemplate');
    }
}
