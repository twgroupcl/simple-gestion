<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequestRequest extends FormRequest
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
            'customer_id' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'service_id' => 'required|exists:services,id',
            'time_block_id' => 'required|exists:time_blocks,id',
            'company_id' => 'required',
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
            'customer_id' => 'cliente',
            'service_id' => 'servicio',
            'time_block_id' => 'bloque horario',
            'date' => 'fecha de reserva',
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
            'date.after_or_equal' => 'La :attribute debe igual o posterior al dia de hoy',
        ];
    }
}
