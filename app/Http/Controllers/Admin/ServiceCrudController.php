<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\TimeBlock;
use App\Cruds\BaseCrudFields;
use App\Http\Requests\ServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Service::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/service');
        CRUD::setEntityNameStrings('servicio', 'servicios');

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
            'name' => 'name',
            'label' => 'Nombre',
        ]);

        CRUD::addColumn([
            'name' => 'code',
            'label' => 'Codigo',
        ]);

        CRUD::addColumn([
            'name' => 'status_description',
            'label' => 'Estado',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Activo') {
                        return 'badge badge-success';
                    }
                    return 'badge badge-default';
                },
            ],
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
        CRUD::setValidation(ServiceRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'code',
            'label' => 'Codigo',
            'type' => 'text',
            'default' => generateUniqueModelCodeAttribute(Service::class, auth()->user()->companies()->first()->id)
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Descripción',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'timeblocks',
            'label' => 'Bloques horarios',
            'type' => 'relationship',
            'entity' => 'timeblocks',
            'model' => 'App\Models\TimeBlock',
            'attribute' => 'name_with_time',
            'placeholder' => 'Seleccionar bloque horario',
            //'ajax' => true,
            'inline_create' => [ 'entity' => 'timeblock' ]
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Activo',
            'type' => 'checkbox',
            'default' => '1',
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

    protected function fetchTimeblocks()
    {
        return $this->fetch(\App\Models\TimeBlock::class);
    }

    private function customFilters()
    {
        CRUD::addFilter([
            'type'  => 'select2',
            'name'  => 'name',
            'label' => 'Nombre',
        ], function() {
            return Service::all()->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('where', 'id', $value);
        });

        CRUD::addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
        ], [
            0 => 'Inactivo',
            1 => 'Activo',
        ], function($value) {
            $this->crud->addClause('where', 'status', $value);
        });
    }
}
