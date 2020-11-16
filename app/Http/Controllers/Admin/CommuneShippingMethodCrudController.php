<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use App\Models\Commune;
use App\Cruds\BaseCrudFields;
use App\Http\Requests\CommuneShippingMethodRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommuneShippingMethodCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommuneShippingMethodCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CommuneShippingMethod::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/communeshippingmethod');
        CRUD::setEntityNameStrings('configuracion de envio', 'metodos de envio');

        $this->crud->denyAccess('show');
        $this->admin = false;
        $this->userSeller = null;

        if (backpack_user()->hasAnyRole('Super admin|Administrador negocio|Supervisor Marketplace')) {
            $this->admin = true;

            $this->crud->enableExportButtons();
        }

        if (backpack_user()->hasAnyRole('Vendedor marketplace')) {
            $this->userSeller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // If not admin, show only seller config
        if (!$this->admin) $this->crud->addClause('where', 'seller_id', '=', $this->userSeller->id);
        
        if ($this->admin) {
            CRUD::addColumn([
                'name' => 'seller',
                'label' => 'Vendedor',
                'type' => 'relationship',
            ]);
        }
        
        CRUD::addColumn([
            'name' => 'commune',
            'label' => 'Comuna',
            'type' => 'relationship',
        ]);

        CRUD::addColumn([
            'name' => 'is_global',
            'label' => 'Aplica a todas las comunas',
        ]);

        CRUD::addColumn([
            'name' => 'shipping_methods_accesor',
            'label' => 'Metodos de envio habilitados',
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
        CRUD::setValidation(CommuneShippingMethodRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        //CRUD::setFromDb(); // fields

        CRUD::addField([
            'name' => 'seller_id',
            'label' => 'Vendedor',
            'type' => 'relationship',
            'default' => $this->userSeller ?? '',
            'placeholder' => 'Selecciona un vendedor',
            'tab' => 'Configuración general',
            'wrapper' => [
                'style' => $this->admin ? '' : 'display:none',
             ],
        ]);

        CRUD::addField([
            'name' => 'commune_id',
            'type' => 'relationship',
            'label' => 'Comuna',
            'placeholder' => 'Selecciona una comuna',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'tab' => 'Configuración general',
            'attributes' => [
                'id' => 'commune_id_selector'
            ]
        ]);

        CRUD::addField(
            [
                'label'     => 'Establecer para todas las comunas',
                'type'      => 'checkbox',
                'name'      => 'is_global',
                'hint' => 'Al activar este check se establecera esta configuracion de envío para todas las comunas que no tengan una configuracion individual',
                'tab' => 'Configuración general',
                'wrapper' => [
                    'class' => 'mb-5 form-group col-lg-12',
                ],
                'attributes' => [
                    'class' => 'is_global_checker'
                ]
            ]
        );

        CRUD::addField(
            [
                'label'     => 'Envio gratis',
                'name'      => 'free_shipping_status',
                'type'      => 'checkbox',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'free_shipping_checker'
                ]
            ]);

        CRUD::addField(
            [
                'label'     => 'Tarifa fija',
                'type'      => 'checkbox',
                'name'      => 'flat_rate_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'flat_rate_checker'
                ]
            ]
        );

        CRUD::addField(
            [
                'label'     => 'Tarifa variable',
                'type'      => 'checkbox',
                'name'      => 'variable_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'variable_checker'
                ]
            ]
        );

        CRUD::addField(
            [
                'label'     => 'Retiro en tienda',
                'type'      => 'checkbox',
                'name'      => 'pickup_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'pickup_checker'
                ]
            ]
        );

        CRUD::addField(
            [
                'label'     => 'Chilexpress',
                'type'      => 'checkbox',
                'name'      => 'chilexpress_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'chilexpress_checker'
                ]
            ]
        );


        


        CRUD::addField([
            'name' => 'free_shipping',
            'label' => 'Envio gratis',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Envío gratis',
            'fields' => [
                [
                    'name' => 'price',
                    'label' => 'Precio de envio',
                    'type' => 'number',
                    'default' => 0,
                    'attributes' => [
                        'readonly' => true,
                    ]
                ],
            ]
        ]);

        CRUD::addField([
            'name' => 'pickup',
            'label' => 'Retiro en tienda',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Retiro en tienda',
            'fields' => [
                [
                    'name' => 'price',
                    'label' => 'Precio de envio',
                    'type' => 'number',
                    'default' => 0,
                    'attributes' => [
                        'readonly' => true,
                    ]
                ],
            ]
        ]);


        CRUD::addField([
            'name' => 'flat_rate',
            'label' => 'Tarifa fija',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Tarifa fija',
            'fields' => [
                [
                    'name' => 'price',
                    'label' => 'Precio de envio',
                    'default' => 0,
                    'type' => 'number',
                ],
            ]
        ]);

        CRUD::addField([
            'name' => 'variable',
            'label' => 'Variable',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Variable',
            'fields' => [
                [
                    'name' => 'table_prices',
                    'label' => 'Configuracion de precios',
                    'type' => 'table',
                    'columns' => [
                        'min_weight' => 'Peso minimo (kg) *',
                        'max_weight' => 'Peso maximo (kg) *',
                        'min_price' => 'Precio minimo ($)',
                        'max_price' => 'Precio maximo ($)',
                        'final_price' => 'Costo final de envio ($) *',
                    ]
                ],
                [
                    'name' => 'help_text',
                    'type' => 'commune_shipping_method.help_text',
                ]
            ]
        ]);

        /* CRUD::addField([
            'name' => 'help_text',
            'type' => 'commune_shipping_method.help_text',
            'tab' => 'Variable',
        ]); */

        CRUD::addField([
            'name' => 'chilexpress',
            'label' => 'Chilexpress',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Chilexpress',
            'fields' => [
                [
                    'name' => 'price',
                    'label' => 'Precio',
                    'type' => 'text',
                    'default' => 'El precio es calculado de manera automatica por Chilexpress',
                    'attributes' => [
                        'disabled' => true,
                    ]
                ],
            ]
        ]);


        CRUD::addField([
            'name' => 'custom_script',
            'type' => 'commune_shipping_method.custom_script',
            'tab' => 'Configuración general'
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
