<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
     private $prepareData = [
        'json_transaction_details',
    ];

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
        $documentTypeRules = [];
        if (request()['document_type'] == 1) {
            $documentTypeRules = 'required|exists:invoices,id';

        }
        return [
            'date' => 'required|date',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'json_transaction_details' => 'required',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'accounting_account_id' => 'nullable|exists:accounting_accounts,id',
            'note' => 'required|min:5',
            //'payment_or_expense' => ['required', Rule::in([0,1])],
            'json_transaction_details_validation.*.value' => 'required|numeric|digits_between:0,10',
            'document_identifier' => $documentTypeRules,
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
            'date' => 'fecha de movimiento',
            'json_transaction_details' => 'detalle',
            'accounting_account_id' => 'cuenta contable',
            'bank_account_id' => 'cuenta afectada',
            'transaction_type_id' => 'tipo de transacción',
            'json_transaction_details_validation.*.value' => 'valor',
            'note' => 'detalle de movimiento',
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
            'required' => 'Revise el campo :attribute, es necesario que lo complete',
            'exists' => 'Revise el campo :attribute, parece estar mal.',
            'numeric' => 'El campo :attribute es numérico',
            'digits_between' => 'El número del campo ":attribute" tiene más de :max dígitos',
            'min' => 'Revise el campo :attribute, debe tener más de :min de largo',
            //
            //
        ];
    }

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
}
