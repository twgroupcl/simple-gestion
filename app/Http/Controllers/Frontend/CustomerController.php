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
        $request['uid'] = strtoupper(
            str_replace('.', '', $request['uid'])
        );


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
                if(Auth::user()->hasRole(['Super admin', 'Administrador negocio', 'Vendedor marketplace', 'Supervisor Marketplace'])) {
                    return redirect('admin');
                } else {
                    Auth::logout();
                }
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
        ],
        [
            'required' => 'Este campo es obligatorio',
            'email' => 'El campo :attribute debe ser un email',
            'exists' => 'El campo :attribute es inválido',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $data = [
            'logo' => asset('img/logo-pyme.png'),
            'title' => 'Cambio de contraseña',
            'text' => 'Recibes este email porque se solicitó un cambio de contraseña para tu cuenta.',
            'rejectedText' => 'Si no realizaste esta petición, puedes ignorar este correo y nada habrá cambiado.',
            'buttonText' => 'Ir a cambiar contraseña',
            'buttonLink' => route('password.reset', ['token' => $token]),
            'token' => $token,
        ];

        Mail::send('vendor.maileclipse.templates.resetPassword', $data, function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Notificación de cambio de contraseña');
        });

        return view('customer.recovery')->with('success', '¡Hemos enviado un email con el enlace de restablecimiento de contraseña!');
    }

    public function reset(Request $request, $token)
    {
        return view('auth.passwords.reset', compact('token'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ],
        [
            'required' => 'Este campo es obligatorio',
            'email' => 'El campo :attribute debe ser un email',
            'confirmed' => 'Las contraseñas no coinciden',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('email', $request->email);

        $isAllowed = $passwordReset
            ->count() !== 0;

        if (! $isAllowed) {
            return redirect()->back()->withErrors(['email' => 'Email no válido']);
        }
//@todo: validar esto en los casos que falle o que no sea cliente
        Customer::firstWhere('email', $request->email)->update([
            'password' => $request->password,
        ]);

        $passwordReset->delete();

        $data = [
            'logo' => asset('img/logo-pyme.png'),
            'title' => 'Tu contraseña ha sido exitosamente actualizada',
            'text' => 'Si no fuiste tú, te aconsejamos que restablezcas tu contraseña para garantizar la seguridad de tu cuenta.',
            'rejectedText' => '',
            'buttonText' => 'Vamos a comprar',
            'buttonLink' => route('index'),
        ];

        Mail::send('vendor.maileclipse.templates.passwordChanged', $data, function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Se ha cambiado la contraseña');
        });

        return redirect('customer/sign')->with('success', '¡Su contraseña ha sido actualizada exitosamente!');
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

    public function support(Request $request)
    {
        return view('customer.support');
    }
}
