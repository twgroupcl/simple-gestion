<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerAttendance;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{

    public function index()
    {
        return view('attendance.index');
    }

    public function post(Request $request)
    {
        $customer = Customer::where('uid',str_replace('.', '', $request['rut']))->first();

        if (!$customer) return redirect()->route('attendance.index')->with('error', 'El RUT no pertenece a ningun cliente');

        if (!$attendance = $customer->registerAttendance()) return redirect()->route('attendance.index')->with('error', '¡Algo salio mal! intentalo de nuevo.');
        
        $typeCheckIn = CustomerAttendance::CHECK_IN;
        $typeCheckOut = CustomerAttendance::CHECK_OUT;

        return view('attendance.post', compact('attendance', 'typeCheckIn', 'typeCheckOut'));
    }
}
