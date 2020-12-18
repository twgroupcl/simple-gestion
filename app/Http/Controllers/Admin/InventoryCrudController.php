<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Models\ProductInventorySource;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InventoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InventoryCrudController extends CrudController
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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/inventory');
        CRUD::setEntityNameStrings('inventario', 'inventarios');

        $this->crud->denyAccess('show');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('delete');
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
            'name' => 'categories',
            'label' => 'Categoria',
            'priority' => 3,
        ]);

        CRUD::addColumn([
            'name' => 'sku',
            'label' => 'SKU',
            'priority' => 1,
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'priority' => 1,
        ]);

        foreach (ProductInventorySource::all() as $inventory) {
            CRUD::addColumn([
                'name' => 'inventory_' . $inventory->id,
                'label' => $inventory->name,
                'type'  => 'model_function',
                'function_name' => 'getQtyInInventory', // the method in your Model
                'function_parameters' => [$inventory->id], // pass one/more parameters to that method
                'priority' => 2,
            ]);
        }

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
          ], [
            0 => 'Inactivo',
            1 => 'Activo',
          ], function($value) {
            $this->crud->addClause('where', 'status', $value);
          });

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
        CRUD::setValidation(ProductInventoryRequest::class);

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

    private function customFilters()
    {
        $this->crud->addFilter([
            'name'  => 'category_id',
            'type'  => 'select2',
            'label' => 'Categoria'
        ], function() {
            return ProductCategory::all()->sortBy('name')->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('whereHas', 'categories', function($query) use ($value) {
                $query->where('id', $value);
            });
        });
    }
}
