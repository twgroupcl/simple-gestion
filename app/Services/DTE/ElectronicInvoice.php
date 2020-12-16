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
    
        $items = $this->invoice->invoice_items;
        $itemsDTE = [];

        foreach ($items as $item) {
            $itemsDTE[] = [
                'NmbItem' => $item->name,
                'QtyItem' => $item->qty,
                'PrcItem' => isset($item->custom_price) ? $item->custom_price : $item->price
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
            'Detalle' => $itemsDTE
        ];
    }
}
