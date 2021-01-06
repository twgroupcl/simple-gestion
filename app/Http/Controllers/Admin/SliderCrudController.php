<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SliderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SliderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Slider::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/slider');
        CRUD::setEntityNameStrings('slider', 'sliders');
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
            'type' => 'text',
            'label' => 'Nombre',
        ]);

        CRUD::addColumn([
            'name' => 'path_web',
            'type' => 'image',
            'label' => 'Ruta Slider Web',
        ]);

        CRUD::addColumn([
            'name' => 'path_mobile',
            'type' => 'image',
            'label' => 'Ruta Slider Móvil',
        ]);

        CRUD::addColumn([
            'name' => 'status_description',
            'type' => 'text',
            'label' => 'Estado',
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
        CRUD::setValidation(SliderRequest::class);


        CRUD::addField([
            'name' => 'name',
            'type'  => 'text',
            'label' => 'Nombre',
        ]);

        CRUD::addField([
            'name' => 'path_web',
            'type' => 'image',
            'label' => 'Slider Web (Reconmendable: 1700x400)',
            'crop' => true,
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'path_mobile',
            'type' => 'image',
            'label' => 'Slider Móvile (Reconmendable: 376x241)',
            'crop' => true,
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        CRUD::addField([
            'name' => 'visible_from',
            'type' => 'date',
            'label' => 'Visible desde ',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name' => 'visible_to',
            'type' => 'date',
            'label' => 'Visible hasta',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        CRUD::addField([
            'name' => 'order',
            'type' => 'number',
            'label' => 'Orden',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        CRUD::addField([
            'name' => 'link',
            'type' => 'text',
            'label' => 'Enlace',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        CRUD::addField([
            'name' => 'status',
            'type' => 'checkbox',
            'label' => 'Activo',
            'default' => 1,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
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
