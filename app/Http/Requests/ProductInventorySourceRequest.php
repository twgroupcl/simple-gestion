<?php

namespace App\Http\Requests;

use App\Rules\RutRule;
use App\Rules\PhoneRule;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProductInventorySourceRequest extends FormRequest
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
            'code' => 'required',
            'company_id' => 'required',
            'name' => 'required|min:5|max:255',
            'commune_id' => 'required|exists:communes,id',
            'address_street' => 'required',
            'address_number' => 'required',
            'priority' => 'required',
            'contact_uid' => ['required', new RutRule()],
            'contact_first_name' => 'required',
            'contact_last_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => [
                'required',
                new PhoneRule(),
            ],
            'status' => 'required',
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
            'code' => 'codigo',
            'name' => 'nombre de la bodega',
            'commune_id' => 'comuna',
            'address_street' => 'calle',
            'address_number' => 'numero de calle',
            'priority' => 'prioridad',
            'contact_uid' => 'RUT de contacto',
            'contact_first_name' => 'nombre de contacto',
            'contact_last_name' => 'apellido de contacto',
            'contact_email' => 'email de contacto',
            'contact_phone' => 'telefono de contacto',
            'status' => 'estado',
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
