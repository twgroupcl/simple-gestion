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

        if (backpack_user()->hasAnyRole('Super admin|Administrador negocio|Supervisor Marketplace|Admin filsa')) {
            $this->admin = true;

            $this->crud->enableExportButtons();
        } else {
            $this->userSeller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        }

        /* if (backpack_user()->hasAnyRole('Vendedor marketplace')) {
            $this->userSeller = Seller::where('user_id', backpack_user()->id)->firstOrFail();
        } */
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
                'attribute' => 'visible_name',

            ]);
        }

        CRUD::addColumn([
            'name' => 'shipping_methods_accesor',
            'label' => 'Metodos de envio habilitados',
        ]);

        CRUD::addColumn([
            'name' => 'is_global_accesor',
            'label' => 'Aplica a todas las comunas',
            'type' => 'text',
            'orderable'  => true,
            'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->orderBy('commune_shipping_methods.is_global', $columnDirection);
            },
        ]);

        CRUD::addColumn([
            'name' => 'commune',
            'label' => 'Comuna',
            'type' => 'relationship',
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
            'attribute' => 'visible_name',
            'tab' => 'Configuración general',
            'wrapper' => [
                'style' => $this->admin ? '' : 'display:none',
             ],
        ]);

        CRUD::addField([
            'name' => 'commune_id',
            'type' => 'relationship',
            'label' => 'Configurar por comuna',
            'placeholder' => 'Selecciona una comuna',
            'hint' => 'Los métodos de envío sobre una comuna en particular dejan sin efecto las configuraciones globales que haya determinado',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'tab' => 'Configuración general',
            'attributes' => [
                'id' => 'commune_id_selector'
            ]
        ]);


        CRUD::addField([
            'name' => 'helper_text' ,
            'type' => 'custom_html',
            'value' => '<div style="margin-top:11px; margin-bottom:-11px;"><label>Configurar globalmente</label></div>',
            'tab' => 'Configuración general',
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
                'name'      => 'picking_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
                'attributes' => [
                    'class' => 'picking_checker'
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
                    'label' => 'Precio de envío por paquete',
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
                    'label' => 'Precio de envío por paquete',
                    'default' => 0,
                    'type' => 'number',
                ],
            ]
        ]);

        CRUD::addField([
            'name' => 'variable',
            'label' => 'Tarifa variable',
            'type' => 'repeatable',
            'fake' => true,
            'store_in' => 'shipping_methods',
            'tab' => 'Tarifa variable',
            'fields' => [
                [
                    'name' => 'table_prices',
                    'label' => 'Configuracion de precios',
                    'type' => 'table',
                    'wrapper' => [
                        'class' => 'col-md-12 form-group required'
                    ],
                    'columns' => [
                        'min_weight' => 'Peso minimo (kg) *',
                        'max_weight' => 'Peso maximo (kg) *',
                        'min_price' => 'Valor minimo del paquete ($)',
                        'max_price' => 'Valor maximo del paquete ($)',
                        'final_price' => 'Precio final de envío por paquete ($) *',
                    ]
                ],
                [
                    'name' => 'fallback_price',
                    'label' => 'Precio de envío fallback',
                    'type' => 'number',
                    'default' => 0,
                    'wrapper' => [
                        'class' => 'col-md-12 form-group required'
                    ],
                    'hint' => 'Este sera el precio de envío empleado cuando el paquete no cumpla ninguna de las condiciones de la tabla de configuracion de precios',
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
            'name' => 'picking',
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
