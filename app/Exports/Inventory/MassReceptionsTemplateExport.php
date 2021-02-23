<?php

namespace App\Exports\Inventory;

use App\Models\Product;
use App\Models\ProductInventorySource;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MassReceptionsTemplateExport implements FromArray, WithMapping , WithHeadings, WithColumnWidths, ShouldAutoSize
{
    protected $productInventorySources;
    protected $products;
    private $options;

    public function __construct($companyId, array $options = [])
    {
        $this->setOptions($options);

        $this->productInventorySources = ProductInventorySource::where('company_id', $companyId)->get();
        $this->products = $this->options['includeProducts'] 
            ? Product::select('sku', 'name')->where('company_id', $companyId)->whereDoesntHave('children')->get() 
            : null;
    }

    public function array() : array
    {
        if ($this->products) {
            return $this->products->toArray();
        }

        return [];
    }

    /**
     * Row head in document
     */
    public function headings(): array
    {

        $stock = [
            'Suma o reemplaza stock',
            $this->options['replaceStock'] ? '[reemplaza]' : '[suma]',
        ];

        $documentNumber = [
            'Numero de documento',
            (string) $this->options['documentNumber'],
        ];

        $priceCostDate = [
            'Fecha de vigencia precios y costos',
            $this->options['priceCostDate'],
        ];

        $helpHeading = [
            ' ',
            ' ',
            ' ',
            ' ',
            ' ',
        ];

        $principalHeading = [
            'SKU',
            'Nombre',
            'Costo',
            'Precio',
        ];

        foreach($this->productInventorySources as $inventory) {
            $principalHeading[] = "$inventory->name [$inventory->code]";
        }

        return [
            $stock,
            $documentNumber,
            $priceCostDate,
            $helpHeading,
            $principalHeading,
        ];
    }

    public function map($product): array
    {
        return [
            $product['sku'],
            $product['name'],
            '',
            '',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 29,
            'B' => 40,
            'C' => 10,        
            'D' => 10,        
        ];
    }

    protected function setOptions($options)
    {
        $this->options = [
            'includeProducts' => $options['includeProducts'] ?? false,
            'replaceStock' => $options['replaceStock'] ?? false,
            'documentNumber' => $options['documentNumber'] ?? ' ',
            'priceCostDate' => $options['priceCostDate'] ?? ' ',
        ];
    }
}
