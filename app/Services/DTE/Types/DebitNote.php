<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Services\DTE\Traits\DTEArray;
use App\Models\InvoiceType;

class DebitNote implements DocumentType
{
    use DTEArray { toArray as ttArray; }

    const TYPE=56;
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

        if ($this->invoice->customer->is_foreign) {
            $array['Encabezado']['Receptor']['RUTRecep'] = Invoice::FOREIGN_RUT;
        }


        return $array;
    }


}
