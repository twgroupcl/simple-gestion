<?php

namespace App\Http\Controllers\Admin;

use App\Models\PriceList;
use Illuminate\Http\Request;
use App\Cruds\BaseCrudFields;
use App\Http\Requests\PriceListRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PriceListCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PriceListCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PriceList::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/pricelist');
        CRUD::setEntityNameStrings('lista de precio', 'listas de precios');
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
            'label' => 'Nombre',
            'name' => 'name',
        ]);

        CRUD::addColumn([
            'label' => 'Codigo',
            'name' => 'code',
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
        CRUD::setValidation(PriceListRequest::class);

        $this->crud = (new BaseCrudFields())->setBaseFields($this->crud);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
        ]);

        CRUD::addField([
            'name' => 'code',
            'label' => 'Codigo',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
        ]);

        CRUD::addField([   // radio
            'name'        => 'initial_price_cost', // the name of the db column
            'label'       => 'Precio y costo inicial de cada producto', // the input label
            'fake' => true,
            'store_in' => 'initial_options',
            'type'        => 'radio',
            'options'     => [
                // the key will be stored in the db, the value will be shown as label; 
                'actual_price' => "Precio actual del producto",
                'price_with_surcharge' => "Precio actual mas recargo",
                'price_with_discount' => "Precio actual menos descuento",
            ],
            'hint' => 'Al crear una lista de precios, se agregara a ella cada uno de tus productos con un precio y costo predefinido. Puedes elegir utilizar el precio actual del producto, o utilizar el precio agregnado un recargo o descuento.',
            // optional
            //'inline'      => false, // show the radios all on the same line?
            'wrapper' => [
                'class' => 'col-md-6 form-group',
            ],
        ]);

        CRUD::addField([
            'name' => 'surcharge_percentage',
            'label' => 'Porcentaje de recargo a aplicar',
            'fake' => true,
            'store_in' => 'initial_options',
            'type' => 'number',
            'suffix' => '%',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
                'style' => 'display:none',
                'id' => 'surcharge_percentage',
            ],
        ]);

        CRUD::addField([
            'name' => 'discount_percentage',
            'fake' => true,
            'store_in' => 'initial_options',
            'label' => 'Porcentaje de descuento a aplicar',
            'type' => 'number',
            'suffix' => '%',
            'wrapper' => [
                'class' => 'col-md-6 form-group',
                'style' => 'display:none',
                'id' => 'discount_percentage',
            ],
        ]);

        CRUD::addField([
            'name' => 'price_list_custom_js',
            'type' => 'price_list.custom_js',
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

    protected function modify($id)
    {
        $priceList = PriceList::findOrFail($id);

        return view('vendor.backpack.crud.price_list.modify', compact('priceList'));
    }

    protected function setupModifyRoutes($segment, $routeName, $controller)
    {
        \Route::get($segment.'/{id}/modify', [
            'as'        => $routeName.'.modify',
            'uses'      => $controller.'@modify',
            'operation' => 'modify',
        ]);

    }

    public function getProducts($priceListId)
    {
        $priceList = PriceList::findOrFail($priceListId);

        $products = $priceList->priceListItems->map(function ($item) {
            return [
                'id' => $item->product->id,
                'sku' => $item->product->sku,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'cost' => $item->product->cost,
            ];
        });

        return $products;
    }
}
