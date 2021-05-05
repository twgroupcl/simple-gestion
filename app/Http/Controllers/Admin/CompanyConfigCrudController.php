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
        CRUD::setEntityNameStrings('compañía', 'compañías');

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
            'label' => 'Compañía',
        ]);

        CRUD::addField([
            'name' => 'delivery_days_min',
            'label' => 'Tiempo estimado de envió mínimo',
            'type' => 'number',
            'suffix' => 'días',
        ]);

        CRUD::addField([
            'name' => 'delivery_days_max',
            'label' => 'Tiempo estimado de envió máximo',
            'type' => 'number',
            'suffix' => 'días',
        ]);

        CRUD::addField([
            'name' => 'privacy_policy_path',
            'label' => 'Políticas de privacidad (PDF)',
            'type' => 'upload',
            'upload'    => true,
        ]);

        CRUD::addField([
            'name' => 'terms_and_conditions_path',
            'label' => 'Términos y condiciones (PDF)',
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
