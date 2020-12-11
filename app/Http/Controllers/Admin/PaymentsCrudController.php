<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Http\Requests\PaymentsRequest;
use App\Models\Bank;
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
        $banks = Bank::get();

        $dataInvoice->remaining_amount = $dataPayment->amount_total-$dataPayment->amount_paid;
        $data_fee = json_decode(request()->data_fee);
        $cntDataFee = (isset($data_fee))?count($data_fee):null;

        $dataPayment->amount_paid = $dataPayment->amount_paid+request()->amount_payment;
        if($cntDataFee){
            $dataPayment->number_fee = $cntDataFee;
        }
        $dataPayment->save();

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
                [
                    'name'    => 'status_fee',
                    'value'    => '1',
                    'type'    => 'hidden',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
            ],
            'fake' => true,
            'store_in' => 'data_fee',
            'tab' => 'Programar pagos',
        ]);

        CRUD::addField([
            'type' => 'hidden',
            'name' => 'date_now',
            'value' => date('Y-m-d'),
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name' => 'table_payment',
            'label' => 'Tabla de pago',
            'type' => 'payment.table_payment',
            'payment' => $dataPayment,            
            'wrapper' => ['class' => 'form-group col-md-12'],
            'tab' => 'Pagos'
        ]);
        
        $fees = $this->crud->getCurrentEntry()->data_fee;
        $firstFee = collect($fees)->sortBy('date')->firstWhere('status_fee',1);   
        CRUD::addField([
            'type' => 'hidden',
            'name' => 'date_fee',
            'value' => (!is_null($firstFee))?$firstFee['date']:'',
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
    
        CRUD::addField([
            'name' => 'payment_method',
            'label' => 'Método de pago',
            'type' => 'expense.fields_payment_method',
            'wrapper' => ['class' => 'col-md-6'],
            'attributes' => ['class' => 'select-payment-method'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name' => 'status_payment',
            'type' => 'hidden',
            'value' => '1',
            'attributes' => ['class' => 'select-payment-method'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'label' => 'Banco',
            'name' => 'bank_id',
            'type' => 'select2',
            'placeholder' => 'Selecciona un banco',
            'model' => 'App\Models\Bank',
            'attribute' => 'name',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-pcc input-tr input-tc input-td input-ch input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'amount_payment',
            'type'    => 'number',
            'label'   => 'Monto',
            'value'   => (!is_null($firstFee))?$firstFee['amount']:'',
            'attributes' => ['readonly' => 'readonly'],
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-ef input-ch input-tc input-tr input-pcc input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'rut',
            'type'    => 'text',
            'label'   => 'Rut',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'serial_number',
            'type'    => 'text',
            'label'   => 'Nº de Serie',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'account_number',
            'type'    => 'text',
            'label'   => 'Nº de cuenta',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-tr input-pcc input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'date',
            'type'    => 'date',
            'label'   => 'Fecha',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-ch input-tr input-pcc input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'voucher_number',
            'type'    => 'text',
            'label'   => 'Nº de Comprobante',
            'wrapper' => ['class' => 'form-group col-md-6 d-none input-tc input-tr input-pcc input-payment'],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);
        CRUD::addField([
            'name'    => 'comment',
            'type'    => 'textarea',
            'label'   => 'Comentario',
            'wrapper' => ['class' => 'form-group col-md-6'],
            'attributes' => ['maxlength' => 12],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos'
        ]);

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
