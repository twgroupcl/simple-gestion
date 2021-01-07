<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Transaction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transaction');
        CRUD::setEntityNameStrings('movimiento', 'movimientos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

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
        CRUD::setValidation(TransactionRequest::class);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */

        CRUD::addField([
            'name' => 'payment_or_expense',
            'type' => 'select_from_array',
            'label' => 'Cargo/Abono',
            'options' => [
                'Cargo',
                'Abono',
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        //depends on type payment/expense
        CRUD::addField([
            'name' => 'transaction_type_id',
            'minimum_input_length' => 0,
            'type' => 'relationship',
            'include_all_form_fields'  => true, 
            'dependencies' => [ 'payment_or_expense' ],
            'label' => 'Tipo de transacción',
            'entity' => 'transaction_type',
            'attribute' => 'name',
            'model' => 'App\Models\TransactionType',
            'inline_create' => [ 'entity' => 'transactiontype' ], 
            'ajax' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'placeholder' => 'Seleccione un tipo de transacción...'
        ]);

        CRUD::addField([
            'name' => 'date',
            'type' => 'date',
            'label' => 'Fecha de movimiento',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ]
        ]);

        CRUD::addField([
            'name' => 'accounting_account_id',
            'type' => 'relationship',
            'label' => 'Cuenta contable',
            'model' => 'App\Models\AccountingAccount',
            'entity' => 'accounting_account',
            'attribute' => 'code',
            'minimum_input_length' => 0,
            'inline_create' => [ 
                'entity' => 'accountingaccount' 
            ],
            'ajax' => true,
            'placeholder' => 'Seleccione un tipo de cuenta cont...',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'json_transaction_details',
            'type' => 'repeatable',
            'label' => 'Detalle',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'number',
                    'prefix' => '$',
                    'label' => 'Monto/Valor',
                ]
            ],
            'new_item_label' => 'Agregar detalle',
        ]);

        CRUD::addField([
            'name' => 'document_identifier',
            'label' => 'Documento relacionado',
            'type' => 'select2_from_array',
            'options' => [
                2 => 'DTE1',
                12 => 'DTE2',
                3 => 'DTE3',
                10 => 'other document',
            ]
        ]);

        CRUD::addField([
            'name' => 'notes',
            'label' => 'Detalle de movimiento',
            'type' => 'textarea',
        ]);

        CRUD::addField([
            'name' => 'bank_account_id',
            'type' => 'relationship',
            'label' => 'Cuenta afectada',
            'model' => 'App\Models\BankAccount',
            'entity' => 'bank_account',
            'attribute' => 'account_number',
            'minimum_input_length' => 0,
            'inline_create' => [ 
                'entity' => 'bankaccount' 
            ],
            'ajax' => true,
            'placeholder' => 'Seleccione la cuenta bancaria relacionada...',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
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


    /*
     *
     * FETCH METHODS
     *
     */

    public function fetchTransaction_type()
    {
        $form = collect(request()->input('form'))->pluck('value','name');
        $is_payment = $form['payment_or_expense'];
        return $this->fetch([
            'model' => \App\Models\TransactionType::class,
            'searchable_attributes' => ['name', 'code'],
            'paginate' => 10,
            'query' => function ($model) use ($is_payment) {
                return $model->where('is_payment', $is_payment);
            }
        ]);
        //return $this->fetch(\App\Models\TransactionType::class);
    }

    public function fetchAccounting_account()
    {
        return $this->fetch(\App\Models\AccountingAccount::class);
    }

    public function fetchBank_account()
    {
        return $this->fetch(\App\Models\BankAccount::class);
    }
}
