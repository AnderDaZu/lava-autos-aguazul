<?php

namespace App\Http\Controllers\Api\v1\employee;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\UnscheduledTask;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:employee.tasks')->only('index');
        $this->middleware('can:employee.tasks.scheduled')->only('scheduled');
        $this->middleware('can:employee.tasks.unscheduled')->only('unscheduled');
    }

    public function index()
    {
        // return "Hello";
        $employee = auth()->user()->id;
        $date = date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:i:s'))));

        $tasks = Task::select('appointments.date as date', 'appointments.hour_start as hour', 'services.name as service',
        'vehicles.plate as plate', 'modelcars.name as model', 'marks.name as mark')
        ->join('appointments', 'appointments.id', 'tasks.appointment_id')
        ->join('services', 'services.id', '=', 'appointments.service_id')
        ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
        ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
        ->join('marks', 'marks.id', '=', 'modelcars.mark_id')
        ->where('appointments.employee_id', $employee)
        ->where('appointments.date', '>=', $date)
        ->where('tasks.finished', null)
        ->get();

        return $tasks;
    }

    public function scheduled()
    {
        $employee = auth()->user()->id;
        $date = date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:i:s'))));

        $scheduled = Task::select('tasks.finished', 'services.name', 'modelcars.name as model', 'marks.name as mark', 'vehicles.plate')
        ->join('appointments', 'appointments.id', '=', 'tasks.appointment_id')
        ->join('services', 'services.id', '=', 'appointments.service_id')
        ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
        ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
        ->join('marks', 'marks.id', '=', 'modelcars.mark_id')
        ->where('tasks.finished', '!=', null)
        ->where('tasks.finished', '>=', $date)
        ->where('appointments.employee_id', $employee)
        ->get();

        if( count($scheduled) > 0 ){
            return response()->json([
                'success' => true,
                'tasks' => $scheduled
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No tiene servicios finalizados'
            ]);
        }

    }

    public function unscheduled()
    {
        $employee = auth()->user()->id;
        $date = date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:i:s'))));

        $unscheduled = UnscheduledTask::select('unscheduled_tasks.finished as date', 'types.name as type', 'unscheduled_tasks.plate as plate',
        'services.name as service')
        ->join('services', 'services.id', '=', 'unscheduled_tasks.servicio_id')
        ->join('types', 'types.id', '=', 'unscheduled_tasks.type_id')
        ->where('unscheduled_tasks.employee_id', $employee)
        ->where('unscheduled_tasks.finished', '>=', $date)
        ->get();

        if ( count($unscheduled) > 0 ) {
            return response()->json([
                'success' => true,
                'tasks' => $unscheduled
            ], 200);
        }else{
            return response()->json([
                'success' => true,
                'message' => "No tiene servicios sin cita registrados"
            ], 200);
        }
    }
}
