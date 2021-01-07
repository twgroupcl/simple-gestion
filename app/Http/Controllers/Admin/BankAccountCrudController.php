<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BankAccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BankAccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BankAccountCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\BankAccount::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bankaccount');
        CRUD::setEntityNameStrings('cuenta bancaria', 'cuentas bancarias');
        $company = backpack_user()->current()->company;
        $this->crud->addClause('where', 'company_id', $company->id);
        
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
            'name' => 'account_number',
            'label' => 'Número de cuenta',
        ]);

        CRUD::addColumn([
            'name' => 'account_type',
            'label' => 'Tipo',
        ]);

        CRUD::addColumn([
            'name' => 'bank',
            'label' => 'Banco',
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
        CRUD::setValidation(BankAccountRequest::class);

        CRUD::addField([
            'name' => 'account_number',
            'label' => 'Número de cuenta',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ]
        ]);

        CRUD::addField([
            'name' => 'account_type_id',
            'label' => 'Tipo',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ]
        ]);

        CRUD::addField([
            'name' => 'bank',
            'label' => 'Banco',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ]
        ]);

        CRUD::addField([
            'name' => 'owner_uid',
            'label' => 'RUT',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ]
        ]);

        CRUD::addField([
            'name' => 'owner_name',
            'label' => 'Nombre y apellido',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ]
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
