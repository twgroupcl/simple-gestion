<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationSuscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data['seller'] = $data['seller'];
        $this->data['plan'] = $data['plan'];
        $this->data['price'] = $data['price'];
        $this->data['currency'] = $data['currency'];
        $this->data['start_date'] = $data['start_date'];
        $this->data['end_date'] = $data['end_date'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de suscripción')->view('maileclipse::templates.notificationSuscriptionTemplate');
    }
}
