<?php

namespace App\Exports\PriceList;

use App\Models\PriceList;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PriceListExport implements FromArray, WithMapping , WithHeadings, ShouldAutoSize
{
    private $priceList;

    public function __construct($companyId, int $priceListId)
    {
        $this->priceList = PriceList::with('priceListItems.product')->where('id', $priceListId)->first();
    }

    public function array() : array
    {
        return $this->priceList->priceListItems->sortBy('product.sku')->toArray();
    }

    /**
     * Row head in document
     */
    public function headings(): array
    {

        $name = [
            'Nombre',
            $this->priceList->name,
        ];

        $code = [
            'Codigo',
            $this->priceList->code,
        ];

        $emptyRow = [
            ' ',
            ' ',
        ];

        $principalHeading = [
            'SKU',
            'Nombre',
            'Costo',
            'Precio',
        ];

        return [
            $name,
            $code,
            $emptyRow,
            $principalHeading,
        ];
    }

    public function map($item): array
    {
        $row = [
            $item['product']['sku'],
            $item['product']['name'],
            $item['cost'],
            $item['price'],
        ];

        return $row;
    }
}
