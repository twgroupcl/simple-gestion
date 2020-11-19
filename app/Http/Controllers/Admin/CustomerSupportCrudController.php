<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerSupportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerSupportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerSupportCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerSupport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customersupport');
        CRUD::setEntityNameStrings('caso', 'casos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->denyAccess('show');

        CRUD::addColumn([
            'name' => 'id',
            'type' => 'text',
            'label' => 'ID',
        ]);

        CRUD::addColumn([
            'name' => 'seller',
            'type' => 'relationship',
            'label' => 'Vendedor',
            'entity' => 'seller',
            'attribute' => 'name',
        ],);

        CRUD::addColumn([
            'name' => 'contact_type',
            'type' => 'text',
            'label' => 'Tipo',
        ]);

        CRUD::addColumn([
            'name' => 'subject',
            'type' => 'text',
            'label' => 'Asunto',
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'type'  => 'date',
            'label' => 'Fecha Ingreso',
            'format' => 'l',
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'type' => 'text',
            'label' => 'Estado',
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
        CRUD::setValidation(CustomerSupportRequest::class);

        CRUD::setFromDb(); // fields

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
