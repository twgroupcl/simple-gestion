<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cruds\BaseCrudFields;
use App\Models\ProductClassAttribute;
use App\Http\Requests\ProductClassAttributeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductClassAttributeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductClassAttributeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ProductClassAttribute::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/productclassattribute');
        CRUD::setEntityNameStrings('atributo de clase de producto', 'atributos de clase de producto');
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
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->orderBy('product_class_attributes.json_attributes->name', $columnDirection);
            },
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->whereRaw('LOWER(json_attributes->"$.name") like ?', '%'.strtolower($searchTerm).'%');
            }
        ]);

        CRUD::addColumn([
            'name' => 'product_class',
            'label' => 'Clase de producto',
            'type' => 'relationship',
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                return $query->leftJoin('product_classes', 'product_class_attributes.product_class_id', '=', 'product_classes.id')
                    ->orderBy('product_classes.name', $columnDirection);
            },
        ]);

        CRUD::addColumn([
            'name' => 'attribute_type',
            'label' => 'Tipo de atributo',
            'type' => 'text',
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->orderBy('product_class_attributes.json_attributes->type_attribute', $columnDirection);
            },
        ]);

        CRUD::addColumn([
            'name' => 'is_required_text',
            'label' => 'Es requerido',
            'type' => 'text',
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->orderBy('product_class_attributes.is_required', $columnDirection);
            }
        ]);

        CRUD::addColumn([
            'name' => 'is_configurable_text',
            'label' => 'Puede ser usado en variantes',
            'type' => 'text',
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->orderBy('product_class_attributes.is_configurable', $columnDirection);
            }
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
        CRUD::setValidation(ProductClassAttributeRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);
        
        CRUD::addField([
            'name' => 'product_class_id',
            'label' => 'Clase de producto',
            'type' => 'relationship',
            'entity' => 'product_class',
            'attribute' => 'name',
        ]); 

        CRUD::addField([
             'name' => 'name',
             'label' => 'Nombre del atributo',
             'fake' => true,
             'store_in' => 'json_attributes'
         ]);

         CRUD::addField([
            'name' => 'code',
            'label' => 'Codigo',
            'fake' => true,
            'store_in' => 'json_attributes'
        ]);

         CRUD::addField([
            'name' => 'type_attribute',
            'label' => 'Tipo de atributo',
            'type' => 'select2_from_array',
            'options' => [
                'text' => 'Texto',
                'checkbox' => 'Checkbox',
                'select' => 'Seleccion',
            ],
            'fake' => true,
            'store_in' => 'json_attributes',
        ]);

        CRUD::addField([ 
            'name'  => 'json_options',
            'label' => 'Opciones',
            'type'  => 'repeatable',
            'new_item_label'  => 'agregar nueva opción',
            'fields' => [
                [
                    'name'    => 'option_name',
                    'type'    => 'text',
                    'label'   => 'Opción',
                ],
            ],
            'wrapper' => [
                'style' => 'display:none',
                'id' => 'optionsItems'
            ],
        ]);
            
        CRUD::addField([
            'name' => 'is_required',
            'label' => 'Es requerido',
            'type' => 'checkbox',
        ]);

        CRUD::addField([
            'name' => 'is_configurable',
            'label' => 'Permitir el uso de este atributo para la creación de variantes',
            'type' => 'checkbox',
        ]);

        CRUD::addField([
            'name' => 'customHideOptions',
            'type' => 'product_class_attribute.hide_options',
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
     * Get and filter a list of configurable attributes depending of the product class
     * 
     */
    public function searchConfigurableAttributes(Request $request) {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        $options = ProductClassAttribute::query();
        //dd($options->first()->toJson());
        //dd($options->first()->descripcion_name);

        // if there is not product class selected, return empty
        if (! $form['product_class_id']) {
            return [];
        }

        // find attributes that are configurable and belong to the product class
        if ($form['product_class_id']) {
            $options = $options->where([
                'product_class_id' => $form['product_class_id'],
                'is_configurable' => 1,
                'json_attributes->type_attribute' => 'select',
            ])/* ->select('id', 'json_attributes->name as descripcion_name') */;
        }

        // filter by search term
        if ($search_term) {
            $results = $options->whereRaw('LOWER(json_attributes->"$.name") like ?', '%'.strtolower($search_term).'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }
}
