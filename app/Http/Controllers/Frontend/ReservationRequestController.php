<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\RutRule;
use App\Models\Company;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ReservationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationRequestCreated;
use Illuminate\Database\QueryException;

class ReservationRequestController extends Controller
{
    public function request(Request $request, Company $company)
    {
        return view('reservation.request', compact('company'));
    }

    public function store(Request $request, Company $company)
    {
        $rules = [
            'rut' => ['required', new RutRule()],
            'date' => 'required|date|after_or_equal:today',
            'service_id' => 'required|exists:services,id',
            'time_block_id' => 'required|exists:time_blocks,id',
        ];

        $attributes = [
            'rut' => 'RUT',
            'date' => 'fecha de reserva',
            'service_id' => 'servicio',
            'time_block_id' => 'bloque horario',
        ];

        $messages = [
            '*.required' => 'El campo :attribute es requerido',
            'date.after_or_equal' => 'La :attribute debe igual o posterior al dia de hoy'
        ];

        $request->validate($rules, $messages, $attributes);

        $customer = Customer::where('uid', str_replace('.', '', $request['rut']))->where('company_id', $company->id)->first();

        if (!$customer) {
            return redirect()->route('reservation-request.index', ['company' => $company])->with('error', 'El RUT no pertenece a ningún cliente');
        }

        try {
            $reservation = ReservationRequest::create([
                'customer_id' => $customer->id,
                'date' => $request['date'],
                'service_id' => $request['service_id'],
                'time_block_id' => $request['time_block_id'],
                'company_id' => $company->id,
            ]);
        } catch(QueryException $exception) {
            return redirect()->route('reservation-request.index', ['company' => $company])->with('error', 'Ups! parece que ocurrió un error. Inténtalo nuevamente.');
        }

        $adminUsers = $company->getBusinessAdminUsers();
        
        foreach ($adminUsers as $adminUser) {
            Mail::to($adminUser->email)->send(new ReservationRequestCreated(1, $reservation));
        }

        Mail::to($customer->email)->send(new ReservationRequestCreated(2, $reservation));

        return redirect()->route('reservation-request.index', ['company' => $company])->with('success', 'Tu solicitud fue recibida con éxito. Nos comunicaremos contigo en la brevedad posible.');
    }
}
