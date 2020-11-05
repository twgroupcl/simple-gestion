<?php

namespace App\Http\Requests\Api;

use App\Rules\RutRule;
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
            'uid' => ['required', new RutRule()],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            //'phone' => 'required',
            //'cellphone' => 'required',

            'sii_activity' => 'required_if:taxable,1|exists:business_activities,id',

            'taxable' => 'required',
            'birthday' => 'required|date_format:d-m-Y',
            //'gender' => 'in:female,male,other',

            'addresses' => 'required|json',
            'addresses_array' => 'required|array',
            'addresses_validation.*.uid' => 'required',
            'addresses_validation.*.first_name' => 'required',
            'addresses_validation.*.last_name' => 'required',
            'addresses_validation.*.street' => 'required',
            'addresses_validation.*.number' => 'required',
            //'addresses_validation.*.phone' => 'required',
            //'addresses_validation.*.cellphone' => 'required',

            'custom_attributes' => 'json',

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
