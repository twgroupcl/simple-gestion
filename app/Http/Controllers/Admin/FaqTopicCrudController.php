<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FaqTopicRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FaqTopicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FaqTopicCrudController extends CrudController
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
        CRUD::setModel(\App\Models\FaqTopic::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/faqtopic');
        CRUD::setEntityNameStrings('tópico', 'tópicos');
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
            'name' => 'title',
            'label' => 'Titulo',
        ]);
        
        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Descripción',
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
        CRUD::setValidation(FaqTopicRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Titulo',
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Descripción',
        ]);

        CRUD::addField([
            'name' => 'icon',
            'label' => 'Icono',
            'type' => 'icon_picker',
        ]);

        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug',
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
