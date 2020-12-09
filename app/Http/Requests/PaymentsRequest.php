<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

use function GuzzleHttp\json_decode;

class PaymentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $idInvoice;

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
    protected function prepareForValidation() 
    {
        $this->idInvoice = $this->invoice_id;
        $dataPayment = json_decode($this->data_payment,true);
        $dataFee = json_decode($this->data_fee,true);
       // dd($this->data_fee,$this->invoice_id);
        $forValidation = [];
        $forValidationPay = [];
        foreach ($dataFee as $attrs) {
            $forValidation[] = (array) $attrs;
        }
        foreach ($dataPayment as $attrs) {
            $forValidationPay[] = (array) $attrs;
        }
        $this->merge([
            'data_fee_validation' => $forValidation,
            'data_payment_validation' => $forValidationPay,
            //'data_pay_counter' => count($dataFee)
        ]);
    }

    public function rules()
    {
        $dataInvoice = (isset($this->invoice_id))?Invoice::find($this->invoice_id)->select('expiriy_date'):now();
       // dd($dataInvoice,$this->invoice_id,$this->data_fee);
        $countDataFee = (isset($this->data_fee))?count(json_decode($this->data_fee,true)):1;
        return [
            //'data_pay_counter' => 'gte:0|lt:'.$countDataFee,
            //'data_fee_validation.*.date' => 'before_or_equal:'.$dataInvoice->expiriy_date,
            'data_fee_validation.*.amount' => 'gte:0|required',
            'data_fee_validation.*.date' => 'required',
            //'data_payment_validation.*.date' => 'date',
            //'data_payment_validation.*.amount_payment' => 'required|numeric',
           
            /*
            'data_payment' => [
                'required',
                function ($attribute, $value, $fail) {
                    $options = json_decode($value);
                    if($options[0]->payment_method == '' || $options[0]->amount_payment == ''){
                        return $fail('Los campos Método de Pago y Monto son obligatorios');
                    }
                    
            }], */
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
            'data_fee_validation.*.date' => 'fecha de corte',            
            'data_fee_validation.*.amount' => 'monto',            
            'data_payment_validation.*.amount_payment' => 'monto',            
            'data_payment_validation.*.date' => 'fecha',    
            'data_pay_counter' => 'cuotas'
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
            'lt' => 'La cantidad de pagos no puede ser superior a la cantidad de :attribute'
        ];
    }
}
