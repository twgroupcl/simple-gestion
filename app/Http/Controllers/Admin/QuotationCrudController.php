<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tax;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\{Invoice, InvoiceItem};
use Illuminate\Http\Request;
use App\Cruds\BaseCrudFields;
use App\Models\CustomerAddress;
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
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Export PDF option
        $this->crud->addButtonFromView('line', 'export', 'quotation.export', 'begining');

        CRUD::addColumn([
            'label' => '#',
            'name' => 'id',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'label' => 'Fecha cotización',
            'name' => 'quotation_date',
            'type' => 'date',
            'format' => 'L'
        ]);

        CRUD::addColumn([
            'label' => 'Título',
            'name' => 'title',
        ]);

        CRUD::addColumn([
            'label' => 'Cliente',
            'name' => 'customer',
            'type' => 'relationship',
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

        CRUD::addColumn([
            'name' => 'quotation_status_text',
            'type' => 'text',
            'label' => 'Estado cotización',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Activa') {
                        return 'badge badge-success';
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
            'label' => 'Cliente',
            'name' => 'customer_id',
            'type' => 'relationship',
            'entity' => 'customer',
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
                'class' => 'form-group col-md-6',
            ],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'label' => 'Número cotización',
            'name' => 'id_accesor',
            'type' => 'text',
            'prefix' => '#',
            'default' => Quotation::all()->last() ? Quotation::all()->last()->id + 1 : 1,
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
            'name' => 'code',
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
                    'data_source' => url('admin/api/products/getBySeller'),
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

        CRUD::addField([
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
                Quotation::STATUS_SENT => 'Enviado',
                Quotation::STATUS_VIEWED => 'Visto',
                Quotation::STATUS_EXPIRED => 'Expirado',
                Quotation::STATUS_ACCEPTED => 'Aceptado',
                Quotation::STATUS_REJECTED => 'Rechazado',
            ],
            'attributes' => [
                'readonly' => true,
                'disabled' => true,
            ],
            'type' => 'select2_from_array',
            'wrapperAttributes' => [
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

    public function addresses(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if (empty($form['customer_id'])) {
            return collect()->paginate(100);
        }

        $customer = Customer::where('id', $form['customer_id'])->first();

        return $customer->addresses()->paginate(100);
    }

    public function exportPDF($id) {

        $quotation = Quotation::findOrFail($id);

         /* return view('templates.quotations.export_pdf', [
            'quotation' => $quotation,
            'due_date' => new Carbon($quotation->expiry_date),
            'creation_date'=> new Carbon($quotation->quotation_date),
            'title' => 'Cotizacion',
            'now' => New Carbon(),
        ]);   */

        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('templates.quotations.export_pdf', [
            'quotation' => $quotation,
            'due_date' => new Carbon($quotation->expiry_date),
            'creation_date'=> new Carbon($quotation->quotation_date),
            'title' => $quotation->title,
            'now' => New Carbon(),
        ]);

        //$pdf->getDomPDF()->set_option('enable_php', true);
        $pdf->getDomPDF()->set_option("isPhpEnabled", true);

        return $pdf->stream('invoice.pdf');
    }

    public function toInvoice(Request $request, Quotation $quotation)
    {
        \DB::beginTransaction();
        try {
            $invoice = new Invoice($quotation->toArray());
            $invoice->items_data = json_encode($invoice->items_data);
            unset($invoice->expiry_date);
            $invoice->save();

            foreach ($quotation->quotation_items as $item) {
                $invoiceItem = new InvoiceItem($item->toArray());
                $invoiceItem->invoice_id = $invoice->id;
                $invoiceItem->save();
            }
            
            \DB::commit();
            
            return redirect('admin/invoice/' . $invoice->id . '/edit');
        } catch (Exception $e) {
            // @todo Alert and redirect to crud->route
            \DB::rollback();
        }

    }
}
