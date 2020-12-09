<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\CustomerAttendance;
use App\Http\Requests\CustomerAttendanceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerAttendanceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerAttendanceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerAttendance::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customerattendance');
        CRUD::setEntityNameStrings('asistencia', 'asistencias');

        $this->crud->orderBy('attendance_time', 'DESC');

        $this->crud->denyAccess('create');
        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('update');

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
        CRUD::addColumn([
            'name' => 'customer',
            'label' => 'RUT',
            'attribute' => 'uid',
            'type' => 'relationship',
        ]);
        
        CRUD::addColumn([
            'name' => 'customer',
            'label' => 'Cliente',
            'key' => 'customer_name',
            'attribute' => 'full_name',
            'type' => 'relationship',
        ]);

        CRUD::addColumn([
            'name' => 'date_only',
            'label' => 'Fecha',
            'type' => 'date',
            'format' => 'L',
        ]);

        CRUD::addColumn([
            'name' => 'attendance_time',
            'label' => 'Hora registrada',
            'type' => 'datetime',
            'format' => 'h:m A',
        ]);

        CRUD::addColumn([
            'name' => 'entry_type_accesor',
            'label' => 'Tipo de entrada',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Check In') {
                        return 'badge badge-success';
                    } elseif ($column['text'] == 'Check Out') {
                        return 'badge badge-warning';
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
        CRUD::setValidation(CustomerAttendanceRequest::class);

        

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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);


        CRUD::addColumn([
            'name' => 'customer',
            'label' => 'RUT',
            'attribute' => 'uid',
            'type' => 'relationship',
        ]);
        
        CRUD::addColumn([
            'name' => 'customer',
            'label' => 'Cliente',
            'key' => 'customer_name',
            'attribute' => 'full_name',
            'type' => 'relationship',
        ]);

        
        CRUD::addColumn([
            'name' => 'entry_type_accesor',
            'label' => 'Tipo de entrada',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Check In') {
                        return 'badge badge-success';
                    } elseif ($column['text'] == 'Check Out') {
                        return 'badge badge-warning';
                    }

                    return 'badge badge-default';
                },
            ],
        ]);

        CRUD::addColumn([
            'name' => 'date_only',
            'label' => 'Fecha',
            'type' => 'date',
            'format' => 'L',
        ]);

        CRUD::addColumn([
            'name' => 'attendance_time',
            'label' => 'Hora registrada',
            'type' => 'datetime',
            'format' => 'h:m A',
        ]);

        CRUD::addColumn([
            'name' => 'entry_number',
            'label' => 'Entrada del dia #',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'entrance_code',
            'label' => 'Codigo de entrada',
            'type' => 'text',
        ]);

        
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
            'name'  => 'from_to',
            'label' => 'Fecha'
          ],
          false,
          function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'attendance_time', '>=', $dates->from);
            $this->crud->addClause('where', 'attendance_time', '<=', $dates->to . ' 23:59:59');
        });

        CRUD::addFilter([
            'name'  => 'entry_type',
            'type'  => 'dropdown',
            'label' => 'Tipo de entrada'
        ], [
            CustomerAttendance::CHECK_IN => 'Check In',
            CustomerAttendance::CHECK_OUT => 'Check Out',
        ], function($value) {
            $this->crud->addClause('where', 'entry_type', $value);
        });

        

    }
}
