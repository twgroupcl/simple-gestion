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
       //$dataPay = json_decode($this->data_pay);
        $dataFee = json_decode($this->data_fee,true);
       // dd($this->data_fee,$this->invoice_id);
        $forValidation = [];
        foreach ($dataFee as $attrs) {
            $forValidation[] = (array) $attrs;
        }
        $this->merge([
            'data_fee_validation' => $forValidation,
         //   'data_pay_counter' => count($dataPay)
        ]);
    }

    public function rules()
    {
        $dataInvoice = Invoice::find($this->idInvoice);
        //$countDataFee = count(json_decode($this->data_fee));
        return [
            //'data_pay_counter' => 'gte:0|lt:'.$countDataFee,
          //  'data_fee_validation.*.date' => 'before_or_equal:' . $dataInvoice->expiriy_date,
            'data_fee_validation.*.amount' => 'gte:0',
            'data_fee' => [
                'required',
                function ($attribute, $value, $fail) {
                    $options = json_decode($value);
                    if($options[0]->amount == '' || $options[0]->date == ''){
                        return $fail('Los campos Fecha de corte y Monto son obligatorios');
                    }
                    
            }],
            'data_payment' => [
                'required',
                function ($attribute, $value, $fail) {
                    $options = json_decode($value);
                    if($options[0]->payment_method == '' || $options[0]->amount_payment == ''){
                        return $fail('Los campos Método de Pago y Monto son obligatorios');
                    }
                    
            }],
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
            'data_fee.date' => 'fecha de corte',            
            'data_fee.amount' => 'monto',            
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
}
