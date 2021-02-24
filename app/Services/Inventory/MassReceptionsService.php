<?php

namespace App\Services\Inventory;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductReceptionsImport;
use Illuminate\Support\Facades\Validator;

class MassReceptionsService {

    const ROW_HEADINGS = 3;

    const COLUMN_SKU = 0;
    const COLUMN_NAME = 1;
    const COLUMN_INIT_INVENTORIES = 2;

    public function convertExcelToArray($file)
    {
        $products = [];

        $rawData = Excel::toArray(new ProductReceptionsImport(), $file)[0];
        
        $inventories = [];
        
        foreach($rawData[self::ROW_HEADINGS] as $colNumber => $headingRow) {
            if ($colNumber < self::COLUMN_INIT_INVENTORIES) {
                continue;
            }

            if ($headingRow === null) {
                break;
            }

            // Find the inventory code betweent the [] delimiters
            $inventoryCode = [];        
            preg_match('/(?<=\[)(.*?)(?=\])/', $headingRow, $inventoryCode);
            $inventories[] = [
                'name' => $headingRow,
                'code' => $inventoryCode[0] ?? 'nocode'
            ];
        }

        // Remove the heading rows
        $rawData = array_slice($rawData, 4);

        $products = collect($rawData)->map(function ($value) use ($inventories) {
            $data = [
                'sku' => (string) $value[self::COLUMN_SKU],
                'name' => (string) $value[self::COLUMN_NAME],
            ];

            foreach ($inventories as $key => $inventory) {
                $data['inventories'][] = [
                    'code' => $inventory['code'],
                    'value' => $value[self::COLUMN_INIT_INVENTORIES + $key],
                ];
            }

            return $data;
        });

        return $this->validate($products);
    }

    public function validate($data)
    {
        $isValid = true;
        $products = [];
        $productWithErrors = 0;
        //$tmpProducts = $this->removeEmptyRows($productsArray);
        //$productSkus = collect($tmpProducts)->pluck('sku');
        //$PathImagesArray = collect($tmpProducts)->pluck('path_image');

        $rules = [
            'sku' => 'required|exists:products,sku',
            'inventories' => 'array',
            'inventories.*.code' => 'exists:product_inventory_sources,code',
            'inventories.*.value' => 'nullable|numeric|min:1',
        ];


        $messages = [
            '*.required' => 'El campo :attribute es obligatorio',
            '*.unique' => 'El :attribute ya se encuentra registrado',
            '*.exists' => 'El valor del campo :attribute no es valido',
            '*.numeric' => 'El valor del campo :attribute debe ser un valor numerico',
            'inventories.*.code.exists' => 'No existe una bodega con el codigo :input',
            'inventories.*.value.numeric' => 'El :attribute debe ser numerico',
        ];

        $attributes = [
            'sku' => 'ISBN',
            'inventories' => 'inventarios',
            'inventories.*.code' => 'codigo de inventario',
            'inventories.*.value' => 'valor del inventario',
        ];


        foreach ($data as $product) {
            $product['errors'] = [];

            $hasError = false;

            $validator = Validator::make($product, $rules , $messages, $attributes);

            if ($validator->fails()) {
                $product['errors'][] = $validator->errors()->all();
                $isValid = false;
                $hasError = true;
            }

            if ($hasError) $productWithErrors++;

            $products[] = $product;
        }
        
        return [
            'validate' => $isValid,
            'products_with_errors' => $productWithErrors,
            'products_array' => $products,
        ];
    }
}