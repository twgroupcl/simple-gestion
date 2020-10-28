<?php

namespace App\Services\Quiotations;

use App\Models\Quotation;

class QuotationService {

    public function generatePDF($quotation) 
    {
        $pdf = \PDF::loadView('templates.quotations.pdf_export', [
            'quotation' => $quotation,
            'due_date' => new Carbon($quotation->quotation_date),
            'creation_date'=> new Carbon($quotation->expiry_date),
            'title' => 'Cotizacion',
        ]);

        return $pdf->stream('invoice.pdf');
    }

}

?>