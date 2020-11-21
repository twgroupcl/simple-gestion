<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
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
            'contact_type' => ['required', Rule::in(['1', '2', '3']),],
            'subject' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'details' => 'required|string',
            'phone' => 'required|string',
            'order_id' => 'nullable|int|exists:orders,id',
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
        ];
    }
}
