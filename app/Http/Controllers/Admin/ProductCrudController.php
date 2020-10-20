<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('producto', 'productos');

        $this->crud->denyAccess('show');

        /* $this->isAdmin = backpack_user()->hasRole('Super admin');

        if ( !$this->isAdmin ) {
            $this->userBusiness = Business::where('user_id', backpack_user()->id)->firstOrFail();
        } */
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // If not admin, show only user products
        // if(!$this->isAdmin) $this->crud->addClause('where', 'business_id', '=', $this->userBusiness->id);
    
        // Hide children products
        $this->crud->addClause('where', 'parent_id', '=', null);
        
        CRUD::addColumn([
            'name' => 'sku',
            'label' => 'SKU',
            'type' => 'text',
            ]);
            
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'product_class',
            'label' => 'Clase de producto',
            'type' => 'relationship',
        ]);
        CRUD::addColumn([
            'name' => 'product_type',
            'label' => 'Tipo de producto',
            'type' => 'relationship',
        ]);

        CRUD::addColumn([
            'name' => 'is_approved_text',
            'label' => 'Estado de aprobacion',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    switch($column['text']) {
                        case 'Aprobado': 
                            return 'badge badge-success';
                            break;
                        case 'Pendiente': 
                            return 'badge badge-default';
                            break;
                        case 'Rechazado': 
                            return 'badge badge-danger';
                            break; 
                    }
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
        CRUD::setValidation(ProductRequest::class);

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
