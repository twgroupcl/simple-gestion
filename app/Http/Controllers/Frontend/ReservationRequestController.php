<?php

namespace App\Http\Controllers\Frontend;

use App\Rules\RutRule;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationRequestController extends Controller
{
    public function request(Request $request, Company $company)
    {
        return view('reservation.request', compact('company'));
    }

    public function store(Request $request, $company)
    {
        $request->validate([
            'rut' => ['required', new RutRule()],
            'date' => 'required',
            'service_id' => 'required',
            'time_block_id' => 'required',
        ], [
            '*.required' => 'El campo :attribute es requerido',
        ], [
            'rut' => 'RUT',
            'date' => 'Fecha de reservacion',
            'service_id' => 'Servicio',
            'time_block_id' => 'Bloque horario',
        ]);
    }
}
