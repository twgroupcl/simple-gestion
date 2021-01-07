<?php

namespace App\Mail;

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
        
        $this->title= 'Tu suscripción está por finalizar';
        $this->text = 'Estimado cliente, te informamos que tu suscripción está cercana a unos días de finalizar. <br><br>
                       En el botón de abajo podrás acceder a una página donde encontraras los detalles de tu 
                       suscripción y la opción de terminarla en caso de que no desees continuar con nuestro servicio.';

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
        return $this->subject('Tu suscripción está por finalizar - ' . $this->company->name)->view('maileclipse::templates.basicEmailTemplate');
    }
}
