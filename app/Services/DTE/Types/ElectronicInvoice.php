<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;

class ElectronicInvoice implements DocumentType
{
    use Traits\DTEArray;

    const TYPE=33;
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /*
     * Override use Traits\DTEArray { toArray as ttArray; }
     * call with $this->ttArray() and override function toArray() 
    */

}
