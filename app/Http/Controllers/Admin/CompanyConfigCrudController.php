<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CompanyConfigCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CompanyConfigCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Company::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/companyconfig');
        CRUD::setEntityNameStrings('company', 'companies');

        $this->crud->denyAccess('create');
        $this->crud->denyAccess('show');
        $this->crud->denyAccess('delete');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addClause('where', 'id', '=', session('user')['current']['company']['id']);

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
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
        CRUD::setValidation(CompanyRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Compañia',
        ]);

        CRUD::addField([
            'name' => 'delivery_days_min',
            'label' => 'Tiempo estimado de envio minimo',
            'type' => 'number',
            'suffix' => 'dias',
        ]);

        CRUD::addField([
            'name' => 'delivery_days_max',
            'label' => 'Tiempo estimado de envio maximo',
            'type' => 'number',
            'suffix' => 'dias',
        ]);

        CRUD::addField([
            'name' => 'privacy_policy_path',
            'label' => 'Politicas de privacidad',
            'type' => 'upload',
            'upload'    => true,
        ]);

        CRUD::addField([
            'name' => 'terms_and_conditions_path',
            'label' => 'Terminos y condiciones',
            'type' => 'upload',
            'upload'    => true,
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
