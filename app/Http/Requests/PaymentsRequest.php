<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaymentsRequest extends FormRequest
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
            // 'name' => 'required|min:5|max:255'
            'data_fee' => [
                'required',
                function ($attribute, $value, $fail) {
                    $options = json_decode($value);
                    if($options[0]->amount == '' || $options[0]->date == ''){
                        return $fail('Los campos Fecha de corte y Monto son obligatorios');
                    }
                    
            }],
            'data_payment' => [
                'required',
                function ($attribute, $value, $fail) {
                    $options = json_decode($value);
                    if($options[0]->payment_method == '' || $options[0]->amount_payment == ''){
                        return $fail('Los campos Método de Pago y Monto son obligatorios');
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
            'data_fee.date' => 'fecha de corte',            
            'data_fee.amount' => 'monto',            
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
