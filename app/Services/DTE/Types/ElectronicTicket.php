<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Services\DTE\Traits\DTEArray;

class ElectronicTicket implements DocumentType
{
    use DTEArray { toArray as ttArray; }

    const TYPE=39;
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /*
     * Override use Traits\DTEArray { toArray as ttArray; }
     * call with $this->ttArray() and override function toArray() 
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

        // En las boletas los montos deben ser brutos (con IVA incluido)
        foreach ($array['Detalle'] as $key => $item) {
            $itemPriceWithIva  = round($array['Detalle'][$key]['PrcItem'] * 1.19, 2, PHP_ROUND_HALF_ODD);
            $array['Detalle'][$key]['PrcItem'] = $itemPriceWithIva;

            if (isset($item['DescuentoMonto']) && $item['DescuentoMonto'] > 0) {
                $discountWIthIva = round($array['Detalle'][$key]['DescuentoMonto'] * 1.19, 0, PHP_ROUND_HALF_ODD);
                $array['Detalle'][$key]['DescuentoMonto'] = $discountWIthIva;
            }
        }

        return ($array);
     }

}
