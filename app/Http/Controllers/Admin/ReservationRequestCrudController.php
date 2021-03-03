<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Customer;
use App\Cruds\BaseCrudFields;
use App\Http\Requests\ReservationRequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ReservationRequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReservationRequestCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ReservationRequest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/reservationrequest');
        CRUD::setEntityNameStrings('solicitud de reserva', 'solicitudes de reserva');

        $this->crud->enableExportButtons();
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
        $this->customFilters();

        CRUD::addColumn([
            'name' => 'id',
            'label' => '#',
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'Fecha de recepción',
            'type' => 'date',
            'format' => 'L'
        ]);

        CRUD::addColumn([
            'name' => 'customer',
            'label' => 'Cliente',
            'key' => 'customer_name',
            'attribute' => 'full_name',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('customer', function ($q) use ($searchTerm) {
                    return $q->whereRaw('CONCAT(first_name, " ", last_name) LIKE "%' . $searchTerm . '%" ');
                });
            }
        ]);

        CRUD::addColumn([
            'name' => 'service',
            'label' => 'Servicio',
        ]);

        CRUD::addColumn([
            'name' => 'date',
            'label' => 'Fecha de reserva',
            'type' => 'date',
            'format' => 'L',
        ]);

        CRUD::addColumn([
            'name' => 'timeblock',
            'label' => 'Bloque horario',
            'type' => 'relationship',
            'attribute' => 'name_with_time',
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
        CRUD::setValidation(ReservationRequestRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        CRUD::addField([
            'name' => 'customer_id',
            'label' => 'Cliente',
            'type' => 'relationship',
            'attribute' => 'full_name'
        ]);

        CRUD::addField([
            'name' => 'service_id',
            'label' => 'Servicio',
            'type' => 'relationship',
        ]);

        CRUD::addField([
            'label'       => "Bloque horario",
            'type'        => "select2_from_ajax",
            'name'        => 'time_block_id',
            'placeholder' => 'Selecciona el bloque horario',
            'entity'      => 'timeblock',
            'attribute'   => "name_with_time",
            'data_source' => url("admin/api/timeblocks/get-by-service"),
            'minimum_input_length' => 0,
            'include_all_form_fields'  => true,
            'dependencies'  => ['service_id'],
        ]);

        CRUD::addField([
            'name' => 'date',
            'label' => 'Fecha',
            'type' => 'date',
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

    private function customFilters()
    {
        CRUD::addFilter([
            'type'  => 'select2',
            'name'  => 'customer_rut',
            'label' => 'RUT',
        ], function() {
            return Customer::all()->pluck('uid', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'customer_id', $value);
        });


        CRUD::addFilter([
            'name'  => 'customer_name',
            'type'  => 'select2',
            'label' => 'Cliente'
        ], function() {
            return Customer::all()->pluck('full_name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'customer_id', $value);
        });

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to_recevied',
            'label' => 'Fecha de recepción'
          ],
          false,
          function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'created_at', '>=', $dates->from);
            $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to',
            'label' => 'Fecha de reserva'
          ],
          false,
          function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'date', '>=', $dates->from);
            $this->crud->addClause('where', 'date', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addFilter([
            'name'  => 'service',
            'type'  => 'select2',
            'label' => 'Servicio'
        ], function() {
            return Service::all()->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'service_id', $value);
        });
    }
}
