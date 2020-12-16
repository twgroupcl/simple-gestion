<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\PosOperation;
use App\Http\Requests\PosRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class PosCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PosCrudController extends CrudController
{
    use PosOperation;
}
