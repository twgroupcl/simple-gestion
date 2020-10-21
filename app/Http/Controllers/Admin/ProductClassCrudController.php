<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductClass;
use Illuminate\Http\Request;
use App\Cruds\BaseCrudFields;
use App\Http\Requests\ProductClassRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductClassCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductClassCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ProductClass::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/productclass');
        CRUD::setEntityNameStrings('clase de producto', 'clases de producto');
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
            'type' => 'text',
        ]);


        CRUD::addColumn([
            'name' => 'status_description',
            'label' => 'Estado',
            'type' => 'text',
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
        CRUD::setValidation(ProductClassRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
        ]);

        CRUD::addField([  // TO DO: Maked nested
            'label'     => "Categoría",
            'type'      => 'select2',
            'name'      => 'category_id',
            'entity'    => 'category',
            'model'     => "App\Models\ProductCategory", 
            'attribute' => 'name',
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


    /**
     * Get and filter a list of categories depending on the category selected
     * 
     */
    public function searchProductClasses(Request $request) {
        $search_term = $request->input('q');
        $form = collect($request->input('form'));
        $categories = [];

        foreach($form as $data) {
            if($data['name'] == 'categories[]') array_push($categories, $data['value']);
        }

        $options = ProductClass::query();

        if ( empty($categories) ) {
            $options = $options->whereNull('category_id')->where('status', '1');
        } else {
            $options = $options->whereNull('category_id')->orWhereIn('category_id', $categories);
        }

        if ($search_term) {
            $results = $options->whereRaw('LOWER(name) like ?', '%'.strtolower($search_term).'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }
}
