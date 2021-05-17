<?php

namespace App\Services\DTE\Traits;
use App\Models\InvoiceType;

trait DTEArray
{
    public function toArray($includeItemCod = false)
    {
        $emitter = $this->invoice->company;
        $customerAddress = $this->invoice->address;
        //dd($customerAddress, $this->invoice);
    
        $itemsDTE = [];

        $itemsDTE = $this->prepareItems($includeItemCod);

        $globalDiscounts = false;
        if ($this->invoice->discount_percent > 0) {
            $globalDiscounts = [
                'TpoMov' => 'D',
                'ValorDR' => round($this->invoice->discount_percent, 2),
                'TpoValor' => '%'
            ];
        } else if ($this->invoice->discount_amount > 0) {
            $globalDiscounts = [
                //Discount, by default Recharge
                'TpoMov' => 'D', //discount D o recharge R
                'ValorDR' => round($this->invoice->discount_amount, 2),
                'TpoValor' => '$',
                //'IndExeDR' => 1 // Afecta a productos exentos
            ]; 
        } 

        //references to dte
        $referencesData = is_array($this->invoice->references_json) ? 
            $this->invoice->references_json : json_decode($this->invoice->references_json, true);

        $referencesArray = [];
        foreach($referencesData as $reference) {
            $tpoDocRef = $this->getRefDataByKey($reference, 'reference_type_document') ?? false;

            if ($tpoDocRef) {
                $tpoDocRef = InvoiceType::find($tpoDocRef)->code;
            }
            // invoice item exent true or false
            //if ($tpoDocRef == 41 || $tpoDocRef == 34) {
            //    foreach ($array['Detalle'] as $key => $item) {
            //        $array['Detalle'][$key]['IndExe'] = 1;
            //    }

            //    if ($this->invoice->discount_percent > 0 || $this->invoice->discount_amount > 0) {
            //        $array['DscRcgGlobal']['IndExeDR'] = 1;
            //    }
            //}

            $referencesArray[] = [
                'TpoDocRef' => $tpoDocRef, 
                'FolioRef' => $this->getRefDataByKey($reference, 'reference_folio') ?? false,
                'FchRef' =>  $this->getRefDataByKey($reference, 'reference_date') ?? false,
                'CodRef' => $this->getRefDataByKey($reference, 'reference_code') ?? false,
                //'CodRef' => 1, 1-Anula 2-CorrigeTextDocDeRef 3-CorrigeMonto
                'RazonRef' => $this->getRefDataByKey($reference, 'reference_reason') ?? false, 
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
                    'CdgVendedor' =>  isset($this->invoice->seller_id) ? $this->invoice->seller->visible_name : false,
                ],
                'Receptor' => [
                    'RUTRecep' => sanitizeRUT($this->invoice->uid),
                    'RznSocRecep' => $this->invoice->first_name . ' ' . $this->invoice->last_name,
                    'GiroRecep' => $this->invoice->business_activity->name ?? 'General', // this is required in 33
                    'DirRecep' => isset($customerAddress)
                                    ? $customerAddress->street . '. ' . $customerAddress->number . ' ' . $customerAddress->subnumber ?? ''
                                    : false,
                    'CmnaRecep' => isset($customerAddress)
                                    ? $customerAddress->commune->name
                                    : false,
                ],
                /*'Totales' => [
                    'TpoMoneda' => !empty($this->invoice->currency) ? $this->invoice->currency->code : 'CLP',
                    //'MntTotal' => 
                ],*/
            ],
            'Detalle' => $itemsDTE,
            'DscRcgGlobal' => $globalDiscounts,
            'Comisiones' => false,
            'Referencia' => $referencesArray,
            'SubTotInfo' => false
        ];
    }

    private function prepareItems($includeItemCod) {
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
                // DscItem - Desactivado porque se imprime con formato incorrecto
                //'DscItem' => empty($item->description) ? false : $item->description,
                'CodImpAdic' => !empty($item->additional_tax) ? $item->additional_tax->code : false,
            ];

            if ($includeItemCod) $itemArray['ItemCodigo'] = $item->product_id ?? null;

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

    private function getRefDataByKey($array, string $key) : ?string
    {
        if (! array_key_exists($key, $array)) {
            return null;
        }

        return $array[$key];
    }

}
