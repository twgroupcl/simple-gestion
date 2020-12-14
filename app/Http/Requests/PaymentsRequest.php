<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as RequestHelper;
use Illuminate\Validation\Factory as ValidationFactory;

use function GuzzleHttp\json_decode;

class PaymentsRequest extends FormRequest
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
   
    protected function prepareForValidation() 
    {
        $this->idInvoice = $this->invoice_id;
        $dataFee = json_decode($this->data_fee,true);
        $forValidation = [];
        
        foreach ($dataFee as $attrs) {
            $forValidation[] = (array) $attrs;
        }
   
        $this->merge([
            'data_fee_validation' => $forValidation,
            'invoice_id' => $this->invoice_id,
        ]);
    }

    public function rules()
    {

        return [
          
            'data_fee_validation.*.amount' => 'required',
            'data_fee_validation.*.date' =>   ['required',function ($attribute, $value, $fail) {
                $dataInvoice = Invoice::find($this->invoice_id);
                if($value > $dataInvoice->expiry_date){
                    return $fail('La fecha no puede ser mayor a la fecha de fin de la factura');
                }
                if($value == null){
                    return $fail('El campo fecha de corte es obligatorio');
                }
            }],
            'total_fee' => ['required',function ($attribute, $value, $fail) {
                $dataInvoice = Invoice::find($this->invoice_id);
                if($value != $dataInvoice->total){
                    return $fail('El monto total de las cuotas debe ser igual al monto total de la factura');
                }
            }] 
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
            //'data_payment_validation.*.amount_payment' => 'monto',            
            //'data_payment_validation.*.date' => 'fecha',    
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
