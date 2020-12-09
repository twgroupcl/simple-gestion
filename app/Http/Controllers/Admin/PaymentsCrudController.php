<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Http\Requests\PaymentsRequest;
use App\Payment;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PaymentsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Payments::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payments');
        CRUD::setEntityNameStrings('Pagos', 'Pagos');
        $this->crud->denyAccess(['create', 'delete']);

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        CRUD::addColumn([
            'name' => 'invoice_id',
            'type' => 'text',
            'label' => 'ID Factura',
        ]);

        CRUD::addColumn([
            'name' => 'amount_total',
            'type' => 'number',
            'label' => 'Monto Total',
            'dec_point' => ',',
            'thousands_sep' => '.',
            'decimals' => 0,
            'prefix' => '$',
        ]);

        CRUD::addColumn([
            'name' => 'amount_paid',
            'type' => 'number',
            'label' => 'Monto Pagado',
            'dec_point' => ',',
            'thousands_sep' => '.',
            'decimals' => 0,
            'prefix' => '$',
        ]);

        CRUD::addColumn([
            'name' => 'number_fee',
            'type' => 'text',
            'label' => 'Nº de Cuotas',
        ]);
     

        CRUD::addColumn([
            'name' => 'status_description',
            'type' => 'text',
            'label' => 'Estado',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Completa') {
                        return 'badge badge-success';
                    }
                    if ($column['text'] == 'Pagada') {
                        return 'badge badge-success';
                    }
                    return 'badge badge-default';
                },
            ],
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaymentsRequest::class);
        
        $idInvoice = $this->crud->getCurrentEntry()->invoice_id;
        $dataInvoice = Invoice::where('id',$idInvoice)->first();
        $dataPayment = Payment::find($this->crud->getCurrentEntry()->id);
        $dataPay = $dataPayment;

        $dataInvoice->remaining_amount = $dataPayment->amount_total-$dataPayment->amount_paid;

        $data_fee = json_decode(request()->data_fee);
        $cntDataFee = (isset($data_fee))?count($data_fee):null;
        $data_payment = json_decode(request()->data_payment);

       /*  if(!is_null($data_fee)){
            $amountFee = 0;

            foreach($data_fee as $dataFee){
                $amountFee += $dataFee->amount;
                if($dataFee->date > $dataInvoice->expiry_date){
                    return 'error';
                }
            }
            if($amountFee > $dataInvoice->total){
                return 'error';
            }
        } */

        //CRUD::setFromDb(); // fields
        CRUD::addField([
            'type' => 'payment.table_invoice',
            'name' => 'totals_card',
            'invoice' => $dataInvoice,
            'payment' => $dataPayment,            
            'wrapper' => [
                'class' => 'form-group col-md-6 offset-3',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        
        unset($dataPayment->remaining_amount);
        $dataPayment->number_fee = $cntDataFee;
        $dataPayment->save();

        CRUD::addField([
            'type' => 'hidden',
            'name' => 'invoice_id',
            'tab' => 'Programar pagos',
        ]);

        CRUD::addField([  
            'name'            => 'data_fee',
            'label'           => 'Cuotas',
            'new_item_label'  => 'Agregar Cuota',
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name'    => 'date',
                    'type'    => 'date',
                    'label'   => 'Fecha de corte',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'amount',
                    'type'    => 'number',
                    'label'   => 'Monto',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
            ],
            'fake' => true,
            'store_in' => 'data_fee',
            'tab' => 'Programar pagos',
        ]);

        CRUD::addField([
            'name' => 'table_payment',
            'label' => 'Tabla de pago',
            'type' => 'payment.table_payment',
            'payment' => $dataPay,            
            'wrapper' => ['class' => 'form-group col-md-6 offset-3'],
            'tab' => 'Pagos'
        ]);

        CRUD::addField([
            'name' => 'form_payment',
            'label' => 'Formulario de pago',
            'type' => 'payment.form_payment',
            'payment' => $dataPay,            
            'wrapper' => ['class' => 'form-group col-md-12'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);

       /*   CRUD::addField([  
            'name'            => 'data_payment',
            'label'           => 'Registrar pago',
            'new_item_label'  => 'Agregar pago',
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name' => 'payment_method',
                    'label' => 'Método de pago',
                    'type' => 'expense.fields_payment_method',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                    'attributes' => ['class' => 'select-payment-method'],
                ],
                [
                    'label' => 'Banco',
                    'name' => 'bank_id',
                    'type' => 'select2',
                    'placeholder' => 'Selecciona un banco',
                    'model' => 'App\Models\Bank',
                    'attribute' => 'name',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-pcc input-tr input-tc input-td input-ch input-payment']
                ],
                [
                    'name'    => 'amount_payment',
                    'type'    => 'text',
                    'label'   => 'Monto',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-ef input-ch input-tc input-tr input-pcc input-payment'],
                ],
                [
                    'name'    => 'rut',
                    'type'    => 'text',
                    'label'   => 'Rut',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-payment'],
                ],
                [
                    'name'    => 'serial_number',
                    'type'    => 'text',
                    'label'   => 'Nº de Serie',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-payment'],
                ],
                [
                    'name'    => 'account_number',
                    'type'    => 'text',
                    'label'   => 'Nº de cuenta',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-tr input-pcc input-payment'],
                ],
                [
                    'name'    => 'date',
                    'type'    => 'date',
                    'label'   => 'Fecha',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-tr input-pcc input-payment'],
                ],
                [
                    'name'    => 'voucher_number',
                    'type'    => 'text',
                    'label'   => 'Nº de Comprobante',
                    'wrapper' => ['class' => 'form-group col-md-6 d-none input-tc input-tr input-pcc input-payment'],
                ],
                [
                    'name'    => 'comment',
                    'type'    => 'textarea',
                    'label'   => 'Comentario',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
            ],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos',
        ]);  */

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
