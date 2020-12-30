<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Services\DTE\Traits\DTEArray;

class ExemptElectronicInvoice implements DocumentType
{
    use DTEArray { toArray as ttArray; }

    const TYPE=34;
    protected $invoice;

    /*
     * Area IdDoc (identificacion de documento)
     * FmaPago -> 1 contado, 2 credito, 3 sin costo (entrega grat)
     * Fin area IdDoc
     *
     * IndExe (Garantia de deposito, producto o serv exento a impuesto o si ya fue facturado. Si todos los items tienen valor 1 en este indicador, la factura no puede ser cod 33, tiene que ser cod 34).
     *
     * Item MontoItem -> es  el valor exento por linea de detalle 
     */

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /*
     * Override use Traits\DTEArray { toArray as ttArray; }
     * call with $this->ttArray() and override function toArray() 
    */
    public function toArray()
    {
        $array = $this->ttArray();

        if ($this->invoice->customer->is_foreign) {
            $array['Encabezado']['Receptor']['RUTRecep'] = Invoice::FOREIGN_RUT;
        }

        //$array['Encabezado']['IdDoc']['FchEmis'] = '2020-11-30';
        /*$array['Encabezado']['IdDoc'] = array_merge($array['Encabezado']['IdDoc'], [
            'FchEmis' => '2020-11-30',
        ]);*/

        // add Item exent
        foreach ($array['Detalle'] as $key => $item) {
            $array['Detalle'][$key]['IndExe'] = 1;
        }
        
        return ($array);
    }

}
