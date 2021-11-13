<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller 
{
    public function index()
    {
        $appointments = Appointment::select('date', 'hour', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->latest('date')
            ->latest('hour')
            ->get();
        return response()->json(['citas' => $appointments], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'agenda_id' => 'required|exists:agendas,id',
            'service_id' => 'required|exists:services,id',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);
        $request['date'] = date('Y-m-d');
        $request['hour'] = date('H:i:s', strtotime('+ 2 minute'));
        $request['state_id'] = 1;
        $appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'state_id'));
        return response()->json(['message' => 'La cita se creo correctamente'], 201);
    }

    public function show(Appointment $appointment)
    {
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }
}
