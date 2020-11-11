<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommuneShippingMethodRequest extends FormRequest
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
            'commune_id' => [
                'required_if:is_global,0',
                Rule::unique('commune_shipping_methods')->where( function($query) {
                    return $query->where('seller_id', '=', request('seller_id'))->where('id', '!=', request('id'));
                }),
            ],
            'is_global' => 'required_without:commune_id',
            'shipping_methods_validation' => 'required',

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
            //
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
    }
}
