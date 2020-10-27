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
use App\Http\Requests\Frontend\CustomerUpdateRequest;
use App\Models\Commune;
use App\User;
use Illuminate\Support\Facades\Mail;

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
            if(!Auth::user()->hasRole('Cliente Marketplace')) {
                Auth::logout();
            }

            return redirect('home');
        }

        return view('customer.sign')->with('error', 'Upps! Las credenciales son incorrectas.');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->regenerate();
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

        Mail::send('vendor.maileclipse.templates.resetPassword', ['token' => $token], function ($message) use ($request) {
            $message->from('no-reply@twgroup.cl');
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return view('customer.recovery')->with('success', '¡Hemos enviado un email con el enlace de restablecimiento de contraseña!');
    }
    public function profile()
    {
        $customer = Customer::firstWhere('user_id', auth()->user()->id);
        return view('customer.profile', ['customer' => $customer]);
    }

    public function address()
    {
        $customer = Customer::firstWhere('user_id', auth()->user()->id);
        $communes = Commune::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('customer.address', [
            'customer' => $customer,
            'communes' => $communes,
        ]);
    }

    public function order()
    {
        $customer = Customer::firstWhere('user_id', auth()->user()->id);
        return view('customer.order', ['customer' => $customer]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $requestValidated = $request->validated();
        if (blank($requestValidated['password'])) {
            unset($requestValidated['password']);
            unset($requestValidated['password_confirmation']);
        }

        $customer->update($requestValidated);

        return redirect()->route('customer.profile');
    }
}
