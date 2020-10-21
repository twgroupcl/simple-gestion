<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Product;
use App\Rules\SlugRule;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'categories' => 'required',
            'sku' => [
                'required',
                Rule::unique('products')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'));
                }),
            ],
            'url_key' => [
                'required', 
                'unique:products,url_key',
                new SlugRule()],
            'currency_id' => 'required',
            'seller_id' => 'required',
            'company_id' => 'required',
            'product_class_id' => 'required',
            'use_inventory_control' => [
                'required',
                function ($attribute, $value, $fail) {
                    if($value) {
                        $seller = Company::find(request('company_id'));
                        if ($seller->inventory_sources->count() == 0) {
                            return $fail('Para activar el control de inventario debes crear por lo menos una bodega');
                        }
                    }
                }
            ],
            'product_type_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == Product::PRODUCT_TYPE_CONFIGURABLE) {
                        $superAttributes = request('super_attributes');
                        if (is_null($superAttributes)) {
                            return $fail('Debes seleccionar por lo menos un atributo');
                        }
                    }
            }],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'sku' => 'SKU',
            'url_key' => 'Url Key',
            'currency_id' => 'moneda',
            'company_id' => 'negocio',
            'seller_id' => 'vendedor',
            'product_class_id' => 'clase de producto',
            'super_attributes' => 'super atributos',
            'categories' => 'categoria',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
