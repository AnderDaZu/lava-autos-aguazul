<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller 
{
    public function __construct()
    {
        $this->middleware('can:yard.appointments.index')->only('index');
    }

    public function index()
    {
        $appointments = Appointment::where('horario_id', 1)
            ->where('date', date('Y-m-d'))
            ->where('state_id', 2)
            ->latest('id')
        ->get();

        if ( count($appointments) > 0 ) {
            return response()->json($appointments, 200);
        }else{
            return response()->json("No hay citas agendadas o pendientes.", 200);
        }
    }

}
