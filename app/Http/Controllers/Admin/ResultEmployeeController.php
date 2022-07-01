<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ResultEmployeeController extends Controller
{
    public function index()
    {
        $employees = User::role('employee')->get();
        
        return view('admin.result_employees.index', compact('employees'));
    }

    public function show(User $employee)
    {
        $tasks = Task::select('services.name', 'tasks.price', 'tasks.started',
        'tasks.finished', 'vehicles.plate', 'modelcars.name as model', 'marks.name as mark', 'colors.name as color')
        ->join('appointments', 'appointments.id', '=', 'tasks.appointment_id')
        ->join('users', 'users.id', '=', 'appointments.employee_id')
        ->join('services', 'services.id', '=', 'appointments.service_id')
        ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
        ->join('colors', 'colors.id', '=', 'vehicles.color_id')
        ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
        ->join('marks', 'marks.id', '=', 'modelcars.mark_id')
        ->where('users.id', $employee->id)
        ->latest('finished')
        ->get();
        return $tasks;
        // return $employee->employeeAppointments;
        $data = [];
        foreach ($tasks as $task) {
            $data[] = [
                'service' => $task->appointment->service->name,
                'price' => $task->price,
                'started' => date('Y-m-d H:i', strtotime($task->started)),
                'finished' => date('Y-m-d H:i', strtotime($task->finished)),
                'plate' => $task->appointment->vehicle->plate,
                'modelcar' => $task->appointment->vehicle->modelcar->name,
                'mark' => $task->appointment->vehicle->modelcar->mark->name,
                'color' => $task->appointment->vehicle->color->name,
            ];
        }
        return [
            'count' => count($data),
            'data' => $data
        ];
        return view('admin.result_employees.show', compact('employee'));
    }
}
