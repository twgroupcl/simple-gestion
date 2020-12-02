<?php

namespace App\Services\DTE\Traits;

trait DTEArray
{
    public function toArray()
    {
        $seller = $this->invoice->seller;
        $customerAddress = $this->invoice->address;
        //dd($customerAddress, $this->invoice);
    
        $itemsDTE = [];

        $itemsDTE = $this->prepareItems();

        $globalDiscounts = null;
        if ($this->invoice->discount_percent > 0) {
            $globalDiscounts = [
                'TpoMov' => 'D',
                'ValorDR' => $this->invoice->discount_percent,
                'TpoValor' => '%'
            ];
        } else if ($this->invoice->discount_amount > 0) {
            $globalDiscounts = [
                //Discount, by default Recharge
                'TpoMov' => 'D',
                'ValorDR' => $this->invoice->discount_amount,
                'TpoValor' => '$'
            ]; 
        } 

        return [
            'Encabezado' => [
                'IdDoc' => [
                    'TipoDTE' => self::TYPE,
                    'TpoTranCompra' => false,
                    'FmaPago' => 1, //Obligar contado por defecto. 2Credito - 3SinCosto (false = 2)
                    'FmaPagExp' => false, //Ventas del giro 1, ventas activo fijo 2, Venta bien raiz 3
                    'MedioPago' => false,
                    'TpoCtaPago' => false,
                    'NumCtaPago' => false,
                    'BcoPago' => false,
                    'TermPagoCdg' => false,
                    'TermPagoGlosa' => false,
                    'TermPagoDias' => false,
                    'FchVenc' => false
                ],
                'Emisor' => [
                    'RUTEmisor' => sanitizeRUT($seller->uid),
                ],
                'Receptor' => [
                    'RUTRecep' => sanitizeRUT($this->invoice->uid),
                    'RznSocRecep' => $this->invoice->first_name . ' ' . $this->invoice->last_name,
                    'GiroRecep' => 'Informática', // this is required in 33
                    'DirRecep' => $customerAddress->street . ' ' . $customerAddress->number . 
                                !empty($customerAddress->subnumber) ? 
                                    $customerAddress->subnumber : 
                                    '',
                    'CmnaRecep' => $customerAddress->commune->name,
                ],
                'Totales' => [
                    'TpoMoneda' => 'CLP',
                    //'MntTotal' => 
                ],
            ],
            'Detalle' => $itemsDTE,
            'DscRcgGlobal' => $globalDiscounts,
            'Comisiones' => false,
            'Referencia' => false,
            'SubTotInfo' => false
        ];
    }

    private function prepareItems() {
        $items = $this->invoice->invoice_items;
        $itemsDTE= [];

        foreach ($items as $item) {
            $itemArray = [
               // 'CdgITem' => [
               //     'TipoCodigo' => 'INT1',
               //     'VlrCodigo' => 'dte-cert'
               // ],
               // 'UnmdItem' => 'Hora' // Unidad de medida
                'NmbItem' => $item->name,
                'QtyItem' => $item->qty,
                'PrcItem' => isset($item->custom_price) ? 
                    round($item->custom_price, 2, PHP_ROUND_HALF_ODD) : 
                    round($item->price, 2, PHP_ROUND_HALF_ODD)
            ];

            if ($item->discount_amount > 0) {
                $itemArray = array_merge($itemArray, [
                    'DescuentoMonto' => round($item->discount_amount, 2, PHP_ROUND_HALF_ODD)
                ]);
            } else if ($item->discount_percent > 0) {
                $itemArray = array_merge($itemArray, [
                    'DescuentoPct' => round($item->discount_percent, 2, PHP_ROUND_HALF_ODD)
                ]);
            }
            $itemsDTE[] = $itemArray;
        }

        return $itemsDTE;
    }

}
