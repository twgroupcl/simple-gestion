<?php

namespace App\Http\Requests\Frontend;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerSupportRequest extends FormRequest
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
            'contact_type' => ['required', Rule::in(['1', '2', '3']),],
            'subject' => 'required|string|max:200',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'details' => 'required|string|max:2000',
            'phone' => ['required', 'string', new PhoneRule],
            'order_id' => 'nullable|int|exists:orders,id|digits_between:1,5',
        ];
    }

    public function attributes()
    {
        return [
            'contact_type' => 'Tipo de contacto',
            'subject' => 'Asunto',
            'name' => 'Nombre',
            'email' => 'E-mail',
            'details' => 'Detalle',
            'phone' => 'Teléfono',
            'order' => 'N° Orden',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio',
            'string' => 'El campo :attribute debe ser texto',
            'email' => 'El campo :attribute debe ser un email',
            'in' => 'Debes seleccionar una de las opciones válidas',
            'exists' => 'Asegúrate de que la orden que escribas sea correcta',
            'max' => 'Por favor no excedas los :max caracteres',
        ];
    }
}
