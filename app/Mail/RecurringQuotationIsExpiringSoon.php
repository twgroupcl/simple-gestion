<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\ReservationRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecurringQuotationIsExpiringSoon extends Mailable
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
     * @param Quotation $quotation
     *
     * @return void
     */
    public function __construct(Quotation $quotation)
    {


        $this->rejectedText = '';

        $this->company = $quotation->firstCompany() ?? null;
        $nextDueDate = new Carbon($quotation->next_due_date);
        $this->title= 'Confirmación Renovación Suscripción';
        $this->email = $this->company->getBusinessAdminUsers()->first()->email ?? '';
        $this->text = 'Hola ' . $quotation->customer->first_name . ' ' . $quotation->customer->last_name . ',<br> 
                      te queremos agradecer por confiar en nuestros servicios. Tu suscripción está a pocos días de ser renovada, 
                      siendo la fecha de tu próxima facturación el '. $nextDueDate->format('d-m-Y') .'.<br><br>
                      En el botón de abajo podrás acceder a una página donde encontrarás los detalles de tu suscripción.
                      Si decides cancelarla, comunícate directamente con nosotros al 
                      correo ' . $this->email . ' o vía telefónica.';              
        $this->buttonText = 'Ver detalles';
        $this->buttonLink = route('quotation.recurring.details', [ 'quotation' => $quotation, 'company' => $this->company]);
        $this->logo = '';     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación Renovación Suscripción - ' . $this->company->name)->view('maileclipse::templates.basicEmailTemplate');
    }
}
