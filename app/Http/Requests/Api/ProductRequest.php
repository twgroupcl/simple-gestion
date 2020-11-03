<?php

namespace App\Http\Requests\Api;

use App\Rules\SlugRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
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
            'price' => 'required|numeric|min:1',

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
        ];
    }

    protected function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 422)); 
    } 
}
