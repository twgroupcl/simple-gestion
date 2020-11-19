<?php

namespace App\Services\DTE;

use App\Models\Invoice;

class ElectronicInvoice implements DocumentType
{
    const TYPE=33;
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

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
            ],
            'Detalle' => $itemsDTE,
            'DscRcgGlobal' => $globalDiscounts 
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
                'NmbItem' => $item->name,
                'QtyItem' => $item->qty,
                'PrcItem' => isset($item->custom_price) ? $item->custom_price : $item->price,
            ];

            if ($item->discount_amount > 0) {
                $itemArray = array_merge($itemArray, [
                    'DescuentoMonto' => $item->discount_amount
                ]);
            } else if ($item->discount_percent > 0) {
                $itemArray = array_merge($itemArray, [
                    'DescuentoPct' => $item->discount_percent
                ]);
            }
            $itemsDTE[] = $itemArray;
        }

        return $itemsDTE;
    }
}
