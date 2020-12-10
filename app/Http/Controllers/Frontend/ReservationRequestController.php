<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\RutRule;
use App\Models\Company;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ReservationRequest;
use App\Http\Controllers\Controller;

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
            'date' => 'required|date',
            'service_id' => 'required|exists:services,id',
            'time_block_id' => 'required|exists:time_blocks,id',
        ];

        $attributes = [
            'rut' => 'RUT',
            'date' => 'Fecha de reservacion',
            'service_id' => 'Servicio',
            'time_block_id' => 'Bloque horario',
        ];

        $messages = [
            '*.required' => 'El campo :attribute es requerido',
        ];

        $request->validate($rules, $messages, $attributes);

        $customer = Customer::where('uid', str_replace('.', '', $request['rut']))->where('company_id', $company->id)->first();

        if (!$customer) {
            return redirect()->route('reservation-request.index', ['company' => $company])->with('sessionError', 'El RUT no pertenece a ningún cliente');
        }

        ReservationRequest::create([
            'customer_id' => $customer->id,
            'date' => $request['date'],
            'service_id' => $request['service_id'],
            'time_block_id' => $request['time_block_id'],
            'company_id' => $company->id,
        ]);

        return redirect()->route('reservation-request.index', ['company' => $company])->with('success', 'Su solicitud fue recibida con éxito. Nos comunicaremos contigo en la brevedad posible.');
    }
}
