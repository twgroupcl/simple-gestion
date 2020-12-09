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
        
        $dataInvoice->remaining_amount = $dataPayment->amount_total-$dataPayment->amount_paid;

        $data_fee = json_decode(request()->data_fee);
        $cntDataFee = (isset($data_fee))?count($data_fee):null;
        $data_payment = json_decode(request()->data_payment);

        if(!is_null($data_fee)){
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
        }

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
            'name'            => 'data_payment',
            'label'           => 'Registrar pago',
            'new_item_label'  => 'Agregar pago',
            'type'  => 'repeatable',
            'limit'  => '3',
            'fields' => [
                [
                    'name' => 'payment_method',
                    'label' => 'Método de pago',
                    'type' => 'select2_from_array',
                    'options' => [
                        'EF' => 'Efectivo', 
                        'PE' => 'Pago a Cta. Cte.',
                        'TC' => 'Tarjeta de crédito',
                        'CF' => 'Cheque a fecha',
                        'OT' => 'Otro'
                    ],
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'amount_payment',
                    'type'    => 'number',
                    'label'   => 'Monto',
                    'wrapper' => ['class' => 'form-group col-md-6'],
                ],
                [
                    'name'    => 'comment',
                    'type'    => 'textarea',
                    'label'   => 'Comentario',
                    'wrapper' => ['class' => 'form-group col-md-12'],
                ],
            ],
            'fake' => true,
            'store_in' => 'data_payment',
            'tab' => 'Pagos',
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
