<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

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
}
