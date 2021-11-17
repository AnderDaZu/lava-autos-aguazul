<?php

namespace App\Http\Controllers\Api\v1\user;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Vehicle;
use Illuminate\Http\Request;

class ItemAppointmentController extends Controller
{
   
    public function index($modelcar)
    {   
        // Seleccionar los servicios que hay para el vehiculo que creo
        $services = Vehicle::select('services.id', 'services.name', 'services.price', 'services.duration')
            ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
            ->join('types', 'types.id', '=', 'modelcars.type_id')
            ->join('services', 'services.type_id', '=', 'types.id')
            ->where('vehicles.id', '=', $modelcar)
            ->get();

        return response()->json(['data' => $services], 200);
    }

    public function freeTime($service)
    {
        // Calcula la durarión del servicio seleccionado
        $queryDuration = Service::select('services.duration')
            ->where('services.id', '=', $service)
            ->get();
        $durationService = $queryDuration[0]['duration'];


        $appointments = Appointment::select('appointments.date', 'appointments.hour', 'services.duration', 'horarios.start_hour', 'horarios.end_hour')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->where([ [ 'appointments.date', '>=', date('Y-m-d') ] ])
            ->get();

        $sum = [];
        $freeleft = [];
        $freeright = [];

        for ($i=0; $i < sizeof($appointments) ; $i++) {
            
            $appointment_hour_end = date('H:i:s', strtotime($appointments[$i]['hour'].'+'.$appointments[$i]['duration'].' minute'));
            
            if (  ($appointment_hour_end > date('H:i:s') ) && ( $appointments[$i]['date'] === date('Y-m-d') ) ) {
                $sum[$i] = $appointments[$i];
                if ( $appointments[$i]['start_hour'] === '07:00:00' ) {
                    if ( $appointment_hour_end < $appointments[$i]['end_hour'] ) {
                        $agenda_end_hour = $appointments[$i]['end_hour'];
                        // $freeright[$i] = $agenda_end_hour;
                        $freeright[$i] = date('i', strtotime($agenda_end_hour." - $appointment_hour_end minute"));
                    }
                }
            }
        }

        return $freeright;
    }
}
