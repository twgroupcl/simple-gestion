<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ReservationRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $receiver;
    public $reservationRequest;
    public $title;
    public $text;
    public $rejectedText;
    public $buttonText, $buttonLink;
    public $logo;
    public $company;

    /**
     * Create a new message instance.
     * 
     * @param $receiver // 1 - Admin, 2 - Customer
     *
     * @return void
     */
    public function __construct(Int $receiver, ReservationRequest $reservationRequest)
    {
        $this->receiver = $receiver;
        $this->reservationRequest = $reservationRequest;
        $this->rejectedText = '';
        //dd($this->company = $reservationRequest->customer->companies);
        $this->company = $reservationRequest->customer->company ?? null;
        
        $customerEmail = $this->reservationRequest->customer->email ?? 'No disponible';
        $customerCellphone = $this->reservationRequest->customer->cellphone ?? 'No disponible';

        if ($this->receiver === 1) {
            $this->title= 'Tienes una nueva solicitud de reserva';
            $this->text = 'El cliente <strong>' . $this->reservationRequest->customer->full_name . '</strong> ha realizado una solicitud de reserva: <br><br>
                        Fecha de reserva: '. $reservationRequest->date . ' <br>
                        Servicio: '. $reservationRequest->service->name . ' <br>
                        Bloque horario: '. $reservationRequest->timeblock->name_with_time . ' <br><br>
                        Información de contacto del cliente: <br><br>
                        Nombre: '. $this->reservationRequest->customer->full_name .'<br>
                        Correo: '. $customerEmail .'<br>
                        Número de teléfono: '. $customerCellphone .'<br><br>
                        Puedes acceder al panel de administración y ver todas las solicitudes de reserva.';
            $this->buttonText = 'Ir al panel';
            $this->buttonLink = config('app.url') . '/admin';
            $this->logo = '';
        } else if ($this->receiver === 2) {
            $this->title= 'Tu solicitud de reserva fue enviada con éxito';
            $this->text = 'El administrador se pondrá en contacto contigo para responder a tu solicitud. Información de tu reserva: <br><br>
                        Fecha de reserva: '. $reservationRequest->date . ' <br>
                        Servicio: '. $reservationRequest->service->name . ' <br>
                        Bloque horario: '. $reservationRequest->timeblock->name_with_time . ' <br><br>';
            $this->buttonText = '';
            $this->buttonLink = '';
            $this->logo = '';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->receiver === 1) {
            return $this->subject('Tienes una nueva solicitud de reserva.')->view('maileclipse::templates.basicEmailTemplate');
        } else {
            return $this->subject('Tu solicitud de reserva fue enviada con exito.')->view('maileclipse::templates.basicEmailTemplate');

        }
    }
}
