<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use DateInterval;
use App\Models\Company;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerAttendance;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{

    public function index(Company $company)
    {
        $services = Service::where('status', '1')->where('company_id', $company->id)->orderBy('name')->get();
        return view('attendance.index', compact('company', 'services'));
    }

    public function post(Request $request, Company $company)
    {
        $minutesValidation = 10;

        $rut = $request['is_foreign'] ? $request['rut'] : str_replace('.', '', $request['rut']);

        $customer = Customer::where('uid', $rut)->where('company_id', $company->id)->first();

        if (!$customer) return redirect()->route('attendance.index', ['company' => $company])->with('error', 'El RUT no pertenece a ningún cliente');

        $date = new DateTime();
        $date->sub(new DateInterval('PT' . $minutesValidation . 'M'));
        
        $validateAttendance = $customer->attendances()->where('attendance_time', '>', $date)->get();

        if ($validateAttendance->count() && $request['confirm'] == 0) {
            return redirect()->route('attendance.index', ['company' => $company, 'confirm' => 1])
                        ->withInput()
                        ->with('error', '¡Cuidado! ya has registrado una asistencia hace menos de ' . $minutesValidation . ' minutos. ¿Estás seguro que deseas registrar otra asistencia? de ser así, haz clic en el botón "Registrar asistencia"');
        }

        if (!$attendance = $customer->registerAttendance($company->id, $request['service_id'])) return redirect()->route('attendance.index', ['company' => $company])->with('error', '¡Algo salio mal! intentalo de nuevo.');
        
        $typeCheckIn = CustomerAttendance::CHECK_IN;
        $typeCheckOut = CustomerAttendance::CHECK_OUT;

        return view('attendance.post', compact('attendance', 'typeCheckIn', 'typeCheckOut', 'company'));
    }
}
