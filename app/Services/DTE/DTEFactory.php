<?php

namespace App\Services\DTE;

use App\Models\Invoice;
//use App\Services\DTE\{ElectronicInvoice};

class DTEFactory
{
    public static function init(int $type, Invoice $invoice)
    {
        switch($type) {
            case 33:
                return new ElectronicInvoice($invoice);
                break;
        }
    }
}
