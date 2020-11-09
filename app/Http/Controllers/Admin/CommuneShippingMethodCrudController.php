<?php

namespace App\Http\Controllers\Admin;

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
        CRUD::setEntityNameStrings('metodo de envio', 'metodos de envio');
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
            'name' => 'seller',
            'label' => 'Vendedor',
            'type' => 'relationship',
        ]);

        CRUD::addColumn([
            'name' => 'commune',
            'label' => 'Comuna',
            'type' => 'relationship',
        ]);

        CRUD::addColumn([
            'name' => 'shipping_methods_accesor',
            'label' => 'Metodos de envio',
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
            'placeholder' => 'Selecciona un vendedor',
            'tab' => 'Configuración general'
        ]);

        CRUD::addField([
            'name' => 'commune_id',
            'label' => 'Comuna',
            'type' => 'relationship',
            'placeholder' => 'Selecciona una comuna',
            'tab' => 'Configuración general'
        ]);

        CRUD::addField(
            [
                'label'     => 'Envio gratis',
                'name'      => 'free_shipping_status',
                'type'      => 'checkbox',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
            ]);

        CRUD::addField(
            [
                'label'     => 'Tarifa fija',
                'type'      => 'checkbox',
                'name'      => 'flat_rate_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
            ]
        );

        CRUD::addField(
            [
                'label'     => 'Envio variable',
                'type'      => 'checkbox',
                'name'      => 'variable_status',
                'fake' => true,
                'store_in' => 'active_methods',
                'tab' => 'Configuración general',
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
            ]
        );


        CRUD::addField(
            [
                'label'     => 'Establecer esta configuración por defecto',
                'type'      => 'checkbox',
                'name'      => 'is_global',
                'hint' => 'Al activar este check se establecera esta configuracion de envío para todas las comunas que no tengan una configuracion individual',
                'tab' => 'Configuración general',
                'wrapper' => [
                    'class' => 'mt-3 form-group col-lg-12',
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
                        'weight_range' => 'Rango de peso (kg)',
                        'price_range' => 'Rango de precio',
                        'final_price' => 'Precio final',
                    ]
                ],
            ]
        ]);

        CRUD::addField([
            'name' => 'help_text',
            'type' => 'commune_shipping_method.help_text',
            'tab' => 'Variable',
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
