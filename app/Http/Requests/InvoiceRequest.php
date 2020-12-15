<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'invoice_type_id' => 'required|exists:invoice_types,id',
            'total' => 'gte:0',
            'invoice_date' => 'date',
            //'expiry_date' => 'sometimes|date|after_or_equal:invoice_date'
            'seller_id' => 'required|exists:sellers,id',
            'discount_percent' => 'gte:0,lte:100', 
            'discount_amount' => 'gte:0',
            'customer_id' => 'required|exists:customers,id', 
            'address_id' => 'required|exists:customer_addresses,id',
            // 'name' => 'required|min:5|max:255'
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
            'customer_id' => 'cliente',
            'seller_id' => 'vendedor',
            'discount_percent' => 'descuento global',
            'discount_amount' => 'descuento global',
            'invoice_date' => 'fecha de emisión',
            'expiry_date' => 'fecha de vencimiento',
            'invoice_type_id' => 'tipo de documento',
            'address_id' => 'dirección',
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
            'gte' => 'El campo :attribute debe ser mayor o igual a 0',
            'required' => 'Verifique el campo :attribute, es necesario que lo complete',
        ];
    }
}
