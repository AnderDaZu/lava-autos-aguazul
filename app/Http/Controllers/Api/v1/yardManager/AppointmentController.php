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
            // ->latest('')
            ->orderby('id', 'asc')
        ->get();

        $data = [];

        foreach ($appointments as $appointment) {
            $data[] = [
                'id' => $appointment->id,
                'date' => $appointment->date,
                'hour_start' => date('H:i', strtotime($appointment->hour_start)),
                'hour_end' => date('H:i', strtotime($appointment->hour_end)),
                'service' => $appointment->service->name,
                'price' => $appointment->service->price,
                'plate' => $appointment->vehicle->plate,
                'model' => $appointment->vehicle->modelcar->name,
                'type' => $appointment->vehicle->modelcar->type->name,
                'employee' => $appointment->employee->name." ".$appointment->employee->last_name,
                'client' => $appointment->client->name." ".$appointment->client->last_name,
            ];
        }

        if ( count($appointments) > 0 ) {
            return response()->json([
                'success' => true,
                'appointments' => $data
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "No hay citas agendadas o pendientes."
            ], 200);
        }
    }

}
