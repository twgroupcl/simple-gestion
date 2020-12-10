<?php

namespace App\Http\Controllers\Admin;

use App\Cruds\BaseCrudFields;
use App\Http\Requests\TimeBlockRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TimeBlockCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TimeBlockCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
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
        CRUD::setModel(\App\Models\TimeBlock::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/timeblock');
        CRUD::setEntityNameStrings('bloque horario', 'bloques horarios');

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
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
        ]);

        CRUD::addColumn([
            'name' => 'start_time',
            'label' => 'Hora de inicio',
        ]);

        CRUD::addColumn([
            'name' => 'end_time',
            'label' => 'Hora de fin',
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
        CRUD::setValidation(TimeBlockRequest::class);

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
        ]);
        
        CRUD::addField([
            'name' => 'start_time',
            'label' => 'Hora de inicio',
        ]);

        CRUD::addField([
            'name' => 'end_time',
            'label' => 'Hora de fin',
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Activo',
            'type' => 'checkbox',
            'default' => '1',
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
