<?php

namespace App\Http\Controllers\Api\v1\user;

use App\Http\Controllers\Controller;
use App\Models\Admin\Range;
use App\Models\Admin\ScheduledSpace;
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

    public function freeTime(Service $service)
    {
        $service_duration = $service->duration;
        $intervals = $service_duration / 45;
        $espaces = [];
        $spaces = ScheduledSpace::select('num', 'date', 'ranges.start', 'ranges.end')
            ->join('ranges', 'ranges.id', '=', 'scheduled_spaces.range_id')
            ->where( [ [ 'date', '>=', date('Y-m-d') ] ] )
            ->orderby('date')
            ->orderby('scheduled_spaces.num')
            ->orderby('ranges.start')
            ->get();
        for ($i=0; $i < sizeof($spaces) ; $i++) { 
            $espaces[$i] = ['hora' => $spaces[$i]['start'], 'fecha' => $spaces[$i]['date']];
        }
        return $espaces;
    }
}
