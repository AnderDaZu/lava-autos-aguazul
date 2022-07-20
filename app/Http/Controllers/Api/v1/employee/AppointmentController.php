<?php

namespace App\Http\Controllers\Api\v1\employee;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
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

        $tasks = Appointment::where('appointments.employee_id', $employee)
        ->where('appointments.date', '>=', $date)
        ->where('appointments.state_id', '=', 2)
        ->get();

        $data = [];

        foreach ($tasks as $task) {
            $data[] = [
                'id' => $task->id,
                'date' => $task->date,
                'hour' => $task->hour_start,
                'service' => $task->service->name,
                'plate' => $task->vehicle->plate,
                'model' => $task->vehicle->modelcar->name,
                'mark' => $task->vehicle->modelcar->mark->name,
            ];
        }

        if (count($data) > 0) {
            return response()->json([
                'success' => true,
                'tasks' => $data
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "No tiene servicios pendientes"
            ], 200);
        }

    }

    public function scheduled()
    {
        $employee = auth()->user()->id;
        $date = date('Y-m-d H:i:s', strtotime('-3 day', strtotime(date('Y-m-d H:i:s'))));

        $scheduled = Task::select('tasks.id', 'tasks.finished', 'services.name as service', 'modelcars.name as model', 'marks.name as mark', 'vehicles.plate')
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

        $unscheduled = UnscheduledTask::select('unscheduled_tasks.id', 'unscheduled_tasks.finished as date', 'types.name as type', 'unscheduled_tasks.plate as plate',
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
