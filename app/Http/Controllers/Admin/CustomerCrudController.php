<?php

namespace App\Http\Controllers\Admin;

use App\Cruds\BaseCrudFields;
use App\Http\Requests\CustomerRequest;
use App\Models\Bank;
use App\Models\BankAccountType;
use App\Models\BusinessActivity;
use App\Models\Commune;
use App\Models\ContactType;
use App\Models\CustomerSegment;
use App\Traits\HasCustomAttributes;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCrudController extends CrudController
{
    use HasCustomAttributes;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Customer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customer');
        CRUD::setEntityNameStrings('cliente', 'clientes');

        $this->crud->denyAccess('show');
        $this->crud->enableExportButtons();
        $this->getExtras();
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

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        CRUD::addColumn([
            'name' => 'uid',
            'type' => 'text',
            'label' => 'RUT',
        ]);

        CRUD::addColumn([
            'name' => 'full_name',
            'type' => 'text',
            'label' => 'Nombre / Razón social',
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'type' => 'text',
            'label' => 'Email',
        ]);

        CRUD::addColumn([
            'name' => 'is_company_description',
            'type' => 'text',
            'label' => 'Tipo',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Jurídica') {
                        return 'badge badge-warning';
                    }
                    return 'badge badge-default';
                },
            ],
        ]);

        CRUD::addColumn([
            'name' => 'customer_segment',
            'type' => 'relationship',
            'label' => 'Segmento',
            'attribute' => 'name',
        ]);

        CRUD::addColumn([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Teléfono',
        ]);

        CRUD::addColumn([
            'name' => 'cellphone',
            'type' => 'text',
            'label' => 'Teléfono móvil',
        ]);

        CRUD::addColumn([
            'name' => 'addresses_data_first_street',
            'type' => 'text',
            'label' => 'Calle',

        ]);
        CRUD::addColumn([
            'name' => 'addresses_data_first_number',
            'type' => 'text',
            'label' => 'Nro.',

        ]);
        CRUD::addColumn([
            'name' => 'addresses_data_first_sub_number',
            'type' => 'text',
            'label' => 'Casa/Dpto/Oficina',

        ]);
        CRUD::addColumn([
            'name' => 'addresses_data_first_commune',
            'type' => 'text',
            'label' => 'Comuna',

        ]);

        CRUD::addColumn([
            'name' => 'status_description',
            'type' => 'text',
            'label' => 'Estado',
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
        CRUD::setValidation(CustomerRequest::class);

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        CRUD::addField([
            'name' => 'is_company',
            'label' => 'Es empresa',
            'type' => 'checkbox',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'form-group col-auto',
            ],
        ]);

        CRUD::addField([
            'name' => 'is_foreign',
            'label' => 'Es extranjero',
            'type' => 'checkbox',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'form-group col-9 is_foreing_field',
            ],
            'attributes' => [
                'class' => 'is_foreign_checkbox',
            ],
        ]);

        CRUD::addField([
            'name' => 'uid',
            'type' => 'text',
            'label' => 'RUT',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
            'attributes' => [
                'id' => 'rut_field',
            ],
        ]);

        CRUD::addField([
            'name' => 'first_name',
            'type' => 'text',
            'label' => 'Nombre',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ]);

        CRUD::addField([
            'name' => 'last_name',
            'type' => 'text',
            'label' => 'Apellido',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ]);

        CRUD::addField([
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ]);

        CRUD::addField([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Teléfono',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ]);

        CRUD::addField([
            'name' => 'cellphone',
            'type' => 'text',
            'label' => 'Teléfono móvil',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
        ]);

        CRUD::addField([
            'name' => 'customer_segment_id',
            'type' => 'select2_from_array',
            'label' => 'Segmento',
            'options' => CustomerSegment::pluck('name', 'id')->toArray(),
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
        ]);

        // CRUD::addField([
        //     'name' => 'password',
        //     'type' => 'password',
        //     'label' => 'Contraseña',
        //     'tab' => 'General',
        //     'wrapper' => [
        //         'class' => 'form-group col-6',
        //     ],
        // ]);

        // CRUD::addField([
        //     'name' => 'password_confirmation',
        //     'type' => 'password',
        //     'label' => 'Repetir contraseña',
        //     'tab' => 'General',
        //     'wrapper' => [
        //         'class' => 'form-group col-6',
        //     ],
        // ]);

        CRUD::addField([
            'name' => 'notes',
            'type' => 'textarea',
            'label' => 'Notas',
            'tab' => 'General',
            'wrapper' => [
                'class' => 'form-group col-12',
            ],
        ]);

        CRUD::addField([
            'name' => 'status',
            'type' => 'checkbox',
            'label' => 'Activo',
            'tab' => 'General',
            'default' => 1,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
        ]);

        CRUD::addField([
            'name' => 'addresses_data',
            'type' => 'repeatable',
            'label' => 'Direcciones',
            'default' => '{}',
            'fields' => [
                [
                    'name' => 'customer_address_id',
                    'type' => 'hidden',
                ],
                [
                    'name' => 'street',
                    'type' => 'text',
                    'label' => 'Calle',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'number',
                    'type' => 'text',
                    'label' => 'Número',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name' => 'subnumber',
                    'type' => 'text',
                    'label' => 'Casa/Dpto/Oficina',
                    'wrapper' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name' => 'commune_id',
                    'type' => 'select2_from_array',
                    'label' => 'Comuna',
                    'options' => Commune::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'uid',
                    'type' => 'text',
                    'label' => 'RUT',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'first_name',
                    'type' => 'text',
                    'label' => 'Nombre',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'last_name',
                    'type' => 'text',
                    'label' => 'Apellido',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Email',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'phone',
                    'type' => 'text',
                    'label' => 'Teléfono',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'cellphone',
                    'type' => 'text',
                    'label' => 'Teléfono móvil',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'extra',
                    'type' => 'textarea',
                    'label' => 'Detalles',
                    'wrapper' => ['class' => 'form-group col-md-12'],
                ],
            ],
            'new_item_label' => 'Agregar dirección',
            'tab' => 'Direcciones',
        ]);

        CRUD::addField([
            'name' => 'activities_data',
            'type' => 'repeatable',
            'label' => 'Giros',
            'default' => '{}',
            'fields' => [
                [
                    'name' => 'business_activity_id',
                    'type' => 'select2_from_array',
                    'label' => 'Giro',
                    'options' => BusinessActivity::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-12',
                    ],
                ],
            ],
            'new_item_label' => 'Agregar giro',
            'tab' => 'Actividades comerciales',
        ]);

        Crud::addField([
            'name' => 'banks_data',
            'label' => 'Cuentas',
            'type' => 'repeatable',
            'default' => '{}',
            'fields' => [
                [
                    'name' => 'account_type_id',
                    'type' => 'select2_from_array',
                    'label' => 'Tipo de cuenta',
                    'options' => BankAccountType::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'bank_id',
                    'type' => 'select2_from_array',
                    'label' => 'Banco',
                    'options' => Bank::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'account_number',
                    'type' => 'text',
                    'label' => 'Número de Cuenta',
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'rut',
                    'type' => 'text',
                    'label' => 'RUT',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'first_name',
                    'type' => 'text',
                    'label' => 'Nombre',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'last_name',
                    'type' => 'text',
                    'label' => 'Apellido',
                    'wrapper' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
                [
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Email',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name' => 'phone',
                    'type' => 'text',
                    'label' => 'Teléfono',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
            ],
            'new_item_label' => 'Agregar cuenta',
            'tab' => 'Datos bancarios',
        ]);

        Crud::addField([
            'name' => 'contacts_data',
            'label' => 'Contactos',
            'type' => 'repeatable',
            'default' => '{}',
            'fields' => [
                [
                    'name' => 'contact_type_id',
                    'type' => 'select2_from_array',
                    'label' => 'Plataforma',
                    'options' => ContactType::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name' => 'url',
                    'type' => 'text',
                    'label' => 'URL',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
            ],
            'new_item_label' => 'Agregar contacto',
            'tab' => 'Contactos',
        ]);

        CRUD::addField([
            'name' => 'rut_formatter',
            'type' => 'rut_formatter',
            'rut_fields' => ['uid', 'rut'],
            'tab' => 'General',
        ]);

        CRUD::addField([
            'name' => 'custom_script',
            'type' => 'customer.custom_script',
            'tab' => 'General',
        ]);

        // @twgroup: agrego campos extras a la vista
        foreach ($this->extraFields as $field) {
            $this->crud->addField($field);
        }
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

        CRUD::field('uid')->attributes([
            'readonly' => 'readonly',
            'id' => 'rut_field',
        ]);

        CRUD::field('email')->attributes([
            'readonly' => 'readonly',
        ]);
    }

    /**
     * Add filters in list view
     *
     * @return void
     */
    private function customFilters()
    {

        CRUD::addFilter([
            'type' => 'select2',
            'name' => 'customer_segment_id',
            'label' => 'Segmento',
        ], function () {
            return CustomerSegment::pluck('name', 'id')->toArray();

        }, function ($value) {
            $this->crud->addClause('where', 'customer_segment_id', '=', $value);
        });

        CRUD::addFilter([
            'type' => 'select2',
            'name' => 'addresses_data_first_commune',
            'label' => 'Comuna',
        ], function () {
            return Commune::orderBy('name')->pluck('name', 'id')->toArray();

        }, function ($value) {
            $this->crud->addClause('whereHas', 'addresses', function ($query) use ($value) {
                $query->where('commune_id', $value);
            });
        });

        CRUD::addFilter([
            'type' => 'select2',
            'name' => 'is_company',
            'label' => 'Tipo',
        ], function () {
            return [
                1 => 'Jurídica',
                0 => 'Natural',
            ];

        }, function ($value) {
            $this->crud->addClause('where', 'is_company', '=', $value);
        });
        CRUD::addFilter([
            'type' => 'select2',
            'name' => 'status',
            'label' => 'Estado',
        ], function () {
            return [
                1 => 'Activa',
                0 => 'Inactiva',
            ];

        }, function ($value) {
            $this->crud->addClause('where', 'status', '=', $value);
        });

    }
}
