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
        // $unscheduledTasks = UnscheduledTask::select('services.name', 'unscheduled_tasks.price', 'unscheduled_tasks.plate', 'users.name', 'users.last_name')
        // ->join('services', 'services.id', '=', 'unscheduled_tasks.servicio_id')
        // ->join('users', 'users.id', '=', 'unscheduled_tasks.employee_id')
        // ->where('yardManager_id', $yard_id)
        // ->latest('unscheduled_tasks.id')
        // ->get();

        $unscheduledTasks = UnscheduledTask::where('yardManager_id', $yard_id)->get();

        $data = [];

        foreach ($unscheduledTasks as $task) {
            $data[] = [
                'name' => $task->employee->name,
                'last_name' => $task->employee->last_name,
                'service' => $task->service->name,
                'price' => $task->price,
                'plate' => $task->plate,
                'type' => $task->type->name,
                'date' => date('Y-m-d', strtotime($task->finished)),
                'hour' => date('H:i', strtotime($task->finished)),
            ];
        }

        if ( count($data) > 0 ) {
            return response()->json([
                'success' => true,
                'tasks' => $data
            ], 200);
        }else{
            return response()->json([
                "success" => false,
                "response" => "Aún no ha registrado servicios completados"
            ], 200);
        }
    }

    public function types()
    {
        $types = Type::select('id', 'name')->get();
        $data = [];
        foreach ($types as $type) {
            $data[] = [
                'id' => $type->id,
                'name' => $type->name,
            ];
        }

        if (!empty($data)) {
            return response()->json([
                'success' => true,
                'types' => $data
            ], 200);
        } else{
            return response()->json([
                'success' => true,
                'message' => "No hay tipo de vehículos registrados"
            ], 200);
        }

    }

    public function servicesAndEmployees(Type $type)
    {
        $services = Service::where('type_id', $type->id)->get();
        $employees = User::role('employee')->where('state_id', 1)->get();

        $data_services = [];
        $data_employees = [];

        foreach ($services as $service) {
            $data_services[] = [
                'id' => $service->id,
                'name' => $service->name,
                'price' => $service->price,
            ];
        }

        foreach ($employees as $employee) {
            $data_employees[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'last_name' => $employee->last_name,
                'state_id' => $employee->state_id,
                'profile_photo_url' => $employee->profile_photo_url,
            ];
        }
        
        if ( count($employees) >= 1 ) {
            return response()->json([
                'success' => true,
                'type' => [
                    'id' => $type->id,
                    'name' => $type->name,
                ],
                "services" => $data_services, 
                "employees" => $data_employees, 
            ], 200);            
        }else {
            return response()->json([
                'success' => false,
                'message' => "No hay empleados disponibles"
            ], 200);
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
            'type_id' => 'required|exists:types,id',
        ]);

        $time_now = date('Y-m-d H:i:s');

        $unscheduledTask = UnscheduledTask::create([
            'plate' => $request->plate,
            'price' => $request->price,
            'stocktaking' => $request->stocktaking,
            'finished' => $time_now,
            'employee_id' => $request->employee_id,
            'yardManager_id' => auth()->user()->id,
            'servicio_id' => $request->servicio_id,
            'type_id' => $request->type_id,
        ]);

        return response()->json([
            'success' => true,
            'tarea' => "Servicio registrado correctamente."
        ], 201);

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
