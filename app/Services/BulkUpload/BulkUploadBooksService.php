<?php

namespace App\Services\BulkUpload;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsCollectionImport;
use Illuminate\Support\Facades\Validator;

class BulkUploadBooksService {

    const ROW_SKU = 1;
    const ROW_NAME = 2;
    const ROW_AUTHOR = 3;
    const ROW_DESCRIPTION= 4;
    const ROW_YEAR = 5;
    const ROW_BRAND = 6;
    const ROW_CATEGORY = 7;
    const ROW_LANGUAGE = 8;
    const ROW_NUMBER_PAGES = 9;
    const ROW_ENCUADERNACION = 10;
    const ROW_PRICE = 11;
    const ROW_SPECIAL_PRICE = 12;
    const ROW_DEPTH = 13;
    const ROW_WIDTH = 14;
    const ROW_HEIGHT = 15;
    const ROW_WEIGHT = 16;
    const ROW_META_TITLE = 17;
    const ROW_META_KEYWORDS = 18;
    const ROW_META_DESCRIPTION = 19;

    private $tableVisibleRows = [
        'sku' => 'SKU',
        'name' => 'Titulo',
        'price' => 'Precio',
        'errors' => 'Errores',
    ];

    public function convertExcelToArray($file)
    {
        $products = [];

        $data = Excel::toArray(new ProductsCollectionImport(), $file)[0];
        
        // Remove the titles rows
        $data = array_slice($data, 2);

        $products = collect($data)->map(function ($value) {
            return [
                'sku' => $value[self::ROW_SKU],
                'name' => $value[self::ROW_NAME],
                'author' => $value[self::ROW_AUTHOR],
                'description' => $value[self::ROW_DESCRIPTION],
                'year' => $value[self::ROW_YEAR],
                'brand' => $value[self::ROW_BRAND],
                'category' => $value[self::ROW_CATEGORY],
                'language' => $value[self::ROW_LANGUAGE],
                'pages_number' => $value[self::ROW_NUMBER_PAGES],
                'encuadernacion' => $value[self::ROW_ENCUADERNACION],
                'price' => $value[self::ROW_PRICE],
                'special_price' => $value[self::ROW_SPECIAL_PRICE],
                'depth' => $value[self::ROW_DEPTH],
                'width' => $value[self::ROW_WIDTH],
                'height' => $value[self::ROW_HEIGHT],
                'weight' => $value[self::ROW_WEIGHT],
                'meta_title' => $value[self::ROW_META_TITLE],
                'meta_keywords' => $value[self::ROW_META_KEYWORDS],
                'meta_description' => $value[self::ROW_META_DESCRIPTION],
            ];
        });

        return $this->validate($products);
        return $products;
    }

    public function validate($productsArray)
    {
        $isValid = true;
        $products = [];
        $productWithErrors = 0;

        $rules = [
            'sku' => 'max:50',
        ];

        $tmpProducts = $this->removeEmptyRows($productsArray);

        foreach ($tmpProducts as $product) {

            $product['errors'] = [];
            $validator = Validator::make($product, $rules/* , $messages, $attributes */);

            if ($validator->fails()) {
                $product['errors'][] = $validator->errors()->all();
                $isValid = false;
                $productWithErrors++;
                //return $validator->errors()->first();
            }

            $products[] = $product;
        }
        
        return [
            'validate' => false,
            'products_with_errors' => $productWithErrors,
            'products_array' => $products,
            'table_visible_rows' => $this->tableVisibleRows,
        ];
    }

    public function removeEmptyRows($array)
    {
        $arrayWitouthEmptyRows = $array;

        foreach($array as $key => $product) {
            $rowWitouthNull = array_filter($product);
            if ( empty($rowWitouthNull) ) unset($arrayWitouthEmptyRows[$key]);
        }

        return $arrayWitouthEmptyRows;
    }

    public function prepareDataForSave($productsArray)
    {

    }

    public function storeProducts($productsArray)
    {

    }
}