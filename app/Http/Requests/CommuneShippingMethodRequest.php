<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Rules\NumericCommaRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;


class CommuneShippingMethodRequest extends FormRequest
{

    private $prepareData = [
        'free_shipping',
        'picking',
        'variable',
        'chilexpress',
        'flat_rate',
        'arrange_with_seller',
    ];

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
        $numericCommaRule = new NumericCommaRule(0);
        
        return [
            'commune_id' => [
                'required_if:is_global,0',
                Rule::unique('commune_shipping_methods')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'))->where('id', '!=', request('id'));
                }),
            ],
            'is_global' => [
                'required_without:commune_id',
                Rule::unique('commune_shipping_methods')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'))->where('id', '!=', request('id'))->where('is_global', 1);
                }),
            ],
            'shipping_methods_validation' => 'required',

            'flat_rate_validation.*.price' => 'required_if:flat_rate_status,1|numeric|min:0',

            'variable_validation.*.fallback_price' => 'required_if:variable_status,1|numeric|min:0.1',

            'variable_validation.*.table_prices' => 'required_if:variable_status,1',
            'variable_validation_table_prices.*.min_weight' => ['required_if:variable_status,1', $numericCommaRule],
            'variable_validation_table_prices.*.max_weight' => ['required_if:variable_status,1', $numericCommaRule],
            'variable_validation_table_prices.*.min_price' => [$numericCommaRule],
            'variable_validation_table_prices.*.max_price' => [$numericCommaRule],
            'variable_validation_table_prices.*.final_price' => ['required_if:variable_status,1', $numericCommaRule],
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
            'commune_id' => 'Comuna',
            'is_global' => 'configurar como global',

            'flat_rate_validation.*.price' => 'Precio (tarifa fija)',

            'variable_validation_table_prices.*.min_weight' => 'Peso minimo (tarifa variable)',
            'variable_validation_table_prices.*.max_weight' => 'Peso maximo (tarifa variable)',
            'variable_validation_table_prices.*.min_price' => 'Precio minimo (tarifa variable)',
            'variable_validation_table_prices.*.max_price' => 'Precio maximo (tarifa variable)',
            'variable_validation_table_prices.*.final_price' => 'Precio final de envio (tarifa variable)',
            'variable_validation.*.fallback_price' => 'Precio de fallback (tarifa variable)',
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
            'shipping_methods_validation.required' => 'Debes seleccionar por lo menos un metodo de envío',
            'commune_id.unique' => 'Ya tienes otra configuracíon de envío para la comuna seleccionada',
            'commune_id.required_if' => 'Debes seleccionar una comuna',
            'is_global.unique' => 'Solo puedes tener una configuracion global de envíos',
            'flat_rate_validation.*.price.min' => 'El campo :attribute debe ser por lo menos :min',
            'variable_validation.*.fallback_price.min' => 'El campo :attribute debe ser por lo menos :min',
            'variable_validation_table_prices.*.*.required_if' => 'El campo :attribute es requerido',
            'variable_validation.0.table_prices.required_if' => 'Debes especificar al menos un fila de precios para la configuracion de tarifa variable'
        ];
    }

    protected function prepareForValidation()
    {   
        
        $shippingMethods = [
            $this->free_shipping_status,
            $this->flat_rate_status,
            $this->variable_status,
            $this->chilexpress_status,
            $this->picking_status,
            $this->arrange_with_seller_status,
        ];

        $shippingMethods = in_array(1, $shippingMethods);
        
        if  ($shippingMethods) {
            $this->merge([
                'shipping_methods_validation' => $shippingMethods,
            ]); 
        }

        foreach ($this->prepareData as $attrName) {
            
            if (empty($this->$attrName)) {
                return;
            }

            if ($this->{$attrName . '_status'}) {
                $validation = json_decode($this->$attrName);
                $forValidation = [];

                foreach ($validation as $attrs) {
                    $forValidation[] = (array) $attrs;
                }
                
                if (isset($attrs->table_prices)) {
                    $this->merge([
                        'variable_validation_table_prices' => !empty($attrs->table_prices)
                            ? json_decode($attrs->table_prices, true)
                            : [],
                    ]);
                }

                $this->merge([
                    $attrName.'_validation' => $forValidation,
                ]);
            }
        }
    }
}
