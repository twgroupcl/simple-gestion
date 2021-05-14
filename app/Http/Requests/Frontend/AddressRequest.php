<?php

namespace App\Http\Requests\Frontend;

use App\Rules\RutRule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        // $rutRule = new RutRule;

        return [
            "street" => 'required|max:40',
            "number" => 'required|numeric|max:99999',
            "subnumber" => 'nullable|max:10',
            "commune_id" => "required",
            'uid' => 'nullable',
            "first_name" => 'nullable|max:20',
            "last_name" => 'nullable|max:20',
            "email" => 'nullable|email',
            "phone" => 'nullable',
            "cellphone" => 'nullable',
            "extra" => 'nullable',
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
            "street" => 'Calle',
            "number" => 'Número',
            "subnumber" => 'Casa/Dpto/Oficina',
            "commune_id" => "Comuna",
            "uid" => 'RUT',
            "first_name" => 'Nombre',
            "last_name" => 'Apellido',
            "email" => 'Email',
            "phone" => 'Teléfono',
            "cellphone" => 'Teléfono móvil',
            "extra" => 'Detalles',
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
            'unique' => 'El campo :attribute ya está siendo utilizado por otro cliente.',
        ];
    }
}
