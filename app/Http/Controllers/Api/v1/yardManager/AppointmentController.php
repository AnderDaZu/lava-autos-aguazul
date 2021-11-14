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
        $this->middleware('can:yard.appointments.create')->only('store');
    }

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
        $appointment_query = Appointment::select('vehicles.plate', 'users.name', 'users.last_name', 'services.price')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('users', 'users.id', '=', 'employee_id')
            ->where('appointments.id', '=', $appointment['id'])
            ->get();
        $appointment_client = [
            'date' => $appointment['date'],
            'hour' => $appointment['hour'],
            'plate' => $appointment_query[0]['plate'],
            'employee' => $appointment_query[0]['name']." ".$appointment_query[0]['last_name'],
            'price' => $appointment_query[0]['price'],
        ];
        return response()->json($appointment_client, 200);
        
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id'
        ]);

        if ( $appointment['state_id'] === 1 ) {
            $appointment->update($request->only('state_id'));
            return response()->json(['message' => 'Se cancelo la cita correctamente'], 200);
        }else{
            return response()->json(['message' => 'No se pudo actualizar cita']);
        }
    }

}
