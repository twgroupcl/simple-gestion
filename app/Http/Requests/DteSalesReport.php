<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class DteSalesReport extends FormRequest
{
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

        return [
            'period_month' => 'required|gte:1|lte:12',
            'period_year' => 'required|gte:2018|lte:2080',
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
            'period_month' => 'Mes',
            'period_year' => 'Año',
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
            'gte' => 'Revise el campo :attribute', 
            'lte' => 'Revise el campo :attribute', 
            'required' => 'Verifique el campo :attribute, es necesario que lo complete',
        ];
    }
}
