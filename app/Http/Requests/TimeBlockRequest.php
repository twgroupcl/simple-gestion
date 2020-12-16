<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TimeBlockRequest extends FormRequest
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
            'name' => 'required',
            'code' => ['required', Rule::unique('time_blocks')->ignore($this->id),],
            'start_time' => 'required',
            'end_time' => 'required',
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
            'name' => 'nombre',
            'code' => 'codigo',
            'start_time' => 'hora de inicio',
            'end_time' => 'hora de fin',
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
            '*.required' => 'El campo :attribute es requerido',
            '*.unique' => 'El :attribute ya se encuentra en uso',
        ];
    }
}
