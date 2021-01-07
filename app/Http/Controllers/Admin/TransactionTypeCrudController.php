<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionTypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransactionTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionTypeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TransactionType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transactiontype');
        CRUD::setEntityNameStrings('tipo de movimiento', 'tipos de movimientos');
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
            'name' => 'code',
            'label' => 'Código'
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre',
        ]);

        CRUD::addColumn([
            'name' => 'payment_or_expense_show',
            'label' => 'Abono|Gasto',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] === 'Abono') {
                        return 'badge badge-success';
                    }

                    if ($column['text'] === 'Gasto') {
                        return 'badge badge-danger';
                    }

                }
            ]
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
        CRUD::setValidation(TransactionTypeRequest::class);

        CRUD::addField([
            'name' => 'code',
            'label' => 'Código',
        ]);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre descriptivo'
        ]);

        CRUD::addField([
            'name' => 'is_payment',
            'label' => '¿Es abono?'
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Descripción',
        ]);
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
