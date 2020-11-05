<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
{
    private $prepareData = [
        'addresses',
    ];

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
            'uid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'cellphone' => 'required',

            'addresses' => 'required',
            'addresses_array' => 'required|array',
            'addresses_validation.*.uid' => 'required',
            'addresses_validation.*.firstname' => 'required',
            'addresses_validation.*.lastname' => 'required',
            'addresses_validation.*.street' => 'required',
            'addresses_validation.*.number' => 'required',
            'addresses_validation.*.telephone' => 'required',
            'addresses_validation.*.cellphone' => 'required',

        ];
    }

    protected function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 422)); 
    }

    protected function prepareForValidation()
    {
        foreach ($this->prepareData as $attrName) {
            if (empty($this->$attrName)) {
                return;
            }

            $validation = json_decode($this->$attrName);

            $this->merge([
                $attrName.'_array' => $validation,
            ]);

            $forValidation = [];

            if (! is_array($validation)) {
                continue;
            }

            foreach ($validation as $attrs) {
                $forValidation[] = (array) $attrs;
            }

            $this->merge([
                $attrName.'_validation' => $forValidation,
            ]);
        }
    }
}
