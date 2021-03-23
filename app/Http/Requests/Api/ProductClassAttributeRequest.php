<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductClassAttributeRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        if (empty($this->options)) return true;

        $optionsArray = json_decode($this->options, true);

        $this->merge([
            'options_array' => $optionsArray,
        ]);
    }

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
            'name' => 'required|min:1|max:255',
            'class_code' => 'required|exists:product_classes,code',
            'options' => 'required_if:type_attribute,select',
            'code' => [
                'required',
                Rule::unique('product_class_attributes', 'json_attributes->code'),
            ],
            'type_attribute' => [
                'required',
                Rule::in(['text', 'select']),
            ],
            'options_array' => 'array',
            'options_array.*.option_name' => 'required_with:options_array',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del atributo',
            'type_attribute' => 'tipo de atributo',
            'product_class_id' => 'clase de producto',
            'options' => 'opciones',
            'code' => 'codigo'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'El :attribute es requerido',
            '*.min' => 'El :attribute es requerido',
            '*.unique' => 'El :attribute ya existe en la base de datos',
            '*.exists' => 'El valor indicado no existe en la base de datos',
            'type_attribute.in' => 'Los valores aceptados para :attribute son: text y select',
            'options.required_if' => 'Cuando el tipo de atributo es select, el campo options es obligatorio',
            'options_array.array' => 'El campo options debe contener un arreglo JSON valido',
            'options_array.*.option_name.*' => 'Los elementos del arreglo JSON del campo options deben contener la propiedad option_name'
        ];
    }

    protected function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 422)); 
    } 
}
