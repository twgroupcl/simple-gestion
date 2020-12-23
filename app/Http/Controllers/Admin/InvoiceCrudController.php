<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\{ InvoiceRequest, DteSalesReport };
use App\Exports\DteSalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\{Tax, Invoice, InvoiceType, CustomerAddress, Seller, Company};
use App\Services\DTE\DTEService;
/**
 * Class InvoiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvoiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $emitter;
    protected $seller;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Invoice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invoice');
        CRUD::setEntityNameStrings('documento electrónico', 'documentos electrónicos');
        $this->crud->enableExportButtons();
        
        $this->seller = Seller::where('user_id', backpack_user()->id);
        if ($this->seller->exists()) {
            $this->seller= $this->seller->first();
            if (! backpack_user()->can('showAllInvoices')) {
                $this->crud->addClause('where', 'seller_id', $this->seller->id);
            }
            if ($this->seller->is_approved !== Seller::STATUS_ACTIVE) {
                $this->crud->denyAccess(['create', 'update', 'delete']);
            }
        } else {
            $this->seller = null;
        }
        
        $company = backpack_user()->current()->company->id; 
        $company = Company::find($company);
        $this->emitter = $company;
        $this->crud->addClause('where', 'company_id', $company->id);

        $this->crud->denyAccess('show');

        // if dte is real, deny delete
        if ($this->crud->getCurrentOperation() === 'delete' && $this->crud->getCurrentEntry()->invoice_status === Invoice::STATUS_SEND) {
            $this->crud->denyAccess(['delete']);
        }
    }

    protected function setupDteSalesReportRoutes($segment, $routeName, $controller)
    {
        \Route::get($segment.'/dte_sales_report', [
            'as'        => $routeName.'.getDteSalesReport',
            'uses'      => $controller.'@getDteSalesReportForm',
            'operation' => 'salesreport',
        ]);

        \Route::post($segment.'/dte_sales_report', [
            'as'        => $routeName.'.postDteSalesReport',
            'uses'      => $controller.'@postDteSalesReportForm',
            'operation' => 'salesreport',
        ]);
    }

    public function getDteSalesReportForm()
    {
        $this->crud->setOperation('Salesreport');
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Generar reporte de ventas';
        return view('vendor.backpack.reports.dte_sales_report', $this->data);
    }

    public function postDteSalesReportForm(DteSalesReport $request )
    {
        $company = backpack_user()->current()->company->id;
        $company = Company::find($company);
        $uid = $company->uid;

        $dte = new DTEService();
        $response = $dte->getSalesReport($uid, $request->period_year . $request->period_month);
        
        if ($response->getStatusCode() === 200) {
            $salesReport = json_decode($response->getBody()->getContents(), true);

            $documentsWCN = \Arr::where($salesReport, function ($value, $key) {
                return $value['dte'] != 61;
            });

            $creditNotes = \Arr::where($salesReport, function ($value, $key) {
                return $value['dte'] === 61;
            });

            $array = [];

            foreach ($creditNotes as $document) {

                $moreData = $dte->getDataEmittedDocumentUnstructure($document['dte'], $document['folio'], $uid);
                if ($moreData->getStatusCode() !== 200) {
                    \Alert::warning('Lo sentimos, no se pudo generar el reporte')->flas();
                    return \Redirect::to($this->crud->route . '/dte_sales_report');
                }
                $response = $moreData->getBody()->getContents();
                $moreData = json_decode($response, true);
                $moreData = $moreData['datos_dte']['Referencia'];

                $documentsWCN = \Arr::where($documentsWCN, function ($value, $key) use ($moreData) {
                    return $value['folio'] != $moreData['FolioRef'] && $value['dte'] == $moreData['TpoDocRef'];
                });
            }

            foreach ($documentsWCN as &$document) {
                $moreData = $dte->getDataEmittedDocumentUnstructure($document['dte'], $document['folio'], $uid);
                if ($moreData->getStatusCode() !== 200) {
                    \Alert::warning('Lo sentimos, no se pudo generar el reporte')->flas();
                    return \Redirect::to($this->crud->route . '/dte_sales_report');
                }
                $response = $moreData->getBody()->getContents();
                $moreData = json_decode($response, true);
                $moreData = $moreData['datos_dte'];

                $totals = $moreData['Encabezado']['Totales'];
                $document['net'] = $totals['MntNeto']; 
                $document['tax'] = array_key_exists('IVA', $totals) ? $totals['IVA'] : ''; 

            }

            $report = new DteSalesReportExport($documentsWCN);
            return Excel::download($report, 'sales_report.xlsx');

        }
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
        
        // create temporary document
         
        $this->crud->addButtonFromView(
            'line', 'create_temporary_document', 
            'invoice.to_manage', 'beginning'
        );

        CRUD::addColumn([
            'label' => 'Fecha de emision',
            'name' => 'invoice_date',
            'type' => 'date',
            'format' => 'L',
        ]);

        CRUD::addColumn([
            'name' => 'first_name',
            'label' => 'Nombre / Razón Soc.'
        ]);

        CRUD::addColumn([
            'name' => 'uid',
            'label' => 'RUT'
        ]);

        CRUD::addColumn([
            'name' => 'invoice_type',
            'type' => 'relationship',
            'label' => 'Tipo',
        ]);

        CRUD::addColumn([
            'name' => 'folio'
        ]);

        CRUD::addColumn([
            'name' => 'total',
            'label' => 'Total',
            'type' => 'number',
            'prefix'        => '$',
            'decimals'      => 0,
            'thousands_sep' => ' ',
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
        CRUD::setValidation(InvoiceRequest::class);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
          
        //$this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        CRUD::addField([
            'label' => 'Cliente',
            'name' => 'customer_id',
            'type' => 'relationship',
            'entity' => 'customer',
            'attribute' => 'full_name_with_uid',
            'placeholder' => 'Selecciona un cliente',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Título',
            'name' => 'title',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        /*
         * TO DO change method addresses to CustomerAddress
         */
        CRUD::addField([
            'label' => 'Dirección',
            'type' => 'select2_from_ajax',
            'name' => 'address_id',
            'entity' => 'address',
            'attribute' => 'addressDescription',
            'data_source' => url('admin/quotation/addresses'),
            'placeholder' => 'Selecciona una dirección',
            'minimum_input_length' => 0,
            'model' => CustomerAddress::class,
            'dependencies' => ['customer_id'],
            'method' => 'POST',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'include_all_form_fields' => true,
            'tab' => 'General',
        ]);
        
        CRUD::addField([
            'label' => 'Fecha de emisión',
            'name' => 'invoice_date',
            'type' => 'date',
            'default' => date("Y-m-d"),
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Fecha vencimiento',
            'name' => 'expiry_date',
            'type' => 'date',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        if (backpack_user()->hasRole('Administrador negocio') && !empty($this->seller)) {
            $sellerId = $this->seller->id;
            CRUD::addField([
                'label' => 'Vendedor',
                'name' => 'seller_id',
                'type' => 'select2',
                'placeholder' => 'Selecciona un vendedor',
                'model' => 'App\Models\Seller',
                'attribute' => 'name',
                'default' => $sellerId, 
                'wrapper' => [
                    'class' => 'form-group col-md-3',
                ],
                'tab' => 'General',
                'options' => (function ($query) use($sellerId) {
                    return $query->where('id', $sellerId)->get();
                })
            ]);

        } else {
            CRUD::addField([
                'label' => 'Vendedor',
                'name' => 'seller_id',
                'type' => 'select2',
                'placeholder' => 'Selecciona un vendedor',
                'model' => 'App\Models\Seller',
                'attribute' => 'name',
                'wrapper' => [
                    'class' => 'form-group col-md-3',
                ],
                'tab' => 'General',
            ]);
        }

        CRUD::addField([
            'type' => 'select2_from_array',
            'options' => InvoiceType::active()->pluck('name','id')->sort(),
            'attribute' => 'name',
            'name' => 'invoice_type_id',
            'allows_null' => true,
            'label' => 'Tipo de documento',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ]
        ]);

        CRUD::addField([
            'name' => 'business_activity_id',
            'label' => 'Giro',
            'type' => 'relationship',
            'placeholder' => 'Seleccionar giro',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ]
        ]);

        CRUD::addField([
            'label' => 'Identificador de documento',
            'name' => 'dte_code',
            'type' => 'text',
            'prefix' => '#',
            'attributes' => [
                'disabled' => 'disabled',
                'readonly' => 'readonly',
            ],
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'type' => 'text',
            'store_in' => 'json_value',
            'name' => 'quotation_id',
            'fake' => true,
            'wrapper' => [
                'style' => 'display:none',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Productos o servicios',
            'name' => 'items_data',
            'type' => 'quotation.repeatable',
            'new_item_label' => 'Agregar producto / servicio',
            'fields' => [
                [
                    'label' => 'Producto / Servicio',
                    'name' => 'product_id',
                    'type' => 'quotation.select2_custom',
                    'model' => 'App\Models\Product',
                    'placeholder' => 'Selecciona un producto',
                    'attribute' => 'name',
                    'data_source' => url('admin/api/products/get-by-current-company'),
                    'minimum_input_length' => 0,
                    'include_all_form_fields'  => true,
                    'dependencies'  => ['seller_id'],
                    'wrapper' => [
                        'class' => 'form-group col-md-3 product-select',
                    ],
                    'attributes' => [
                        'class' => 'form-control product-id-field'
                    ]
                ],
                [
                    'label' => 'Producto / Servicio',
                    'name' => 'name',
                    'type' => 'text',
                    'wrapper' => [
                        'class' => 'form-group col-md-3 custom-product-name',
                        'style' => 'display:none',
                    ],
                    'attributes' => [
                        'placeholder' => 'Nombre del producto o servicio',
                        'class' => 'form-control product-name-field'
                    ],
                ],
                [
                    'label' => 'Precio',
                    'name' => 'price',
                    'type' => 'text',
                    'attributes' => [
                        'class' => 'form-control price',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-2',
                    ],
                ],
                [
                    'label' => 'Cantidad',
                    'name' => 'qty',
                    'type' => 'number',
                    'attributes' => [
                        'class'=> 'form-control qty',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-1',
                    ],
                ],
                [
                    'label' => 'Descuento',
                    'name' => 'discount',
                    'type' => 'quotation.discount',
                    'default' => 0,
                    'suffix' => '<select class="form-control discount_type" name="discount_type"><option value="amount">$</option><option value="percentage">%</option></select>',
                    'wrapper' => [
                        'class' => 'form-group col-md-2',
                    ],
                ],
                [
                    'label' => 'Impuesto',
                    'name' => 'additional_tax_id',
                    'type' => 'select2_from_array',
                    'atributte' => 'name',
                    'options' => array_merge([0 => 'No aplica'] , Tax::all()->map( function($item) {
                        $item->name = $item->amount . '% - ' . $item->name;
                        return $item;
                    })->pluck('name', 'id')->toArray()),
                    'attributes' => [
                        'class' => 'form-control tax_id_field',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-2',
                    ],
                ],
                [
                    'label' => 'Total',
                    'name' => 'total',
                    'type' => 'text',
                    'default' => 0,
                    'attributes' => [
                        'class' => 'form-control subtotal',
                        'readonly' => true,
                    ],
                    'wrapper' => [
                        'class' => 'col-md-2',
                    ],
                ],
                [
                    'label' => 'Descripción',
                    'name' => 'description',
                    'type' => 'textarea',
                    'wrapper' => [
                        'class' => 'col-md-12 custom-description',
                        'style' => 'display:none',
                    ],
                ],
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
                [
                    'label' => 'Editar descripción',
                    'name' => 'edit_description',
                    'type' => 'checkbox',
                    'attributes' => [
                        'class' => 'checkbox-edit-description',
                    ],
                    'wrapper' => [
                        'class' => 'form-group col-md-2',
                    ],
                ],

                // Hidden inputs
                [
                    'label' => 'tax_amount',
                    'name' => 'additional_tax_amount',
                    'type' => 'hidden',
                    'attributes' => [
                        'class' => 'tax_amount_item'
                    ],
                ],
                [
                    'label' => 'tax_percent',
                    'name' => 'tax_percent',
                    'type' => 'hidden',
                    'attributes' => [
                        'class' => 'tax_percent_item'
                    ],
                ],
                [
                    'label' => 'tax_total',
                    'name' => 'additional_tax_total',
                    'type' => 'hidden',
                    'attributes' => [
                        'class' => 'tax_total_item'
                    ],
                ],
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'check_group_start',
            'type' => 'group_start',
            'label' => '',
            'wrapperAttributes' => [
                'class' => 'col-md-6'
            ],
            'tab' => 'General',
        ]);

        /*CRUD::addField([
            'name' => 'tax_type',
            'label' => 'Impuesto',
            'type' => 'select2_from_array',
            'options' => ['A' => 'Afecta', 'E' => 'Exenta', 'H' => 'Honorarios'],
            'allows_null' => false,
            'default' => 'A',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
            'tab' => 'General',
        ]);*/
        
        CRUD::addField([
            'name' => 'way_to_payment',
            'label' => 'Forma de pago',
            'type' => 'select2_from_array',
            'options' => ['1' => 'Contado', '2' => 'Crédito' ],
            'allows_null' => false,
            'default' => '1',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'payment_method',
            'label' => 'Medio de pago',
            'type' => 'select2_from_array',
            'options' => [
                'EF' => 'Efectivo', 
                'PE' => 'Pago a Cta. Cte.',
                'TC' => 'Tarjeta de crédito',
                'CF' => 'Cheque a fecha',
                'OT' => 'Otro'
            ],
            'allows_null' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
            'tab' => 'General',
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
            'tab' => 'General',
        ]);
        
        CRUD::addField([
            'label' => 'Banco',
            'name' => 'bank_id',
            'type' => 'select2',
            'placeholder' => 'Selecciona un banco',
            'model' => 'App\Models\Bank',
            'attribute' => 'name',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'bank_number_account',
            'label' => 'Número de cuenta',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        /*CRUD::addField([
            'name' => 'include_payment_data',
            'label' => 'Incluir datos de pago',
            'type' => 'checkbox',
            'default' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'General',
        ]);*/

        CRUD::addField([
            'name' => 'notes',
            'label' => 'Observaciones / Términos del pago',
            'type' => 'textarea',
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
            'tab' => 'General',
        ]);


        CRUD::addField([
            'name' => 'check_group_end',
            'type' => 'group_end',
            'tab' => 'General',
        ]);

        CRUD::addField([
            'type' => 'invoice.totals_card',
            'name' => 'totals_card',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'currency_id',
            'label' => 'currency',
            'type' => 'text',
            'default' => 63,
            'wrapper' => [
                'style' => 'display:none',
            ],
            'tab' => 'General',
        ]);

        $model = $this->crud->getCurrentEntry();
        if (isset($model->invoice_type) && $model->invoice_type->code == 61) {
            $this->creditNoteFields();
            CRUD::removeSaveActions(['save_and_back','save_and_new']);
        }

        $this->crud->addSaveAction([
            'name' => 'save_and_manage',
            'redirect' => function($crud, $request, $itemId) {
                return $crud->route . '/'. $itemId . '/to-manage';
            }, // what's the redirect URL, where the user will be taken after saving?

            // OPTIONAL:
            'button_text' => 'Guardar y gestionar', // override text appearing on the button
            // You can also provide translatable texts, for example:
            // 'button_text' => trans('backpack::crud.save_action_one'),
            'visible' => function($crud) {
                return true;
            }, // customize when this save action is visible for the current operation
            'referrer_url' => function($crud, $request, $itemId) {
                return $crud->route;
            }, // override http_referrer_url
            'order' => 1, // change the order save actions are in
        ]);
        /*
        CRUD::addField([
            'name' => 'preface',
            'type' => 'wysiwyg',
            'label' => 'Descripción',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Adicional',
        ]);*/
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

        if ($this->crud->getCurrentEntry()->invoice_status == Invoice::STATUS_TEMPORAL) {
            \Alert::add('warning', 'El documento temporal se eliminará si guarda cambios');
        }

    }

    protected function creditNoteFields() : void
    {
        CRUD::addField([
            'name' => 'reference_date',
            'label' => 'Fecha del documento original',
            'type' => 'date',
            'tab' => 'Referencia',
            'fake' => true,
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'attributes' => [
                'readonly' => true,
            ],
            'store_in' => 'json_value',
        ]);

        CRUD::addField([
            'name' => 'reference_folio',
            'tab' => 'Referencia',
            'fake' => true,
            'wrapper' => [
                'class' => 'form-group col-md-4',
            ],
            'attributes' => [
                'readonly' => true,
            ],
            'store_in' => 'json_value',
        ]);

        CRUD::addField([
            'type' => 'select2_from_array',
            'options' => InvoiceType::all()->pluck('name','id'),
            'attribute' => 'name',
            'name' => 'reference_type_document',
            'label' => 'Tipo de documento',
            'tab' => 'Referencia',
            'fake' => true,
            'store_in' => 'json_value',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
        ]);

        CRUD::addField([
            'type' => 'select2_from_array',
            'options' => [
                1 => 'Anula documento de referencia',
                2 => 'Corrige texto documento de referencia',
                3 => 'Corrige montos',
            ],
            'tab' => 'Referencia',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'fake' => true,
            'store_in' => 'json_value',
            'name' => 'reference_code',
        ]);

        CRUD::addField([
            'name' => 'reference_reason',
            'type' => 'textarea',
            'label' => 'Descripción',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Referencia',
            'fake' => true,
            'store_in' => 'json_value'
        ]);

    }

}
