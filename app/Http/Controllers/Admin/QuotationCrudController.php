<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tax;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\InvoiceType;
use Illuminate\Http\Request;
use App\Cruds\BaseCrudFields;
use App\Models\CustomerAddress;
use App\Models\{Invoice, InvoiceItem};
use App\Http\Requests\QuotationRequest;
use App\Http\Requests\QuotationCreateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class QuotationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuotationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Quotation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/quotation');
        CRUD::setEntityNameStrings('cotización', 'cotizaciones');

        $this->crud->denyAccess('show');
        $this->crud->allowAccess('export_pdf');
        $this->crud->allowAccess('generate_dte');
        $this->crud->allowAccess('duplicate');

        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'export', 'quotation.export', 'begining');
        $this->crud->addButtonFromView('line', 'extra_options', 'quotation.extra_options', 'begining');
        //$this->crud->addButtonFromView('line', 'duplicate', 'quotation.duplicate', 'begining');
        //$this->crud->addButtonFromView('line', 'Crear documento electrónico temporal', 'quotation.to_invoice', 'beginning');
        $this->crud->removeButton('delete');

        CRUD::addColumn([
            'label' => '#',
            'name' => 'code',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'label' => 'Fecha',
            'name' => 'quotation_date',
            'type' => 'date',
            'format' => 'L'
        ]);

        CRUD::addColumn([
            'label' => 'Cliente',
            'name' => 'customerWithUid',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'label' => 'Título',
            'name' => 'title',
        ]);

        CRUD::addColumn([
            'name' => 'quotation_status_text',
            'type' => 'text',
            'label' => 'Estado cotización',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Activa' || 
                        $column['text'] == 'Aceptada' || 
                        $column['text'] == 'Emitida' ||
                        $column['text'] == 'Completada' ||
                        $column['text'] == 'Facturada') {
                        return 'badge badge-success';
                    }
                   
                    if ($column['text'] === 'Rechazada' ||
                        $column['text'] === 'Cancelada') {
                        return 'badge badge-danger';
                    }
                    
                    if ($column['text'] == 'Vista') {
                        return 'badge badge-info';
                    }

                    return 'badge badge-default';
                },
            ],
        ]);

        CRUD::addColumn([
            'label' => 'Fecha expiración',
            'name' => 'expiry_date',
            'type' => 'date',
            'format' => 'L'
        ]);

        CRUD::addColumn([
            'label' => 'Es suscripción',
            'name' => 'is_recurring_accesor',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Si') {
                        return 'badge badge-info';
                    } else {
                        return 'badge badge-secondary';
                    }

                },
            ],
        ]);

        CRUD::addColumn([
            'label' => 'Total',
            'name' => 'total',
            'type' => 'number',
            'dec_point' => ',',
            'thousands_sep' => '.',
            'decimals' => 0,
            'prefix' => '$' // @todo change symbol depending on the currency
        ]);

        $this->customFilters();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(QuotationCreateRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        CRUD::addField([
            'type' => 'custom_js_data',
            'name' => 'custom_data_for_invoice_type',
            'data' => InvoiceType::all()->toArray(),
            'variable_name' => 'invoiceTypeArray',
            'tab' => 'General',
        ]);
        
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

        // CRUD::addField([
        //     'label' => 'Dirección',
        //     'name' => 'address_id',
        //     'type' => 'relationship',
        //     'entity' => 'customer',
        //     'placeholder' => 'Selecciona un cliente',
        //     'wrapper' => [
        //         'class' => 'form-group col-md-6',
        //     ],
        //     'tab' => 'General',
        // ]);

        CRUD::addField([
            'label' => 'Fecha cotización',
            'name' => 'quotation_date',
            'type' => 'date',
            'default' => date("Y-m-d"),
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Fecha expiración',
            'name' => 'expiry_date',
            'type' => 'date',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

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

        CRUD::addField([
            'type' => 'select2_from_array',
            'options' => InvoiceType::active()->pluck('name','id')->sort(),
            'attribute' => 'invoice_type_id',
            'name' => 'invoice_type_id',
            'label' => 'Tipo de documento',
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Número cotización',
            'name' => 'code_accesor',
            'type' => 'text',
            'prefix' => '#',
            'default' => Quotation::withTrashed()->orderBy('created_at')->get()->last() 
                ? intval(Quotation::withTrashed()->orderBy('created_at')->get()->last()->code) + 1 
                : Quotation::datePrefix() . '1',
            'attributes' => [
                'readonly' => true,
            ],
            'wrapper' => [
                'class' => 'form-group col-md-3',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Número referencia',
            'name' => 'reference',
            'type' => 'text',
            'prefix' => '#',
            'wrapper' => [
                'class' => 'form-group col-md-3',
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
                    //'dependencies'  => ['seller_id'],
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

        CRUD::addField([
            'name' => 'check_group_start_row',
            'type' => 'group_start',
            'label' => '',
            'wrapperAttributes' => [
                'class' => 'row'
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'tax_type',
            'label' => 'Impuesto',
            'type' => 'select2_from_array',
            'options' => ['A' => 'Afecta', 'E' => 'Exenta', 'H' => 'Honorarios'],
            'allows_null' => false,
            'default' => 'A',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
                'style' => 'display:none',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'include_payment_data',
            'label' => 'Incluir datos de pago',
            'type' => 'checkbox',
            'default' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'notes',
            'label' => 'Notas',
            'type' => 'textarea',
            'wrapper' => [
                'class' => 'form-group col-md-12',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'quotation_status',
            'label' => 'Estado cotización',
            'options' => [
                Quotation::STATUS_DRAFT => 'Borrador',
                Quotation::STATUS_PENDING_PAYMENT => 'Pago Pendiente',
                Quotation::STATUS_SENT => 'Enviada',
                //Quotation::STATUS_VIEWED => 'Vista',
                //Quotation::STATUS_EXPIRED => 'Expirada',
                Quotation::STATUS_ACCEPTED => 'Aceptada',
                Quotation::STATUS_COMPLETED => 'Completada',
                Quotation::STATUS_REJECTED => 'Rechazada',
                Quotation::STATUS_ISSUED => 'Emitida',
                Quotation::STATUS_INVOICED => 'Facturada',
                Quotation::STATUS_CANCELED => 'Cancelada',
            ],
            'attributes' => [
                //'readonly' => true,
                //'disabled' => true,
            ],
            'type' => 'select2_from_array',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'is_recurring',
            'label' => 'Es una suscripción (Cotizacion recurrente)',
            'type' => 'checkbox',
            'tab' => 'General',
            'attributes' => [
                'class' => 'is_recurring_check'
            ]
        ]);

        CRUD::addField([
            'name' => 'start_date',
            'label' => 'Fecha de inicio',
            'type' => 'date',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'col-md-4 form-group recurring_group',
                'id' => 'start_date_field'
            ],
            'fake' => true,
            'store_in' => 'recurring_data'
        ]);
        
        CRUD::addField([
            'name' => 'repeat_number',
            'label' => 'Repetir cada',
            'type' => 'number',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'col-md-3 form-group recurring_group',
                'id' => 'repeat_number_field',
            ],
            'fake' => true,
            'store_in' => 'recurring_data'
        ]);
        
        CRUD::addField([
            'name' => 'repeat_every',
            'label' => '',
            'type' => 'select2_from_array',
            'options' => [
                'days' => 'Dias',
                'weeks' => 'Semanas',
                'months' => 'Meses',
                'years' => 'Años',
            ],
            'tab' => 'General',
            'wrapper' => [
                'class' => 'col-md-5 form-group mt-2 recurring_group',
                'id' => 'repeat_every_field',
            ],
            'fake' => true,
            'store_in' => 'recurring_data',
        ]);

        CRUD::addField([
            'name' => 'end_type',
            'label' => 'Termina',
            'type' => 'select2_from_array',
            'options' => [
                'never' => 'Nunca',
                'date' => 'Seleccionar fecha',
                'repetition' => 'Despues de __ Repeticiones',
            ],
            'wrapper' => [
                'class' => 'col-md-7 form-group recurring_group',
            ],
            'attributes' => [
                'id' => 'end_type_field',
            ],
            'tab' => 'General',
            'fake' => true,
            'store_in' => 'recurring_data',
        ]);

        CRUD::addField([
            'name' => 'end_date',
            'label' => '',
            'type' => 'date',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'col-md-5 form-group mt-2 recurring_group',
                'id' => 'end_date_field',
            ],
            'fake' => true,
            'store_in' => 'recurring_data',
        ]);

        CRUD::addField([
            'name' => 'end_after_reps',
            'label' => '',
            'type' => 'number',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'col-md-5 form-group mt-2 recurring_group',
                'id' => 'end_after_reps_field',
            ],
            'attributes' => [
                'placeholder' => 'Numero de repeticiones',
            ],
            'fake' => true,
            'store_in' => 'recurring_data',
        ]);

        CRUD::addField([
            'name' => 'check_group_end_row',
            'type' => 'group_end',
            'tab' => 'General',
        ]);
        
        CRUD::addField([
            'name' => 'check_group_end',
            'type' => 'group_end',
            'tab' => 'General',
        ]);

        CRUD::addField([
            'type' => 'quotation.totals_card',
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

        CRUD::addField([
            'name' => 'preface',
            'type' => 'wysiwyg',
            'label' => 'Descripción',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Adicional',
        ]);

        CRUD::addField([
            'type' => 'quotation.recurring_group_scripts',
            'name' => 'recurring_group_scripts',
            'tab' => 'General',
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
        $quotation = $this->crud->getModel()->find($this->crud->getCurrentEntryId());

        if ($quotation->parent) {
            $this->crud->modifyField('quotation_status', [
                'attributes' => [
                    'disabled' => true,
                ],
            ]);
        }

        if ($quotation->quotation_status == Quotation::STATUS_ACCEPTED) {
            $this->crud->modifyField('is_recurring', [
                'attributes' => [
                    'class' => 'is_recurring_check',
                    'disabled' => true,
                ]
            ]);

            $this->crud->modifyField('start_date', [
                'attributes' => [
                    'readonly' => true,
                ],
            ]);
        }

        if ($quotation->quotation_status == Quotation::STATUS_COMPLETED) {
            $this->crud->modifyField('is_recurring', [
                'attributes' => [
                    'class' => 'is_recurring_check',
                    'disabled' => true,
                ]
            ]);

            $this->crud->modifyField('start_date', [
                'attributes' => [
                    'readonly' => true,
                ],
            ]);

            $this->crud->modifyField('quotation_status', [
                'attributes' => [
                    'disabled' => true,
                ],
            ]);
        }
    }

    public function addresses(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if (empty($form['customer_id'])) {
            return collect()->paginate(100);
        }

        $customer = Customer::where('id', $form['customer_id'])->first();

        return $customer->addresses_with_deletes()->paginate(100);
    }

    public function exportPDF($id) 
    {
        $quotation = Quotation::findOrFail($id);

        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('templates.quotations.export_pdf', [
            'quotation' => $quotation,
            'due_date' => is_null($quotation->expiry_date) ? null : new Carbon($quotation->expiry_date),
            'creation_date'=> new Carbon($quotation->quotation_date),
            'title' => $quotation->title,
            'now' => New Carbon(),
        ]);

        $pdf->getDomPDF()->set_option("isPhpEnabled", true);

        return $pdf->stream('cotización ' . $quotation->code . '.pdf');
    }

    public function duplicate($id)
    {
        $quotation = Quotation::findOrFail($id);

        $newQuotation = new Quotation($quotation->toArray());
        $newQuotation->items_data = $quotation->items_data;
        $newQuotation->quotation_status = Quotation::STATUS_DRAFT;

        unset($newQuotation->expiry_date);
        unset($newQuotation->code);
        
        $newQuotation->save();
        \Alert::add('success', 'Cotización duplicada con exito')->flash();
        return redirect('admin/quotation/' . $newQuotation->id . '/edit');
    }

    public function toInvoice(Request $request, Quotation $quotation)
    {
        \DB::beginTransaction();
        try {
            $invoice = new Invoice($quotation->toArray());
            $invoice->items_data = json_encode($invoice->items_data);
            unset($invoice->expiry_date);
            $json_value = $invoice->json_value;
            $json_value['quotation_id'] = $quotation->id;
            $invoice->json_value = $json_value;
            $invoice->save();

            $quotation->quotation_status = Quotation::STATUS_ISSUED;
            $quotation->updateWithoutEvents(); 

            //foreach ($quotation->quotation_items as $item) {
            //    $invoiceItem = new InvoiceItem($item->toArray());
            //    $invoiceItem->invoice_id = $invoice->id;
            //    $invoiceItem->save();
            //}
            
            \DB::commit();
            
            return redirect('admin/invoice/' . $invoice->id . '/edit');
        } catch (Exception $e) {
            // @todo Alert and redirect to crud->route
            \Alert::warning('Hubo un problema al generar el documento electrónico');
            \DB::rollback();
        }
    }

    protected function customFilters()
    {
        CRUD::addFilter([
            'name'  => 'customer_name',
            'type'  => 'select2',
            'label' => 'Cliente'
        ], function() {
            return Customer::all()->pluck('full_name_with_uid', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'customer_id', $value);
        });
        
        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to',
            'label' => 'Fecha'
          ],
          false,
          function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'quotation_date', '>=', $dates->from);
            $this->crud->addClause('where', 'quotation_date', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addFilter([
            'name'  => 'invoice_type',
            'type'  => 'select2',
            'label' => 'Tipo de documento'
        ], function() {
            return InvoiceType::active()->get()->sortBy('name')->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'invoice_type_id', $value);
        });

        CRUD::addFilter([
            'name'  => 'quotation_type',
            'type'  => 'dropdown',
            'label' => 'Tipo de cotización'
          ], [
            1 => 'Solo suscripción (cotizaciones recurrentes)',
          ], function($value) {
            $this->crud->addClause('where', 'is_recurring', $value);
          });

        CRUD::addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
          ], [
            Quotation::STATUS_DRAFT => 'Borrador',
            Quotation::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
            Quotation::STATUS_VIEWED => 'Enviado',
            //Quotation::STATUS_EXPIRED => 'Expirado',
            Quotation::STATUS_ACCEPTED => 'Aceptado',
            Quotation::STATUS_REJECTED => 'Rechazado',
            Quotation::STATUS_ISSUED => 'Emitido',
            Quotation::STATUS_INVOICED => 'Facturado',
          ], function($value) {
            $this->crud->addClause('where', 'quotation_status', $value);
          });
    }
}
