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
        'extra_attributes',
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
            'product_class_id' => 'required|exists:product_classes,id',
            'type' => 'in:simple,configurable',
            'product_brand_id' => 'numeric|exists:product_brands,id',
            'short_description' => 'required|max:255',
            //'product_type_id' => 'required|exists:product_types,id',
            //'price' => 'required|numeric|min:1',
            //'is_service' => 'required|boolean',

            'special_price' => 'numeric|min:1',
            'special_price_from' => 'date_format:d-m-Y|before:special_price_to',
            'special_price_to' => 'date_format:d-m-Y|after:special_price_from',

            'categories' => 'array',
            'categories.*' => 'numeric|exists:product_categories,id',

            'warehouse' => 'required',
            'warehouse_array' => 'required|array',
            'warehouse_validation.*.code' => 'required|exists:product_inventory_sources,code',
            'warehouse_validation.*.stock' => 'required|numeric',
            'warehouse_validation.*.price' => 'required|numeric',
            'warehouse_validation.*.shipping_type' => 'required|exists:shipping_methods,id',

            'extra_attributes_array' => 'array',
            'extra_attributes_validation.*.code' => 'required_with:extra_attributes',
            'extra_attributes_validation.*.value' => 'required_with:extra_attributes',

            'new' => 'boolean',
            'featured' => 'boolean',
            'visible' => 'boolean',
            'visible_from' => 'date',
            'visible_to' => 'date',

            'weight' => 'required',
            'height' => 'required',
            'width' => 'required',
            'depth' => 'required',
            
            'images.*' => 'image|mimes:jpeg,png,jpg',
            'status' => 'boolean',

            /* 'use_inventory_control' => [
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
            ], */
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
