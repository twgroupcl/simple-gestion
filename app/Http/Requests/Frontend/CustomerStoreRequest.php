<?php

namespace App\Http\Requests\Frontend;

use App\Rules\RutRule;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
        $rutRule = new RutRule;

        return [
            'uid' => ['required', 'unique:customers,uid', 'string', $rutRule],
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'commune' => 'required|exists:communes,id',
            'street' => 'required',
            'number' => 'required|numeric',
            'phone' => 'required|numeric',
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
            'uid' => 'RUT',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'email' => 'Email',
            'password' => 'Contraseña',
            'phone' => 'Telefono',
            'commune' => 'Comuna',
            'street' => 'Calle',
            'number' => 'Numero',
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
            'required' => 'Es necesario completar el campo :attribute.',
            'string' => 'El campo :attribute debe ser texto',
            'date' => 'El campo :attribute debe ser de tipo fecha',
            'unique' => 'El campo :attribute ya está siendo utilizado por otro cliente.',
            'exists' => 'No se pudo encontrar una relación con el campo :attribute.',
            'numeric' => 'El campo :attribute debe ser numerico',
        ];
    }
}
