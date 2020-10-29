<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductInventorySourceRequest extends FormRequest
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
            'code' => 'required|unique:product_inventory_sources,code',
            'name' => 'required',
            'description' => 'required',
            'commune_id' => 'required|exists:communes,id',
            'street' => 'required',
            'number' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            '*.required*' => 'Es necesario completar el campo :attribute.',
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
