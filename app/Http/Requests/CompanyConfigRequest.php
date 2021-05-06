<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required',
            'name' => 'required',
            'privacy_policy_path' => 'nullable|mimes:pdf',
            'terms_and_conditions_path' => 'nullable|mimes:pdf',
            'delivery_days_min' => 'required|numeric',
            'delivery_days_max' => 'required|numeric',
        ];
    }
}
