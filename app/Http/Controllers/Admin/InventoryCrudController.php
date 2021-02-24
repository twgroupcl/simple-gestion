<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductInventorySource;
use App\Services\Inventory\MassReceptionsService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Exports\Inventory\MassReceptionsTemplateExport;
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

        $this->admin = false;
        $this->userSeller = null;

        if (backpack_user()->can('inventory.admin')) {
            $this->admin = true;
        } else {
            $this->userSeller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        }
        
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if (!$this->admin) $this->crud->addClause('where', 'seller_id', '=', $this->userSeller->id);

        $this->crud->addClause('where', 'use_inventory_control', '=', 1);
        $this->crud->addClause('whereDoesntHave', 'children');
        
        $this->crud->addButtonFromView('line', 'update-stock', 'inventory.update-stock', 'begining');

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
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) use ($inventory) {
                    return $query->selectRaw("products.*, products.id as pid, 
                        (SELECT qty
                        FROM product_inventories
                        WHERE product_inventories.product_id = pid and product_inventories.product_inventory_source_id = $inventory->id) AS product_qty")
                        ->orderBy('product_qty', $columnDirection);
                }
            ]);
        }

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
            'name'  => 'status',
            'type'  => 'dropdown',
            'label' => 'Estado'
          ], [
            0 => 'Inactivo',
            1 => 'Activo',
          ], function($value) {
            $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->addFilter([
            'name'  => 'stock_status',
            'type'  => 'dropdown',
            'label' => 'Disponibilidad'
          ], [
            0 => 'Sin inventario',
            1 => 'Con inventario',
          ], function($value) {
            if ($value == 0) {
                $this->crud->addClause('whereDoesntHave', 'inventories', function ($query) use ($value) {
                    return $query->where('qty', '!=', 0);
                });
            } else {
                $this->crud->addClause('whereHas', 'inventories', function ($query) use ($value) {
                    return $query->where('qty', '!=', 0);
                });
            }
            
        });

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

    public function massReceptionsView()
    {
        return view('admin/inventory/mass-receptions/index');
    }

    public function generateExcelTemplate(Request $request)
    {
        $fileName = 'plantilla_excel_recepciones.xls';

        $options = [
            'includeProducts' => $request->includeProducts ? true : false,
            'replaceStock' => $request->replaceStock ? true : false,
            'documentNumber' => $request->documentNumber ?? ' ',
        ];

        $excelTemplate = new MassReceptionsTemplateExport(backpack_user()->current()->company->id, $options);

        return Excel::download($excelTemplate, $fileName);
    }

    public function massReceptionsPreview(Request $request)
    {
        $excel = $request->file('inventory_excel');
        $massReceptionsService = new MassReceptionsService();
        dd($massReceptionsService->convertExcelToArray($excel));
    }
}
