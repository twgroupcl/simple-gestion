<?php

namespace App\Http\Controllers\Admin;

use App\Cruds\BaseCrudFields;
use App\Http\Requests\ProductInventorySourceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductInventorySourceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductInventorySourceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ProductInventorySource::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/productinventorysource');
        CRUD::setEntityNameStrings('bodega', 'bodegas');
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
        //CRUD::setFromDb(); // columns

        CRUD::addColumn([
            'name' => 'code',
            'label' => 'Codigo',
            'type' => 'text',
        ]);
        
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'commune',
            'label' => 'Comuna',
            'type' => 'relationship',
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
        CRUD::setValidation(ProductInventorySourceRequest::class);

        /* $this->crud = (new BaseCrudFields())->setBaseFields($this->crud); */

        //CRUD::setFromDb(); // fields

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre de la bodega',
            'type' => 'text',
            'tab' => 'Información general',
        ]);

        CRUD::addField([
            'name' => 'code',
            'label' => 'Codigo',
            'type' => 'text',
            'tab' => 'Información general',
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Descripción',
            'type' => 'textarea',
            'tab' => 'Información general',
        ]);

        CRUD::addField([
            'name' => 'commune_id',
            'label' => 'Comuna',
            'entity' => 'commune',
            'type' => 'relationship',
            'tab' => 'Ubicación',
        ]);


        CRUD::addField([
            'name' => 'address_street',
            'label' => 'Calle',
            'type' => 'text',
            'tab' => 'Ubicación',
            'wrapper' => [
                'class' => 'form-group col-lg-6 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'address_number',
            'label' => 'Numero',
            'type' => 'text',
            'tab' => 'Ubicación',
            'wrapper' => [
                'class' => 'form-group col-lg-3 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'address_subnumber',
            'label' => 'Casa/Depto/Oficina',
            'type' => 'text',
            'tab' => 'Ubicación',
            'wrapper' => [
                'class' => 'form-group col-lg-3 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'priority',
            'label' => 'Prioridad de la bodega',
            'type' => 'number',
            'tab' => 'Información general',
            'wrapper' => [
                'class' => 'form-group col-lg col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'latitude',
            'label' => 'Latitud',
            'type' => 'number',
            'attributes' => [
                'step' => 'any',
            ],
            'tab' => 'Ubicación',
            'wrapper' => [
                'class' => 'form-group col-lg col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'longitude',
            'label' => 'Longitud',
            'type' => 'number',
            'tab' => 'Ubicación',
            'attributes' => [
                'step' => 'any',
            ],
            'wrapper' => [
                'class' => 'form-group col-lg col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Activo',
            'type' => 'checkbox',
            'tab' => 'Información general',
            'default' => '1',
        ]);

        CRUD::addField([
            'name' => 'contact_uid',
            'label' => 'RUT',
            'type' => 'text',
            'tab' => 'Información de contacto',
        ]);

        CRUD::addField([
            'name' => 'contact_first_name',
            'label' => 'Nombre',
            'type' => 'text',
            'tab' => 'Información de contacto',
            'wrapper' => [
                'class' => 'form-group col-lg-6 col-md-12 mb-3',
            ],
        ]);


        CRUD::addField([
            'name' => 'contact_last_name',
            'label' => 'Apellido',
            'type' => 'text',
            'tab' => 'Información de contacto',
            'wrapper' => [
                'class' => 'form-group col-lg-6 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'contact_email',
            'label' => 'Correo electronico',
            'type' => 'email',
            'tab' => 'Información de contacto',
            'wrapper' => [
                'class' => 'form-group col-lg-6 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'contact_phone',
            'label' => 'Numero telefonico',
            'type' => 'text',
            'tab' => 'Información de contacto',
            'wrapper' => [
                'class' => 'form-group col-lg-6 col-md-12 mb-3',
            ],
        ]);

        CRUD::addField([
            'name' => 'rut_formatter',
            'type' => 'rut_formatter',
            'rut_fields' => ['contact_uid'],
            'tab' => 'Ubicación',
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
}
