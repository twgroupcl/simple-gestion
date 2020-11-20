<?php

namespace App\Services\BulkUpload;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Mail\BulkUploadMail;
use App\Mail\ProductCreated;
use App\Models\ProductBrand;
use App\Models\ProductClass;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Imports\ProductsCollectionImport;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Support\Facades\Validator;

class BulkUploadBooksService {

    const PRODUCT_TYPE = Product::PRODUCT_TYPE_SIMPLE;
    const PRODUCT_CLASS_CODE = 'book';

    const ROW_SKU = 1;
    const ROW_NAME = 2;
    const ROW_AUTHOR = 3;
    const ROW_DESCRIPTION= 4;
    const ROW_YEAR = 5;
    const ROW_EDITORIAL = 6;
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
    const ROW_PATH_IMAGE = 20;

    private $tableVisibleRows = [
        'sku' => 'ISBN',
        'name' => 'Titulo',
        'author' => 'Autor',
        'editorial' => 'Editorial',
        'price' => 'Precio',
        'errors' => 'Errores',
    ];

    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function convertExcelToArray($file)
    {
        $products = [];

        $data = Excel::toArray(new ProductsCollectionImport(), $file)[0];
        
        // Remove the titles rows
        $data = array_slice($data, 7);

        $products = collect($data)->map(function ($value) {
            return [
                'sku' => $value[self::ROW_SKU],
                'name' => $value[self::ROW_NAME],
                'author' => $value[self::ROW_AUTHOR],
                'description' => $value[self::ROW_DESCRIPTION],
                'year' => $value[self::ROW_YEAR],
                'editorial' => $value[self::ROW_EDITORIAL],
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
                'path_image' => $value[self::ROW_PATH_IMAGE],
            ];
        });

        return $this->validate($products);
    }

    public function validate($productsArray)
    {
        $isValid = true;
        $products = [];
        $productWithErrors = 0;

        $rules = [
            'name' => 'required|max:255',
            'sku' => [
                'required',
                Rule::unique('products')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'));
                }),
            ],
            'author' => 'required', // atributo text
            'description' => 'required',
            'year' => 'nullable|numeric', // atributo text
            'editorial' => 'required|exists:product_brands,name',
            'category' => 'required|exists:product_categories,name',
            'language' => 'required', // atributo quizas select
            'pages_number' => 'nullable|numeric', // atributo text
            'encuadernacion' => 'required', // atributo quizas select
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'depth' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'path_image' => 'required|ends_with:.jpg,.jpeg,.png',
        ];

        $messages = [
            '*.required' => 'El campo :attribute es obligatorio',
            '*.unique' => 'El :attribute ya se encuentra registrado',
            '*.exists' => 'El valor del campo :attribute no es valido',
        ];

        $attributes = [
            'name' => 'Título',
            'sku' => 'ISBN',
            'category' => 'Subcategoria',
            'author' => 'Autores', // atributo text
            'description' => 'Descripción',
            'year' => 'Año de edición', // atributo text
            'editorial' => 'Editorial',
            'language' => 'Idioma', // atributo quizas select
            'pages_number' => 'Número de paginas', // atributo text
            'encuadernacion' => 'Encuadernacion', // atributo quizas select
            'price' => 'Precio Normal',
            'special_price' => 'Precio Oferta',
            'depth' => 'Largo',
            'width' => 'Ancho',
            'height' => 'Alto',
            'weight' => 'Peso',
            'meta_title' => 'Título para buscadores',
            'meta_keywords' => 'Palabras clave',
            'meta_description' => 'Descripción para buscadores',
            'path_image' => 'Titulo Foto Portada',
            
        ];

        $tmpProducts = $this->removeEmptyRows($productsArray);
        $productSkus = collect($tmpProducts)->pluck('sku');

        foreach ($tmpProducts as $product) {

            $hasError = false;

            $product['errors'] = [];

            $validator = Validator::make($product, $rules , $messages, $attributes);

            if ($validator->fails()) {
                $product['errors'][] = $validator->errors()->all();
                $isValid = false;
                $hasError = true;
            }

            $duplicateSkus = array_count_values($productSkus->toArray());

            if ( $duplicateSkus[$product['sku']] > 1 ) {
                $product['errors'][] = ['El ISBN no puede estar duplicado'];
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

    public function prepareDataForSave($data, $sellerId, $companyId)
    {
        $productsModelPrepared = collect($data)->map(function ($productData) use ($sellerId, $companyId) {

            $brandId = ProductBrand::where('name', $productData['editorial'])->first()->id;
            $classId = ProductClass::where('code', self::PRODUCT_CLASS_CODE)->first()->id;
            $categoryId = ProductCategory::where('name', $productData['category'])->first()->id;

            $extraAttributes = [
                [
                    'code' => 'author',
                    'value' => $productData['author'],
                ],
                [
                    'code' => 'year',
                    'value' => $productData['year'],
                ],
                [
                    'code' => 'language',
                    'value' => $productData['language'],
                ],
                [
                    'code' => 'pages_number',
                    'value' => $productData['pages_number'],
                ],
                [
                    'code' => 'encuadernacion',
                    'value' => $productData['encuadernacion'],
                ],
            ];

            $attributes_json = $this->productService->extraAttributesAdapter($extraAttributes, $classId);

            $json_images = [
                [
                    'image' => '/storage/products/' . $productData['path_image']
                ]
            ];

            $json_value = [
                'source' => 'bulk_upload',
            ];

            return [
                'sku' => $productData['sku'],
                'name' => $productData['name'],
                'description' => $productData['description'],
                'use_inventory_control' => false,
                'is_service' => false, 
                'product_brand_id' => $brandId,
                'product_type_id' => self::PRODUCT_TYPE,
                'product_class_id' => $classId,
                'product_category' => $categoryId,
                'price' => $productData['price'],
                'special_price' => $productData['special_price'],
                'depth' => $productData['depth'],
                'width' => $productData['width'],
                'height' => $productData['height'],
                'weight' => $productData['weight'],
                'meta_title' => $productData['meta_title'],
                'meta_keywords' => $productData['meta_keywords'],
                'meta_description' => $productData['meta_description'],
                'attributes_json' => $attributes_json,
                'images_json' => $json_images,
                'currency_id' => 63,
                'json_value' => $json_value,
                'seller_id' => $sellerId,
                'company_id' => $companyId,
            ];
        });

        return $productsModelPrepared;
    }

    public function storeProducts($productsArray, $sellerId)
    {
        $companyId = Seller::find($sellerId)->company->id;
        $products = $this->prepareDataForSave($productsArray, $sellerId, $companyId);
        
        foreach($products as $product) {
            $slug = $this->productService->generateSlug($product['name'], 20, $companyId);

            if (!$slug) return ['status' => false, 'message' => 'Ocurrio un error generando el Slug'];

            if ( ! $this->productService->validateUniqueSku($product['sku'], $sellerId, $companyId) ) {
                return [ 'status' => false, 'message' =>  'Ya tienes un producto con el SKU indicado', 'status_response' => 'error'];
            }
            
            try {
                $newProduct = Product::create($product);
            } catch(QueryException $exception) {
                return ['status' => false, 'message' =>  $exception];
            }

            DB::table('product_images')->insert([
                'product_id' => $newProduct->id,
                'path' => $product['images_json'][0]['image'],
            ]);

            $newProduct->categories()->attach($product['product_category']);
            $newProduct->url_key = $slug;
            $newProduct->update();

        }

        // Send email to admins
        $administrators = Setting::get('administrator_email');
        $recipients = explode(';', $administrators) ?? [];
        
        foreach ($recipients as $key => $recipient) {
            Mail::to($recipient)->send(new BulkUploadMail(Seller::find($sellerId)->visible_name, count($products)));
        }

        return ['status' => true, 'message' => 'Productos importados con exito'];
    }
}