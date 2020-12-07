<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Http\Requests\PaymentsRequest;
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
        CRUD::setEntityNameStrings('payments', 'payments');
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
            'type' => 'text',
            'label' => 'Monto Total',
        ]);

        CRUD::addColumn([
            'name' => 'amount_paid',
            'type' => 'text',
            'label' => 'Monto Pagado',
        ]);

        CRUD::addColumn([
            'name' => 'number_fee',
            'type' => 'text',
            'label' => 'Nº de Cuotas',
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'type' => 'text',
            'label' => 'Estado',
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

        //dd($dataInvoice->title);
        //CRUD::setFromDb(); // fields
        CRUD::addField([
            'name' => 'customer',
            'label' => 'Cliente',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group ',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'total_document',
            'label' => 'Total Documento',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'subscriber',
            'label' => 'Abonado',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'remaining',
            'label' => 'Restante',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'remaining',
            'label' => 'Restante',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'positive_balance',
            'label' => 'Saldo a favor del cliente',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);
        CRUD::addField([
            'name' => 'total_debt',
            'label' => 'Deuda total del cliente',
            'type' => 'text',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
            'attributes' => [
                'readonly' => 'readonly',
            ],
            'tab' => 'Detalle de la factura',
        ]);

        CRUD::addField([
            'label' => 'Tipo de cuenta',
            'name' => 'bank_account_type_id',
            'type' => 'select2',
            'placeholder' => 'Selecciona un banco',
            'model' => 'App\Models\BankAccountType',
            'attribute' => 'name',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'Detalle de la factura'
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
