<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Seller;
use App\Rules\NumericCommaRule;
use App\Models\InvoiceType;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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

        $expiryDateRules = '';
        if (request()->way_to_payment == 2) {
            $expiryDateRules = 'required|date|after_or_equal:invoice_date';
        } 

        $sellerRules = 'nullable|exists:sellers,id';
        if (Seller::where('user_id', backpack_user()->id)->exists()) {
            //set seller in observer
            $sellerRules = '';
        }

        $rules =  [
            'invoice_type_id' => 'required|exists:invoice_types,id',
            'total' => 'gte:0',
            'invoice_date' => 'date',
            'seller_id' => $sellerRules,
            'discount_percent' => 'gte:0,lte:100', 
            'discount_amount' => 'gte:0',
            'customer_id' => 'required|exists:customers,id', 
            //'address_id' => 'required|exists:customer_addresses,id',
            'expiry_date' => $expiryDateRules,
            // 'name' => 'required|min:5|max:255'
            //
            // Order items data
            'items_data_validation.*.name' => 'required',
            'items_data_validation.*.qty' => 'required',
            'items_data_validation.*.price' => ['required', new NumericCommaRule()],
            'items_data_validation.*.total' => 'required',

            'items_data' => function($attribute, $value, $fail) {
                $items = json_decode($value, true);
                if ( !count($items) ) return $fail('Debes añadir por lo menos un producto / servicio.');

                foreach($items as $item) {
                    if ($item['product_id']) {
                        $product = Product::find($item['product_id']); 
                        if (!$product->haveSufficientQuantity($item['qty'], 'Invoice', $this->id)) {
                            return $fail('No tienes suficiente stock del producto "' . $product->name .'"');
                        }
                    }
                }
            }
        ];

        $invoiceType = InvoiceType::find($this->invoice_type_id);
        
        if ($invoiceType) {
            if ($invoiceType->code != 39 && $invoiceType->code != 41) {
                $rules['business_activity_id'] = 'required|exists:business_activities,id';
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
            'customer_id' => 'cliente',
            'seller_id' => 'vendedor',
            'discount_percent' => 'descuento global',
            'discount_amount' => 'descuento global',
            'invoice_date' => 'fecha de emisión',
            'expiry_date' => 'fecha de vencimiento',
            'invoice_type_id' => 'tipo de documento',
            'address_id' => 'dirección',
            'business_activity_id' => 'giro',
            // Order items data
            'items_data_validation.*.name' => 'nombre del producto / servicio',
            'items_data_validation.*.qty' => 'cantidad del producto / servicio',
            'items_data_validation.*.price' => 'precio del producto / servicio',
            'items_data_validation.*.total' => 'total',
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
            'gte' => 'El campo :attribute debe ser mayor o igual a 0',
            'required' => 'Verifique el campo :attribute, es necesario que lo complete',
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
