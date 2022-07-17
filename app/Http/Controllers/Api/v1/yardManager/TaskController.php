<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\UnscheduledTask;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:yard.tasks.index')->only('index');
        $this->middleware('can:yard.tasks.show')->only('show');
        $this->middleware('can:yard.tasks.store')->only('store');
        $this->middleware('can:yard.tasks.update')->only('update');
    }

    public function index() 
    {
        $yard_id = auth()->user()->id;
        // $tasks = Task::select('tasks.id', 'tasks.price', 'tasks.stocktaking', 'tasks.started', 'tasks.finished', 'tasks.appointment_id', 'tasks.yardManager_id', 'services.name as service', 'vehicles.plate', 'modelcars.name')
        // ->join('appointments', 'appointments.id', '=', 'tasks.appointment_id')
        // ->join('services', 'services.id', '=', 'appointments.service_id')
        // ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
        // ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
        // ->where('yardManager_id', $yard_id)->latest('id')->latest('id')
        // ->get();
        $date = date('Y-m-d H:i:s', strtotime('-2 day', strtotime(date('Y-m-d H:i:s'))));
        
        $tasks = Task::where('finished', null)
        ->where('started', '>=', $date)
        ->get();
        $data = [];

        foreach ($tasks as $task) {
            $data[] = [
                'id' => $task->id,
                'price' => $task->price,
                'stocktaking' => $task->stocktaking,
                'date' => date('Y-m-d', strtotime($task->started)),
                'hour' => date('H:i', strtotime($task->started)),
                'finished' => $task->finished,
                'appointment_id' => $task->appointment_id,
                'yard_id' => $task->yardManager_id,
                'yard_name' => $task->yardManager->name." ".$task->yardManager->last_name,
                'service' => $task->appointment->service->name,
                'plate' => $task->appointment->vehicle->plate,
                'modelcar' => $task->appointment->vehicle->modelcar->name,
            ];
        }

        if ( count($tasks) > 0 ) {
            return response()->json([
                'success' => true,
                'tasks' => $data 
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Aún no hay servicios iniciados"
            ], 200);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'stocktaking' => 'required|min:4',
            'appointment_id' => "required|exists:appointments,id"
        ]);

        $appointment = Appointment::where('id', $request->appointment_id)->first();
        $state_appointment = $appointment->state_id;

        if ( $state_appointment == 1 ) {   
            return response()->json([
                'success' => false,
                'message' => "Selecciona una cita sin haber iniciado el servicio."
            ]);
        }

        $started = date('Y-m-d H:i:s');

        $task = Task::create([
            'price' => $request->price,
            'stocktaking' => $request->stocktaking,
            'started' => $started,
            'appointment_id' => $request->appointment_id,
        ]);

        $appointment->update(['state_id' => 1]);

        return response()->json([
                'success' => true,
                'message' => 'Servicio se inicio'
                // "servicio iniciado" => $task,
                // "cita tomadá" => $appointment
            ], 201);
    }


    public function show(Task $task)
    {
        $data = [
            'inicio' => $task->started,
            'fin' =>  $task->finished,
            'precio' => $task->price,
            'servicio' => $task->appointment->service->name,
            'placa' => $task->appointment->vehicle->plate,
            'modelo' => $task->appointment->vehicle->modelcar->name,
            'inventario' => $task->stocktaking,
            'empleado' => $task->appointment->employee->name.' '.$task->appointment->employee->last_name,
            'jefe patio' => $task->yardManager->name.' '.$task->yardManager->last_name,
        ];
        return response()->json(['servicio' => $data], 200);
    }


    public function update(Task $task)
    {
        if( $task->finished == '' ){
            $task->update(['finished' => date('Y-m-d H:i:s')]);
            return response()->json([
                'success' => true,
                'finalizó' => $task->finished
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'message' => "Tarea ya se ha finalizadó"
            ], 200);
        }
    }

    public function listTasks()
    {
        // $date = date('Y-m-d H:i:s', strtotime('-2 day', strtotime(date('Y-m-d H:i:s'))));

        // $scheduled = Task::where('started', '>=', $date);
        // $unscheduled = UnscheduledTask::where('finished', '>=', $date);
        
        // $dataScheduled = [];
        // $dataUnscheduled = [];

        // foreach ($scheduled as $task) {
        //     $dataScheduled[] = [
        //         'date' => $task['finished'],
        //         'service' => $task['']
        //     ];
        // }

        // foreach ($unscheduled as $task) {
            
        // }

    }

}
