<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\InvoiceType;
use App\Http\Requests\Request;
use App\Rules\NumericCommaRule;
use Illuminate\Foundation\Http\FormRequest;

class QuotationCreateRequest extends FormRequest
{

    private $prepareData = [
        'items_data',
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
        $rules =  [
            //'seller_id' => 'required',
            'customer_id' => 'required',
            'quotation_date' => 'required',
            //'expiry_date' => 'after:quotation_date',
            'total' => 'numeric|min:1',
            'title' => 'required',
            'invoice_type_id' => 'required',

            // Order items data
            'items_data_validation.*.name' => 'required',
            'items_data_validation.*.qty' => 'required',
            'items_data_validation.*.price' => ['required', new NumericCommaRule()],
            'items_data_validation.*.total' => 'required',

            'items_data' => function($attribute, $value, $fail) {
                $items = json_decode($value, true);
                if ( !count($items) ) return $fail('Debes añadir por lo menos un producto / servicio.');
 
                $company = Company::findOrFail(backpack_user()->current()->company->id);
                
                if ($company->check_stock_in_quotations) {
                    foreach($items as $item) {
                        if ($item['product_id']) {
                            $product = Product::find($item['product_id']); 
                            if (!$product->haveSufficientQuantity($item['qty'], 'Quotation', $this->id)) {
                                return $fail('No tienes suficiente stock del producto "' . $product->name .'"');
                            }
                        }
                    }
                }
            }
        ];

        if ($this->is_recurring) {
            $rules['repeat_number'] = 'required|numeric|min:1';

            if ($this->quotation_status === Quotation::STATUS_ACCEPTED) {
                $rules['start_date'] = 'date';
            } else {
                $rules['start_date'] = 'date|after_or_equal:today';
            }

            if ($this->end_type === 'date') {
                $rules['end_date'] = 'required|date';
            }

            if ($this->end_type === 'repetition') {
                $rules['end_after_reps'] = 'required|numeric|min:1';
            }
        }

        $invoiceType = InvoiceType::find($this->invoice_type_id);
        
        if ($invoiceType) {
            if ($invoiceType->code != 39 && $invoiceType->code != 41) {
                $rules['address_id'] = 'required|exists:customer_addresses,id';
            }
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'business_id' => 'negocio',
            'customer_id' => 'cliente',
            'quotation_date' => 'fecha de creacion',
            'expiry_date' => 'fecha de vencimiento',
            'total' => 'monto total',
            'invoice_type_id' => 'tipo de documento',

            // Order items data
            'items_data_validation.*.name' => 'nombre del producto / servicio',
            'items_data_validation.*.qty' => 'cantidad del producto / servicio',
            'items_data_validation.*.price' => 'precio del producto / servicio',
            'items_data_validation.*.total' => 'total',

            // Recurring fields
            'start_date' => 'fecha de inicio',
            'repeat_number' => 'repetir cada',
            'end_date' => 'fecha de fin de recurrencia',
            'end_after_reps' => 'numero de repeticiones',

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
            '*.required*' => 'Es necesario completar el campo ":attribute".',
            '*.string' => 'El campo :attribute debe ser texto',
            '*.date' => 'El campo :attribute debe ser de tipo fecha',
            '*.unique' => 'El campo :attribute ya está siendo utilizado por otro cliente.',
            '*.exists' => 'No se pudo encontrar una relación con el campo :attribute.',
            '*.after_or_equal' => 'La fecha del campo ":attribute" debe ser igual o posterior a la fecha actual.',
            '*.min' => 'El campo ":attribute" debe ser por lo menos :min.',
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
