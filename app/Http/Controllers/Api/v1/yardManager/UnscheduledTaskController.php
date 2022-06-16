<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\Admin\Type;
use App\Models\Api\v1\UnscheduledTask;
use App\Models\User;
use Illuminate\Http\Request;

class UnscheduledTaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:yard.unscheduledtasks.index')->only('index');
        $this->middleware('can:yard.unscheduledtasks.types')->only('types');
        $this->middleware('can:yard.unscheduledtasks.employees')->only('servicesAndEmployees');
        $this->middleware('can:yard.unscheduledtasks.show')->only('show');
        $this->middleware('can:yard.unscheduledtasks.store')->only('store');
    }

    public function index()
    {
        $yard_id = auth()->user()->id;
        $unscheduledTasks = UnscheduledTask::select('services.name', 'unscheduled_tasks.price', 'unscheduled_tasks.plate', 'users.name', 'users.last_name')
        ->join('services', 'services.id', '=', 'unscheduled_tasks.servicio_id')
        ->join('users', 'users.id', '=', 'unscheduled_tasks.employee_id')
        ->where('yardManager_id', $yard_id)
        ->latest('id')
        ->get();

        if ( count($unscheduledTasks) > 0 ) {
            return response()->json(['tareas' => $unscheduledTasks], 200);
        }else{
            return response()->json("Aún no ha registrado servicios completados", 200);
        }
    }

    public function types()
    {
        $types = Type::select('id', 'name')->get();
        return response()->json(['types' => $types], 200);
    }

    public function servicesAndEmployees(Type $type)
    {
        $services = Service::select('id', 'name')->where('type_id', $type->id)->get();
        $employees = User::role('employee')->where('state_id', 1)->get();
        
        if ( count($employees) ) {
            return response()->json(["services" => $services, "employees" => $employees, 'type' => $type], 200);            
        }else {
            return response()->json("No hay empleados disponibles", 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|string',
            'price' => 'required|integer',
            'stocktaking' => 'required|string|min:50',
            'employee_id' => 'required|exists:users,id',
            'servicio_id' => 'required|exists:services,id',
        ]);

        $time_now = date('Y-m-d H:i:s');

        $unscheduledTask = UnscheduledTask::create([
            'plate' => $request->plate,
            'price' => $request->price,
            'stocktaking' => $request->stocktaking,
            'finished' => $time_now,
            'employee_id' => $request->employee_id,
            'servicio_id' => $request->servicio_id,
        ]);

        return response()->json(['tarea' => $unscheduledTask], 201);

    }

    public function show(UnscheduledTask $unscheduledTask)
    {
        $data = [
            "fin" => $unscheduledTask->finished,
            "servicio" => $unscheduledTask->service->name,
            "precio" => $unscheduledTask->price,
            "placa" => $unscheduledTask->plate,
            "tipo vehiculo" => $unscheduledTask->service->type->name,
            "empleado" => $unscheduledTask->employee->name.' '.$unscheduledTask->employee->last_name,
            "jefe patio" => $unscheduledTask->yardManager->name.' '.$unscheduledTask->yardManager->last_name,
        ];

        return response()->json(['tarea' => $data], 200);
    }
}
