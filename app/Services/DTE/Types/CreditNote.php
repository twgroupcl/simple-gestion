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

        $array['Referencia'] = [
            //'TpoDocRef' =>
            //"FolioRef": 1,
            //"FchRef": "2016-01-01",
            //"CodRef": 1,
            'RazonRef' => 'Anula factura',
        ];

        return $array;
    }

}
