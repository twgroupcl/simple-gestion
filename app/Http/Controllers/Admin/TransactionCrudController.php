<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\{ Invoice, Transaction };
use Carbon\Carbon;

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
        CRUD::setModel(Transaction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transaction');
        CRUD::setEntityNameStrings('movimiento', 'movimientos');
        $this->crud->denyAccess('show');
        if (!backpack_user()->hasPermissionTo('conciliation')) {
            $this->crud->denyAccess(['list', 'create', 'update']);
        }

        $company = backpack_user()->current()->company;
        $this->crud->addClause('where', 'company_id', $company->id);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        $this->crud->addFilter([
          'type'  => 'date_range',
          'name'  => 'date',
          'label' => 'Rango - Fecha de movimiento'
        ],
        false,
        function ($value) {
          $dates = json_decode($value);
          $this->crud->addClause('where', 'date', '>=', $dates->from);
          $this->crud->addClause('where', 'date', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addColumn([
            'name' => 'accounting_account',
            'label' => 'Cuenta contable'
        ]);

        CRUD::addColumn([
            'name' => 'bank_account',
            'label' => 'Cuenta bancaria',
            'type' => 'relationship',
            'attribute' => 'account_number'
        ]);

        CRUD::addColumn([
            'name' => 'transaction_type',
            'label' => 'Tipo de movimiento'
        ]);

        CRUD::addColumn([
            'name' => 'date',
            'label' => 'Fecha de movimiento',
            'type' => 'date',
            'format' => 'L',
        ]);

        /*CRUD::addColumn([
            'name' => 'document_identifier',
            'label' => 'Documento',
            'type' => 'model_function',
            'function_name' => 'getDocumentInfo',
        ]);*/

        CRUD::addColumn([
            'name' => 'payment_or_expense',
            'label' => 'Cargo/Gasto',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] === 'Abono') {
                        return 'badge badge-success';
                    }

                    if ($column['text'] === 'Gasto') {
                        return 'badge badge-danger';
                    }

                }
            ]
        ]);

        CRUD::addColumn([
            'name' => 'amount',
            'label' => 'Monto total',
            'type' => 'model_function',
            'function_name' => 'getTotalAmount',
        ]);

        CRUD::addcolumn([
            'name' => 'note',
            'type' => 'text',
            'label' => 'Detalle de movimiento',
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
        CRUD::setValidation(TransactionRequest::class);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
/*
        CRUD::addField([
            'name' => 'payment_or_expense',
            'type' => 'select_from_array',
            'label' => 'Cargo/Abono',
            'options' => [
                1 => 'Abono',
                0 => 'Cargo',
            ],
            'value' => $this->crud->getCurrentEntry()->transaction_type->is_payment ?? null,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);*/

        //depends on type payment/expense
        CRUD::addField([
            'name' => 'transaction_type_id',
            'minimum_input_length' => 0,
            'allows_null' => true,
            'type' => 'relationship',
            'include_all_form_fields'  => true, 
            'dependencies' => [ 'payment_or_expense' ],
            'label' => 'Tipo de movimiento',
            'entity' => 'transaction_type',
            'attribute' => 'string_for_select',
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
            'format' => 'L',
            'value' => $this->crud->getCurrentEntry() ? Carbon::create($this->crud->getCurrentEntry()->date) : null,
            'label' => 'Fecha de movimiento',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ]
        ]);

        CRUD::addField([
            'name' => 'accounting_account_id',
            'type' => 'relationship',
            'allows_null' => true,
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


        $dtes = Invoice::all()->pluck('title', 'id')->toArray();
        CRUD::addField([
            'name' => 'json_transaction_details',
            'type' => 'transactions.repeatable',
            'label' => 'Desglose',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'text',
                    'prefix' => '$',
                    'label' => 'Monto/Valor',
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'label' => 'Documento',
                    'name' => 'document_identifier',
                    'type' => 'transactions.select2_custom',
                    'model' => 'App\Models\Invoice',
                    'placeholder' => 'Selecciona un documento',
                    'attribute' => 'title',
                    'data_source' => url('admin/api/transaction/get-documents-by-company'),
                    'minimum_input_length' => 0,
                    'include_all_form_fields'  => true,
                    //'dependencies'  => ['seller_id'],
                    'wrapper' => [
                        'class' => 'form-group col-md-3 document-select',
                    ],
                    'attributes' => [
                        'class' => 'form-control document-id-field'
                    ]
                ],
                [
                    'label' => 'Documento',
                    'name' => 'name',
                    'type' => 'text',
                    'wrapper' => [
                        'class' => 'form-group col-md-3 custom-document-name',
                        'style' => 'display:none',
                    ],
                    'attributes' => [
                        'placeholder' => 'Nombre del producto o servicio',
                        'class' => 'form-control document-name-field'
                    ],
                ],
                //[
                //    'label' => 'Producto / Servicio',
                //    'name' => 'name',
                //    'type' => 'text',
                //    'wrapper' => [
                //        'class' => 'form-group col-md-3 custom-product-name',
                //        'style' => 'display:none',
                //    ],
                //    'attributes' => [
                //        'placeholder' => 'Nombre del producto o servicio',
                //        'class' => 'form-control product-name-field'
                //    ],
                //],

                //[
                //    'name' => 'document_identifier',
                //    'label' => 'Número de documento',
                //    'type' => 'select2_from_array',
                //    'options' => $dtes,
                //    'allows_null' => true,
                //    'placeholder' => 'Seleccione un documento...',
                //    'wrapperAttributes' => [
                //        'class' => 'form-group col-md-6',
                //    ],
                //],
                [
                    'label' => 'Es un producto/servicio personalizado',
                    'name' => 'is_custom',
                    'type' => 'checkbox',
                    'attributes' => [
                        'class' => 'checkbox-is-custom',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-3',
                    ],
                ],
                //[
                //    'name' => 'is_custom_document',
                //    'type' => 'checkbox',
                //    'attributes' => [
                //        'class' => 'checkbox-is-custom',
                //    ],
                //    'label' => 'Introducir un documento manualmente',
                //    'wrapperAttributes' => [
                //        'class' => 'form-group col-md-6 offset-6',
                //    ],
                //],
                [
                    'name' => 'notes',
                    'type' => 'textarea',
                    'label' => 'Detalle',
                ],
            ],
            'new_item_label' => 'Agregar detalle',
        ]);

        CRUD::addField([
            'name' => 'total_amounts',
            'type' => 'transactions.total',
            'repeatable_field' => 'json_transaction_details',
            'amount_field' => 'value',
        ]);

        //$documentType = null;
        /*if ($this->crud->getCurrentEntry() !== null && isset($this->crud->getCurrentEntry()->document_identifier)) {
            $documentType = 1;
        }*/
        // select document
        /*
        CRUD::addField([
            'name' => 'document_type',
            'label' => 'Tipo de documento relacionado',
            'allows_null' => true,
            'type' => 'select2_from_array',
            'options' => [
                1 => 'DTE',
            ],
            'value' => $documentType,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        //script show or not dtes
        CRUD::addField([
            'name' => 'script_show_dtes',
            'type' => 'transactions.script_show_dtes',
            'field' => 'document_identifier',
            'dependency' => 'document_type'
        ]);

        $dtes = Invoice::where('invoice_status', Invoice::STATUS_SEND)->get()->pluck('to_string', 'id')->toArray();
        CRUD::addField([
            'label' => 'Seleccione el documento según su folio',
            'name' => 'document_identifier',
            'type' => 'select2_from_array',
            'options' => $dtes,
        ]);
         */
        CRUD::addField([
            'name' => 'note',
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
        return $this->fetch([
            'model' => \App\Models\TransactionType::class,
            'searchable_attributes' => ['name', 'code'],
            'paginate' => 10,
            'query' => function ($model) {
                return $model->orderBy('is_payment', 'ASC');
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

    /**
     * Get and filter a list of configurable attributes depending of the product class
     *
     */
    public function getDocumentsByCompany(Request $request) {
        $company = backpack_user()->current()->company->id;

        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = Invoice::query();

        if ($request->has('keys')) {
            return Invoice::findMany($request->input('keys'));
        }

        if (isset($company)) {
            $options = $options->where('company_id', $company);
        }

        // Filter by search term
        if ($search_term) {
            $results = $options->whereRaw('LOWER(title) like ?', '%'.strtolower($search_term).'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }
        return $options->paginate(10);
    }

}
