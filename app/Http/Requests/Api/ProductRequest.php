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
            'type' => 'in:simple,configurable',
            'product_class_id' => 'required_without:product_class_code|exists:product_classes,id',
            'product_class_code' => 'required_without:product_class_id|exists:product_classes,code',
            'product_brand_id' => 'numeric|exists:product_brands,id',
            'product_brand_code' => 'exists:product_brands,code',
            'short_description' => 'required|max:255',
            //'is_service' => 'required|boolean',

            'categories' => 'array',
            'categories.*' => 'numeric|exists:product_categories,id',
            
            

            'warehouse' => 'required',
            'warehouse_array' => 'required|array',
            'warehouse_validation.*.code' => 'required|exists:product_inventory_sources,code',
            'warehouse_validation.*.stock' => 'required|numeric',
            'warehouse_validation.*.price' => 'required|numeric',
            'warehouse_validation.*.shipping_type' => 'required|exists:shipping_methods,id',

            'warehouse_validation.*.special_price' => 'numeric|min:1',
            'warehouse_validation.*.special_price_from' => 'date_format:d-m-Y|before:special_price_to',
            'warehouse_validation.*.special_price_to' => 'date_format:d-m-Y|after:special_price_from',

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
            'name' => 'name',
            'sku' => 'SKU',
            'url_key' => 'url_key',
            'currency_id' => 'currency_id',
            'company_id' => 'company_id',
            'product_class_id' => 'product_class_id',
            'product_class_code' => 'product_class_code',
            'super_attributes' => 'super_attributes',
            'categories' => 'categories',

            'warehouse' => 'warehouse',
            'warehouse_array' => 'warehouse',
            'warehouse_validation.*.code' => 'warehouse.*.code',
            'warehouse_validation.*.stock' => 'warehouse.*.stock',
            'warehouse_validation.*.price' => 'warehouse.*.price',
            'warehouse_validation.*.shipping_type' => 'warehouse.*.shipping_type',
            'warehouse_validation.*.special_price' => 'warehouse.*.special_price',
            'warehouse_validation.*.special_price_from' => 'warehouse.*.special_price_from',
            'warehouse_validation.*.special_price_to' => 'warehouse.*.special_price_to',
        ];
    }

    public function messages()
    {
        return [
            'product_class_code.required_without' => 'Si el campo product_class_id no esta presente, debe indicar el campo product_class_id',
            'product_class_id.required_without' => 'Si el campo product_class_code no esta presente, debe indicar el campo product_class_code',
            '*.required' => 'Es necesario completar el campo :attribute.',
            '*.*.*.required' => 'Es necesario completar el campo :attribute.',
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
