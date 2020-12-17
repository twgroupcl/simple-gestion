<?php

namespace App\Services\DTE\Traits;

trait DTEArray
{
    public function toArray()
    {
        $emitter = $this->invoice->company;
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
                'TpoMov' => 'D', //discount D o recharge R
                'ValorDR' => $this->invoice->discount_amount,
                'TpoValor' => '$',
                //'IndExeDR' => 1 // Afecta a productos exentos
            ]; 
        } 

        return [
            'Encabezado' => [
                'IdDoc' => [
                    'TipoDTE' => self::TYPE,
                    'TpoTranCompra' => false,
                    'FmaPago' => $this->invoice->way_to_payment ?? 1, //Obligar contado por defecto. 2Credito - 3SinCosto (false = 2)
                    //'FmaPagExp' => false, //Ventas del giro 1, ventas activo fijo 2, Venta bien raiz 3
                    'MedioPago' => !empty($this->invoice->payment_method) ? $this->invoice->payment_method : false,
                    'TpoCtaPago' => !empty($this->invoice->bank_account_type) ? $this->invoice->bank_account_type->getTypeForDTE() : false,
                    'NumCtaPago' => !empty($this->invoice->bank_number_account) ? $this->invoice->bank_number_account : false,
                    'BcoPago' => !empty($this->invoice->bank) ? $this->invoice->bank->name : false,
                    'TermPagoCdg' => false,
                    'TermPagoGlosa' => $this->invoice->notes ?? false,
                    'TermPagoDias' => false,
                    'FchEmis' => $this->invoice->invoice_date ?? false,
                    'FchVenc' => $this->invoice->expiry_date ?? false //AAAA-MM-DD
                ],
                'Emisor' => [
                    'RUTEmisor' => sanitizeRUT($emitter->uid),
                    'CdgVendedor' => isset($this->invoice->seller_id) ? $this->invoice->seller->visible_name : false,
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
                /*'Totales' => [
                    'TpoMoneda' => !empty($this->invoice->currency) ? $this->invoice->currency->code : 'CLP',
                    //'MntTotal' => 
                ],*/
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
                    round($item->price, 2, PHP_ROUND_HALF_ODD),
                'DscItem' => empty($item->description) ? false : $item->description,
                'CodImpAdic' => !empty($item->additional_tax) ? $item->additional_tax->code : false,

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
