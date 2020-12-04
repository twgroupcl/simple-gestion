<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Services\DTE\Traits\DTEArray;
use App\Models\InvoiceType;

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

        $referenceData = is_array($this->invoice->json_value) ? 
            $this->invoice->json_value : json_decode($this->invoice->json_value, true);

        $tpoDocRef = $this->getRefDataByKey($referenceData, 'reference_type_document') ?? false;

        if ($tpoDocRef) {
            $tpoDocRef = InvoiceType::find($tpoDocRef)->code;
        }

        $array['Referencia'] = [
            'TpoDocRef' => $tpoDocRef, 
            'FolioRef' => $this->getRefDataByKey($referenceData, 'reference_folio') ?? false,
            'FchRef' =>  $this->getRefDataByKey($referenceData, 'reference_date') ?? false,
            'CodRef' => $this->getRefDataByKey($referenceData, 'reference_code') ?? false,
            //'CodRef' => 1, 1-Anula 2-CorrigeTextDocDeRef 3-CorrigeMonto
            'RazonRef' => $this->getRefDataByKey($referenceData, 'reference_reason') ?? false, 
        ];

        return $array;
    }

    private function getRefDataByKey($array, string $key) : ?string
    {
        if (! array_key_exists($key, $array)) {
            return null;
        }

        return $array[$key];
    }

}
