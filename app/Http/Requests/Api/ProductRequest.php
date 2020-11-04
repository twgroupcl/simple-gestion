<?php

namespace App\Http\Requests\Api;

use App\Rules\SlugRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{

    private $prepareData = [
        'warehouse',
        'custom_attributes',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'sku' => 'required',
            'url_key' => new SlugRule(),
            'categories' => 'required',
            'is_service' => 'required|boolean',
            'product_class_id' => 'required|exists:product_classes,id',
            'product_type_id' => 'required|exists:product_types,id',
            'product_brand_id' => 'numeric|exists:product_brands,id',
            'short_description' => 'required|max:255',
            //'price' => 'required|numeric|min:1',

            'special_price' => 'numeric|min:1',
            'special_price_from' => 'date_format:d-m-Y|before:special_price_to',
            'special_price_to' => 'date_format:d-m-Y|after:special_price_from',

            'categories' => 'array',
            'categories.*' => 'numeric|exists:product_categories,id',

            'warehouse' => 'required_if:use_inventory_control,1',
            'warehouse_array' => 'required_if:use_inventory_control,1|array',
            'warehouse_validation.*.code' => 'required_if:use_inventory_control,1|exists:product_inventory_sources,code',
            'warehouse_validation.*.stock' => 'required_if:use_inventory_control,1|numeric',
            'warehouse_validation.*.price' => 'required_if:use_inventory_control,1|numeric',
            'warehouse_validation.*.shipping_type' => 'required_if:use_inventory_control,1|exists:shipping_methods,id',

            'custom_attributes_array' => 'array',
            'custom_attributes_validation.*.code' => 'required_with:custom_attributes',
            'custom_attributes_validation.*.value' => 'required_with:custom_attributes',

            'new' => 'boolean',
            'featured' => 'boolean',
            'visible' => 'boolean',
            'visible_from' => 'date',
            'visible_to' => 'date',

            'weight' => 'required_if:is_service,0',
            'height' => 'required_if:is_service,0',
            'width' => 'required_if:is_service,0',
            'depth' => 'required_if:is_service,0',
            
            'images.*' => 'image|mimes:jpeg,png,jpg',
            'status' => 'boolean',

            'use_inventory_control' => [
                'required',
                'boolean',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $sellerCompany = auth()->user()->companies->first();
                        if ($sellerCompany->inventory_sources->count() == 0) {
                            return $fail('Para activar el control de inventario debes crear por lo menos una bodega');
                        }
                    }
                }
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'sku' => 'SKU',
            'url_key' => 'Url Key',
            'currency_id' => 'moneda',
            'company_id' => 'negocio',
            'product_class_id' => 'clase de producto',
            'super_attributes' => 'super atributos',
            'categories' => 'categoria',
        ];
    }

    public function messages()
    {
        return [
            '*.required*' => 'Es necesario completar el campo :attribute.',
            '*.exists' => 'El id del atributo :attribute es invalido o no existe',
            '*.*.exists' => 'El id del atributo :attribute es invalido o no existe',
        ];
    }

    protected function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 422)); 
    } 

    protected function prepareForValidation()
    {
        foreach ($this->prepareData as $attrName) {
            if (empty($this->$attrName)) {
                return;
            }

            $validation = json_decode($this->$attrName);

            $this->merge([
                $attrName.'_array' => $validation,
            ]);

            $forValidation = [];

            if (!$validation) {
                return;
            }

            foreach ($validation as $attrs) {
                $forValidation[] = (array) $attrs;
            }

            $this->merge([
                $attrName.'_validation' => $forValidation,
            ]);
        }
    }
}
