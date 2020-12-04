<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Services\DTE\Traits\DTEArray;

class CreditNote implements DocumentType
{
    use DTEArray { toArray as ttArray; }

    const TYPE=61;
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /*
     * Override use Traits\DTEArray { toArray as ttArray; }
     * call with $this->ttArray() and override function toArray() 
     *
     * public function toArray() {
     *      return $this->ttArray();
     * }
     */
    public function toArray()
    {
        $array = $this->ttArray();

        $referenceData = json_decode($this->invoice->json_value, true);

        $refDataExists = $this->checkReferenceData($referenceData);
        
        $array['Referencia'] = [
            'TpoDocRef' => $refDataExists ? $referenceData['reference_type_document'] : false,
            'FolioRef' => $refDataExists ? $referenceData['reference_folio'] : false,
            'FchRef' =>  $refDataExists ? $referenceData['reference_date'] : false,
            //'CodRef' => 1, 1-Anula 2-CorrigeTextDocDeRef 3-CorrigeMonto
            'RazonRef' => 'Anula factura',
        ];

        return $array;
    }

    private function checkReferenceData($array) : bool
    {
        return array_key_exists('reference_type_document', $array) || 
            array_key_exists('reference_folio', $array) ||
            array_key_exists('reference_date', $array);
    }

}
