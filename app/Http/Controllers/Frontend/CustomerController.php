<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Backpack\Settings\app\Models\Setting;
use App\Http\Requests\Frontend\CustomerStoreRequest;
use App\User;

class CustomerController extends Controller
{
    public function sign()
    {
        return view('customer.sign');
    }

    public function store(CustomerStoreRequest $request)
    {
        $request['customer_segment_id'] = Setting::get('default_customer_segment');
        $request['company_id'] = Setting::get('default_company');

        Customer::create($request->all());

        //@todo: debo mostrar los errores de contraseña

        return view('customer.sign')->with('success', 'Registro completado con éxito. Por favor inicie sesión.');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return view('customer.sign')->with('error', 'Upps! Las credenciales son incorrectas.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('home');
    }

    public function forget()
    {
        return view('customer.recovery');
    }

    public function recovery(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // Mail::send('auth.password.verify', ['token' => $token], function ($message) use ($request) {
        //     $message->from($request->email);
        //     $message->to('codingdriver15@gmail.com');
        //     $message->subject('Reset Password Notification');
        // });

        return view('customer.recovery')->with('success', '¡Hemos enviado un email con el enlace de restablecimiento de contraseña!');
    }

    public function profile()
    {
        $customer = Customer::firstWhere('user_id', auth()->user()->id);
        return view('customer.profile', ['customer' => $customer]);
    }

    public function address()
    {
        return view('customer.address');
    }

    public function order()
    {
        return view('customer.order');
    }
}
