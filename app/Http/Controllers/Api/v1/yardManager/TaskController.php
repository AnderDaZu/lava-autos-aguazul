<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::select('vehicles.plate', 'tasks.price', 'appointments.date', 'appointments.hour', 'modelcars.name', 'colors.name as color')
            ->join('appointments', 'appointments.id', '=', 'tasks.appointment_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
            ->join('colors', 'colors.id', '=', 'vehicles.color_id')
            ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
            ->where([ ['appointments.name', '=', 'Activo'], ['appointments.date', '>=', date('Y-m-d')] ])
            ->get();
        
        return $tasks;
    }


    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'stocktaking' => 'required|min:50',
            'appointment_id' => "required|exists:appointments,id"
        ]);

        $appointment = Appointment::select('appointments.date', 'appointments.hour', 'states.name')
            ->where('id', '=', $request['appointment_id'])
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->get();
        
            return $appointment;
    }


    public function show(Task $task)
    {
        //
    }


    public function update(Request $request, Task $task)
    {
        //
    }


    public function destroy(Task $task)
    {
        //
    }
}
