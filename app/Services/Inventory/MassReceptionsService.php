<?php

namespace App\Services\Inventory;

use Exception;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductInventorySource;
use App\Imports\ProductReceptionsImport;
use Illuminate\Support\Facades\Validator;

class MassReceptionsService {

    const ROW_HEADINGS = 3;
    const ROW_TYPE_OPERATION = 0;
    const ROW_DOCUMENT_NUMBER = 1;

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

        $options = [
            'typeOperation' => [
                'value' => trim($rawData[self::ROW_TYPE_OPERATION][1]),
                'valid' => true,
            ],
            'documentNumber' => [
                'value' => trim($rawData[self::ROW_DOCUMENT_NUMBER][1]),
                'valud' => true,
            ],
        ];

        // Remove the heading rows
        $rawData = array_slice($rawData, 4);

        $products = collect($rawData)->map(function ($value) use ($inventories) {
            $data = [
                'sku' => (string) trim($value[self::COLUMN_SKU]),
                'name' => (string) trim($value[self::COLUMN_NAME]),
            ];

            foreach ($inventories as $key => $inventory) {
                $data['inventories'][] = [
                    'name' => $inventory['name'],
                    'code' => trim($inventory['code']),
                    'value' => trim($value[self::COLUMN_INIT_INVENTORIES + $key]),
                ];
            }

            return $data;
        });

        return $this->validate($products, $options);
    }

    /**
     * Validate the data of the array and options and return the data
     * with the result of the validation
     * 
     * @param array $data
     * @param array $options
     * @return array
     */
    public function validate($data, $options)
    {
        $isValid = true;
        $products = [];
        $productWithErrors = 0;

        $rules = [
            'sku' => [
                'required',
                Rule::exists('products', 'sku')->where(function ($query) {
                    return $query->where('use_inventory_control', true)->where('company_id', backpack_user()->current()->company->id);
                }),    
            ],
            'inventories' => 'array',
            'inventories.*.code' => 'exists:product_inventory_sources,code',
            'inventories.*.value' => 'nullable|numeric|min:1',
        ];

        $messages = [
            'sku.exists' => 'El producto con Sku :input no existe o no usa el control de inventario',
            '*.required' => 'El campo :attribute es obligatorio',
            '*.unique' => 'El :attribute ya se encuentra registrado',
            '*.exists' => 'El valor del campo :attribute no es valido',
            '*.numeric' => 'El valor del campo :attribute debe ser un valor numerico',
            'inventories.*.code.exists' => 'No existe una bodega con el codigo :input',
            'inventories.*.value.numeric' => 'El :attribute debe ser numerico',
        ];

        $attributes = [
            'sku' => 'SKU',
            'inventories' => 'inventarios',
            'inventories.*.code' => 'codigo de inventario',
            'inventories.*.value' => 'cantidad stock del inventario',
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

        // Validate type operation
        if (!in_array($options['typeOperation']['value'], ['[sumar]', '[reemplazar]'])) {
            $isValid = false;
            $options['typeOperation']['valid'] = false;
        }
        
        return [
            'validate' => $isValid,
            'products_with_errors' => $productWithErrors,
            'products_array' => $products,
            'options' => $options,
        ];
    }

    /**
     * Update or replace the stock on inventory of the products provided
     * 
     * @param array $products
     * @param array $options
     * @param int $companyId
     */
    public function storeReceptions(array $products, array $options, int $companyId)
    {
        foreach ($products as  $product) {
            foreach ($product['inventories'] as $inventoryData) {  

                $inventory = ProductInventorySource::where([
                    'code' => $inventoryData['code'],
                    'company_id' => $companyId,
                ])->first();

                if (!$inventory) throw new Exception("Product Inventory with the code " . $inventoryData['code'] . ' and the company id ' . $companyId . ' doesnt exists');

                $product = Product::where([
                    'sku' => $product['sku'],
                    'company_id' => $companyId,
                ])->first();

                if (!$product) throw new Exception("Product with the sku " . $product['sku'] . ' and the company id ' . $companyId . ' doesnt exists');
                
                if ($inventoryData['value'] === null || empty($inventoryData['value'])) {
                    continue;
                }

                if ($options['typeOperation']['value'] === '[sumar]') {
                    $qtyOnStock = $product->getQtyInInventory($inventory->id);
                    $finalQty = $qtyOnStock + (int) $inventoryData['value'];
                    $product->updateInventory((int) $finalQty, $inventory->id, true);
                } else if ($options['typeOperation']['value'] === '[reemplazar]') {
                    $product->updateInventory((int) $inventoryData['value'], $inventory->id, true);
                }   
            }
        }
    }
}