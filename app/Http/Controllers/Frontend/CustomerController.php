<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function store(Request $request)
    {   
        Customer::create($request->all());
        return redirect()->route('home');
    }

    public function authenticate(Request $request)
    {
        $customer = Customer::where('email','=',$request->email)->where('password','=',Hash::check('plain-text', $request->password))->get();
        
        if ($customer) {
            $request->session()->regenerate();
            return redirect()->to('home');
        }else{
            return redirect()->route('error');
        }
    }
}
