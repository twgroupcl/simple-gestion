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

            'variable_validation.*.fallback_price' => 'required_if:variable_status,1|numeric|min:0.1',

            'variable_validation.*.table_prices' => 'required_if:variable_status,1',
            'variable_validation_table_prices.*.min_weight' => ['required_if:variable_status,1', $numericCommaRule],
            'variable_validation_table_prices.*.max_weight' => ['required_if:variable_status,1', $numericCommaRule],
            'variable_validation_table_prices.*.final_price' => ['required_if:variable_status,1', $numericCommaRule],

            /* 'variable_validation.*.table_prices' => [
                'required_if:variable_status,1',
                function ($attribute, $value, $fail) {
                    $tablePrices = json_decode($value, true);

                    $fieldGroupValidator = Validator::make($tablePrices, 
                    [
                        '*.min_price' => 'required|numeric|min:0'
                    ]);

                    if ($fieldGroupValidator->fails()) {
                        $this->message = 'Hay un error en tu variacion. '  . $fieldGroupValidator->errors()->first();
                        return $fail('er');
                    }
                    
                }
            ], */

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
            //
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
        ];
    }

    protected function prepareForValidation()
    {   
        
        $shippingMethods = [
            $this->free_shipping_status,
            $this->flat_rate_status,
            $this->variable_status,
            $this->chilexpress_status,
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
