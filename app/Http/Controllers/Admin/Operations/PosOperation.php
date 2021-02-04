<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;

trait PosOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupPosRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/', [
            'as'        => $routeName.'.index',
            'uses'      => $controller.'@index',
            'operation' => 'index',
        ]);

        Route::get($segment.'/pos', [
            'as'        => $routeName.'.pos',
            'uses'      => $controller.'@pos',
            'operation' => 'pos',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupPosDefaults()
    {
        $this->crud->allowAccess('pos');

        $this->crud->operation('pos', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'pos', 'view', 'crud::buttons.pos');
            // $this->crud->addButton('line', 'pos', 'view', 'crud::buttons.pos');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function index()
    {
        // $this->crud->hasAccessOrFail('index');

        // prepare the fields you need to show
        $this->data = null;
        // $this->data['crud'] = $this->crud;
        // $this->data['title'] = $this->crud->getTitle() ?? 'pos '.$this->crud->entity_name;

        // load the view
        return view("pos.index");
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function pos()
    {
        $this->crud->hasAccessOrFail('pos');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'pos '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.pos", $this->data);
    }
    public function posOrder($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $currentUser = backpack_user();
        $seller = Seller::where('user_id','=',$currentUser->id)->first();
        $items = OrderItem::where('order_id','=', $orderId)->get();

        $data = [
            'order' => $order,
            'seller' => $seller,
            'items'=> $items
        ];

        $customPaper = array(0,0,867.00,283.80);
        $pdf = PDF::loadView('order.pos_order',$data)->setPaper($customPaper, 'landscape');

        return $pdf->stream('pos_order_'.$orderId.'.pdf');
    }
}
