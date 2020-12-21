<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class DteSalesReportExport implements FromArray, WithMapping , WithHeadings
{
    protected $documents;

    public function __construct(array $documents)
    {
        $this->documents = $documents;
    }

    public function array() : array
    {
        return $this->documents; 
    }

    /**
     * Row head in document
     */
    public function headings(): array
    {
        return [
            // first row
            [
                'Tipo de documento',
                'Folio',
                'Receptor',
                'Fecha',
                'Monto neto',
                'IVA',
                'Total',
            ],
        ];
    }

    public function map($document): array
    {
        return [
            $document['dte'],
            $document['folio'],
            $document['receptor'],
            $document['fecha'],
            $document['net'],
            $document['tax'],
            $document['total'],
        ];
    }
}
