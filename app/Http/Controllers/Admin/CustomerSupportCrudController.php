<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerSupportRequest;
use App\Models\CustomerSupport;
use App\Models\Seller;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerSupportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerSupportCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as protected traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CustomerSupport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customersupport');
        CRUD::setEntityNameStrings('caso', 'casos');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->denyAccess('show');

        CRUD::addColumn([
            'name' => 'id',
            'type' => 'text',
            'label' => 'ID',
        ]);

        CRUD::addColumn([
            'name' => 'seller',
            'type' => 'relationship',
            'label' => 'Vendedor',
            'entity' => 'seller',
            'attribute' => 'name',
        ]);

        CRUD::addColumn([
            'name' => 'contact_type_description',
            'type' => 'text',
            'label' => 'Tipo',
        ]);

        CRUD::addColumn([
            'name' => 'subject',
            'type' => 'text',
            'label' => 'Asunto',
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'type'  => 'date',
            'label' => 'Fecha Ingreso',
            'format' => 'l',
        ]);

        CRUD::addColumn([
            'name' => 'status_description',
            'label' => 'Estado',
            'type' => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Resuelta') {
                        return 'badge badge-success';
                    }
                    if ($column['text'] == 'En revisión') {
                        return 'badge badge-primary';
                    }
                    return 'badge badge-default';
                },
            ],
        ]);

        $this->crud->addFilter([
            'name'  => 'seller_id',
            'type'  => 'select2',
            'label' => 'Vendedor'
        ], function() {
            return Seller::all()->sortBy('name')->pluck('name', 'id')->toArray();
        }, function($value) {
            $this->crud->addClause('whereHas', 'seller', function($query) use ($value) {
                $query->where('id', $value);
            });
        });

        $this->crud->addFilter([
            'name'  => 'contact_type',
            'type'  => 'select2',
            'label' => 'Tipo'
        ], function() {
            return [1 => 'Consulta', 2 => 'Reclamo', 3 => 'Sugerencia'];
        }, function($value) {
            $this->crud->addClause('where', 'contact_type', $value);
        });

        $this->crud->addFilter([
            'name'  => 'status',
            'type'  => 'select2',
            'label' => 'Estado'
        ], function() {
            return [1 => 'Pendiente', 2 => 'En revisión', 3 => 'Resuelta'];
        }, function($value) {
            $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->addFilter([
            'name'  => 'created_at',
            'type'  => 'date',
            'label' => 'Fecha'
        ],
        false,
        function($value) {
            logger($value);
            $this->crud->addClause('whereDate', 'created_at', $value);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomerSupportRequest::class);

        CRUD::addField([
            'name' => 'contact_type',
            'label' => 'Tipo de contacto',
            'type' => 'select2_from_array',
            'options' => [
                CustomerSupport::TYPE_QUESTION => 'Consulta',
                CustomerSupport::TYPE_CLAIM => 'En Reclamo',
                CustomerSupport::TYPE_SUGGESTION => 'Sugerencia'
            ],
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'subject',
            'type' => 'text',
            'label' => 'Asunto',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'maxlength' => '200',
            ],
        ]);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'maxlength' => '100',
            ],
        ]);

        CRUD::addField([
            'name' => 'email',
            'type' => 'text',
            'label' => 'E-mail',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'maxlength' => '100',
            ],
        ]);

        CRUD::addField([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Teléfono',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'maxlength' => '2000',
            ],
        ]);

        CRUD::addField([
            'name' => 'order_id',
            'type' => 'text',
            'label' => 'N° Orden',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'maxlength' => '4',
            ],
        ]);
        CRUD::addField([
            'name' => 'details',
            'label' => 'Detalle',
            'type' => 'textarea',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
            'attributes' => [
                'maxlength' => '2000',
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
        CRUD::addField([
            'name' => 'contact_type',
            'label' => 'Tipo de contacto',
            'type' => 'select2_from_array',
            'options' => [
                CustomerSupport::TYPE_QUESTION => 'Consulta',
                CustomerSupport::TYPE_CLAIM => 'En Reclamo',
                CustomerSupport::TYPE_SUGGESTION => 'Sugerencia'
            ],
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'subject',
            'type' => 'text',
            'label' => 'Asunto',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre',
            'type' => 'text',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'email',
            'type' => 'text',
            'label' => 'E-mail',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Teléfono',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'order_id',
            'type' => 'text',
            'label' => 'N° Orden',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);
        CRUD::addField([
            'name' => 'details',
            'label' => 'Detalle',
            'type' => 'textarea',
            'tab' => 'General',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Estado',
            'type' => 'select2_from_array',
            'options' => [
                CustomerSupport::STATUS_PENDING => 'Pendiente',
                CustomerSupport::STATUS_IN_REVIEW => 'En revisión',
                CustomerSupport::STATUS_SOLVED => 'Resuelta'
            ],
            'tab' => 'Administrador',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'seller_id',
            'label' => 'Vendedor',
            'type' => 'select2_from_array',
            'allows_null' => true,
            'options' => Seller::pluck('name', 'id')->toArray(),
            'tab' => 'Administrador',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
        ]);

        CRUD::addField([
            'name' => 'note',
            'label' => 'Nota',
            'type' => 'textarea',
            'tab' => 'Administrador',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',
            ],
        ]);

        CRUD::addField([
            'name' => 'notes',
            'label' => 'Notas',
            'type' => 'view',
            'view' => 'livewire.support.customer-support-backpack',
            'tab' => 'Administrador',
        ]);
    }

    protected function update()
    {
        $response = $this->traitUpdate();

        $customerSupport = $this->crud->entry;

        $note = request()->note;

        if (filled($note)) {
            $customerSupport->notes()->create(['note' => $note]);
            logger($customerSupport->notes()->latest()->get()->count());
        }

        return $response;
    }
}
