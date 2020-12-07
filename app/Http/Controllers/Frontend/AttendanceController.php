<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerAttendance;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{

    public function index(Company $company)
    {
        return view('attendance.index', compact('company'));
    }

    public function post(Request $request, Company $company)
    {

        $customer = Customer::where('uid', str_replace('.', '', $request['rut']))->where('company_id', $company->id)->first();

        if (!$customer) return redirect()->route('attendance.index', ['company' => $company])->with('error', 'El RUT no pertenece a ningún cliente');

        if (!$attendance = $customer->registerAttendance($company->id)) return redirect()->route('attendance.index', ['company' => $company])->with('error', '¡Algo salio mal! intentalo de nuevo.');
        
        $typeCheckIn = CustomerAttendance::CHECK_IN;
        $typeCheckOut = CustomerAttendance::CHECK_OUT;

        return view('attendance.post', compact('attendance', 'typeCheckIn', 'typeCheckOut', 'company'));
    }
}
