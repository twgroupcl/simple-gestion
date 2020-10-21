<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        //return redirect('/seller/register');
        //return view('vendor');
        return view('categories');
    }
}
