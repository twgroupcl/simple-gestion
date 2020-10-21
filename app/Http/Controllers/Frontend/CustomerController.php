<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function store(Request $request)
    {   
        Customer::create($request->all());
        return redirect()->route('home');
    }

    public function authenticate(Request $request)
    {
       
    }
}
