<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Task;
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
        $tasks = Task::select('tasks.id', 'tasks.price', 'tasks.stocktaking', 'tasks.started', 'tasks.finished', 'tasks.appointment_id', 'tasks.yardManager_id', 'services.name as service', 'vehicles.plate', 'modelcars.name')
        ->join('appointments', 'appointments.id', '=', 'tasks.appointment_id')
        ->join('services', 'services.id', '=', 'appointments.service_id')
        ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
        ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
        ->where('yardManager_id', $yard_id)->latest('id')->latest('id')->get();

        if ( count($tasks) > 0 ) {
            return response()->json($tasks, 200);
        }else{
            return response()->json("Aún no hay servicios iniciados por usted", 200);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'stocktaking' => 'required|min:20',
            'appointment_id' => "required|exists:appointments,id"
        ]);

        $appointment = Appointment::where('id', $request->appointment_id)->first();
        $state_appointment = $appointment->state_id;

        if ( $state_appointment == 1 ) {   
            return response()->json("Selecciona una cita sin haber iniciado el servicio.");
        }

        $started = date('Y-m-d H:i:s');

        $task = Task::create([
            'price' => $request->price,
            'stocktaking' => $request->stocktaking,
            'started' => $started,
            'appointment_id' => $request->appointment_id,
        ]);

        $appointment->update(['state_id' => 1]);

        return response()->json(["servicio iniciado" => $task, "cita tomadá" => $appointment], 201);
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
            return response()->json(['finalizó' => $task->finished], 200);
        }else {
            return response()->json("Tarea ya se ha finalizadó", 200);
        }
    }

}
