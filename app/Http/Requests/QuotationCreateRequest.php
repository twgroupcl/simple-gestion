<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class QuotationCreateRequest extends FormRequest
{

    private $prepareData = [
        'quotation_items_json',
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
            'business_id' => 'required',
            'customer_id' => 'required',
            'creation_date' => 'required',
            'due_date' => 'required|after:creation_date',
            'total' => 'numeric|min:1',

            // Order items data
            'quotation_items_json_validation.*.name' => 'required',
            'quotation_items_json_validation.*.qty' => 'required',
            'quotation_items_json_validation.*.price' => 'required',
            'quotation_items_json_validation.*.total' => 'required',

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
            'quotation_items_json_validation.*.name' => 'nombre del producto / servicio',
            'quotation_items_json_validation.*.qty' => 'cantidad del producto / servicio',
            'quotation_items_json_validation.*.price' => 'precio del producto / servicio',
            'quotation_items_json_validation.*.total' => 'total',
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
