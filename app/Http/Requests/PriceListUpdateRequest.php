<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PriceListUpdateRequest extends FormRequest
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
            'name' => 'required',
            'code' => [
                'required',
                Rule::unique('price_lists', 'code')->where(function ($query) {
                    return $query->where('company_id', backpack_user()->current()->company->id)->where('id', '!=', $this->id);
                }),
            ],
            'products.*.id' => 'required',
            'products.*.price' => 'numeric|nullable',
            'products.*.cost' => 'numeric|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'code' => 'codigo',
            'products.*.price' => 'precio del producto',
            'products.*.cost' => 'costo del producto',
        ];
    }

    public function messages()
    {
        return [
            '*.required*' => 'Es necesario completar el campo :attribute.',
            '*.string' => 'El campo :attribute debe ser texto',
            '*.date' => 'El campo :attribute debe ser de tipo fecha',
            '*.unique' => 'El campo :attribute ya está siendo utilizado.',
            '*.exists' => 'No se pudo encontrar una relación con el campo :attribute.',
            '*.*.*.numeric' => 'El campo :attribute debe ser un numero.',
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
