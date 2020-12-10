<?php

namespace App\Http\Controllers\Frontend;

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
}
