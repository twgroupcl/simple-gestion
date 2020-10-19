<?php

namespace App\Http\Requests;

use App\Rules\RutRule;
use App\Rules\PhoneRule;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    private $prepareData = [
        'activities_data',
        'addresses_data',
        'bank_data',
        'contact_data',
    ];

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
        $rutRule = new RutRule;
        $phoneRule = new PhoneRule;

        return [
            'uid' => ['required', 'string', $rutRule],
            'name' => 'required|string',
            'visible_name' => 'required|string',
            'email' => 'required|email',
            'phone' => ['nullable', $phoneRule],
            'cellphone' => ['nullable', $phoneRule],
            'web' => 'nullable|string',
            'seller_category_id' => 'required|exists:seller_categories,id',
            'notes' => 'nullable|string',

            // addresses data
            'addresses_data' => 'nullable|string',
            'addresses_data_validation.*.street' => 'required|distinct',
            'addresses_data_validation.*.number' => 'required',
            'addresses_data_validation.*.subnumber' => 'nullable',
            'addresses_data_validation.*.commune_id' => 'required|int|exists:communes,id',
            'addresses_data_validation.*.uid' => ['nullable', 'string', $rutRule],
            'addresses_data_validation.*.first_name' => 'nullable|string',
            'addresses_data_validation.*.last_name' => 'nullable|string',
            'addresses_data_validation.*.email' => 'nullable|email',
            'addresses_data_validation.*.phone' => ['nullable', $phoneRule],
            'addresses_data_validation.*.cellphone' => ['nullable', $phoneRule],
            'addresses_data_validation.*.extra' => 'nullable',

            // activities
            'activities_data' => 'nullable|string',
            'activities_data_validation.*.business_activity_id' => 'required|int|exists:business_activities,id|distinct',

            //bank data
            'bank_data' => 'nullable|string',
            'bank_data_validation.*.account_type_id' => 'required|exists:bank_account_types,id',
            'bank_data_validation.*.bank_id' => 'required|exists:banks,id',
            'bank_data_validation.*.account_number' => 'required|distinct',
            'bank_data_validation.*.rut' => ['nullable', 'string', $rutRule],
            'bank_data_validation.*.first_name' => 'nullable|string',
            'bank_data_validation.*.last_name' => 'nullable|string',
            'bank_data_validation.*.email' => 'nullable|email',
            'bank_data_validation.*.phone' => ['nullable', $phoneRule],

            //contact data
            'contact_data_validation.*.contact_type_id' => 'required|exists:contact_types,id',
            'contact_data_validation.*.url' => 'required|distinct',
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
            'name' => 'Razón social',
            'visible_name' => 'Nombre visible',
            'email' => 'Email',
            'phone' => 'Teléfono',
            'cellphone' => 'Celular',
            'web' => 'Sitio web',
            'seller_category_id' => 'Categoría',
            'notes' => 'Notas',

            // addresses data
            'addresses_data' => 'Direcciones',
            'addresses_data_validation.*.street' => 'Calle en Direcciones',
            'addresses_data_validation.*.number' => 'Número en Direcciones',
            'addresses_data_validation.*.subnumber' => 'Sub Número en Direcciones',
            'addresses_data_validation.*.commune_id' => 'Comuna en Direcciones',
            'addresses_data_validation.*.uid' => 'RUT en Direcciones',
            'addresses_data_validation.*.first_name' => 'Nombre en Direcciones',
            'addresses_data_validation.*.last_name' => 'Apellido en Direcciones',
            'addresses_data_validation.*.email' => 'Correo electrónico en Direcciones',
            'addresses_data_validation.*.phone' => 'Teléfono en Direcciones',
            'addresses_data_validation.*.cellphone' => 'Celular en Direcciones',

            // activities
            'activities_data' => 'Giros',
            'activities_data_validation.*.business_activity_id' => 'Giro en Actividades',

            //bank data
            'bank_data_validation.*.account_type_id' => 'Tipo de cuenta en Datos bancarios',
            'bank_data_validation.*.bank_id' => 'Banco en Datos bancarios',
            'bank_data_validation.*.account_number' => 'Número de cuenta en Datos bancarios',
            'bank_data_validation.*.rut' => 'RUT en Datos bancarios',
            'bank_data_validation.*.first_name' => 'Nombre en Datos bancarios',
            'bank_data_validation.*.last_name' => 'Apellido en Datos bancarios',
            'bank_data_validation.*.email' => 'Email en Datos bancarios',
            'bank_data_validation.*.phone' => 'Teléfono en Datos bancarios',

            //contact data
            'contact_data_validation.*.contact_type_id' => 'Plataforma en Contactos',
            'contact_data_validation.*.url' => 'URL en Contactos',
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
            '*.required*' => 'Es necesario completar el campo :attribute.',
            '*.string' => 'El campo :attribute debe ser texto',
            '*.date' => 'El campo :attribute debe ser de tipo fecha',
            '*.unique' => 'El campo :attribute ya está siendo utilizado por otro cliente.',
            '*.exists' => 'No se pudo encontrar una relación con el campo :attribute.',
            'activities_data_validation.*.*.required' => 'Es necesario completar todos los campos de Giros',
            'activities_data_validation.*.*.distinct' => 'Los campos :attribute(s) no pueden estar repetidos',
            'contact_data_validation.*.*.distinct' => 'No puedes repetir el mismo valor de :attribute',
            'bank_data_validation.*.*.distinct' => 'No puedes repetir el mismo valor de :attribute',
            'addresses_data_validation.*.*.required' => 'Todos los campos :attribute son obligatorios',
        ];
    }
}
