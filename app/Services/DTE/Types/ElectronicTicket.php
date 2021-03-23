<?php

namespace App\Services\DTE\Types;

use App\Models\Invoice;
use App\Models\Product;
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
        $array = $this->ttArray(true);

        if ($this->invoice->customer->is_foreign) {
            $array['Encabezado']['Receptor']['RUTRecep'] = Invoice::FOREIGN_RUT;
        }

        // En las boletas los montos deben ser brutos (con IVA incluido)
        foreach ($array['Detalle'] as $key => $item) {

            // Si la boleta fue creada desde el POS, obtenemos el precio de los items directamente
            // desde la BD para evitar errores de redondeo con el IVA. Si fue creada desde el CRUD
            // de invoices o cotizaciones, aplicamos el calculo del IVA al precio unitario
            if (isset($this->invoice->json_value['source']) && $this->invoice->json_value['source'] === 'pos' && $item['ItemCodigo']) {
                $itemPriceWithIva = round(Product::find($item['ItemCodigo'])->real_price, 2);
            } else {
                $itemPriceWithIva  = round($array['Detalle'][$key]['PrcItem'] * 1.19, 2, PHP_ROUND_HALF_ODD);
            }
            
            $array['Detalle'][$key]['PrcItem'] = $itemPriceWithIva;

            if (isset($item['DescuentoMonto']) && $item['DescuentoMonto'] > 0) {
                $discountWIthIva = round($array['Detalle'][$key]['DescuentoMonto'] * 1.19, 0, PHP_ROUND_HALF_ODD);
                $array['Detalle'][$key]['DescuentoMonto'] = $discountWIthIva;
            }

            unset($array['Detalle'][$key]['ItemCodigo']);
        }

        return ($array);
     }

}
