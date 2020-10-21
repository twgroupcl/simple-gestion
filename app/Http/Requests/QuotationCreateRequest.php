<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class QuotationCreateRequest extends FormRequest
{

    private $prepareData = [
        'items_data',
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
        return [
            'seller_id' => 'required',
            'customer_id' => 'required',
            'quotation_date' => 'required',
            'expiry_date' => 'required|after:quotation_date',
            'total' => 'numeric|min:1',
            'title' => 'required',
            'address_id' => 'required',

            // Order items data
            'items_data_validation.*.name' => 'required',
            'items_data_validation.*.qty' => 'required',
            'items_data_validation.*.price' => 'required',
            'items_data_validation.*.total' => 'required',

            'quotations_items_json' => function($attribute, $value, $fail) {
                $items = json_decode($value, true);
                if ( !count($items) ) return $fail('Debes añadir por lo menos un producto / servicio.');
            }
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
            'business_id' => 'negocio',
            'customer_id' => 'cliente',
            'creation_date' => 'fecha de creacion',
            'due_date' => 'fecha de vencimiento',
            'total' => 'monto total',

            // Order items data
            'items_data_validation.*.name' => 'nombre del producto / servicio',
            'items_data_validation.*.qty' => 'cantidad del producto / servicio',
            'items_data_validation.*.price' => 'precio del producto / servicio',
            'items_data_validation.*.total' => 'total',
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
        foreach ($this->prepareData as $attrName) {
            if (empty($this->$attrName)) {
                return;
            }
            $validation = json_decode($this->$attrName);
            $forValidation = [];
            foreach ($validation as $attrs) {
                $forValidation[] = (array) $attrs;
            }
            $this->merge([
                $attrName.'_validation' => $forValidation,
            ]);
        }
    }
}
