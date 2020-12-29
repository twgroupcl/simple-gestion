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

        // En las boletas los montos deben ser brutos (con IVA incluido)
        // TODO redondear montos 
        foreach ($array['Detalle'] as $key => $item) {
            $array['Detalle'][$key]['PrcItem'] = $array['Detalle'][$key]['PrcItem'] * 1.19;

            if (isset($item['DescuentoMonto']) && $item['DescuentoMonto'] > 0) {
                $array['Detalle'][$key]['DescuentoMonto'] = $array['Detalle'][$key]['DescuentoMonto'] * 1.19;
            }
        }

        return ($array);
     }

}
