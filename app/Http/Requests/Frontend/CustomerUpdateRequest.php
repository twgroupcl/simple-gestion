<?php

namespace App\Http\Requests\Frontend;

use App\Rules\RutRule;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'uid' => ['required', 'unique:customers,uid,'.$this->id, 'string', $rutRule],
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'password' => 'confirmed',
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
            'confirmed' => 'Los campos :attribute no coinciden.',
            'string' => 'El campo :attribute debe ser texto',
            'date' => 'El campo :attribute debe ser de tipo fecha',
            'unique' => 'El campo :attribute ya está siendo utilizado por otro cliente.',
            'exists' => 'No se pudo encontrar una relación con el campo :attribute.',
        ];
    }
}
