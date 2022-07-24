<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\UnscheduledTask;

class ResultServiceController extends Controller
{
    public function index() 
    {
        $month_cstm = date('Y-m-d', strtotime('-1 month'));

        $tasksMonth = Task::where('started', '>=', $month_cstm)
        ->count();

        $tasksService = Task::groupBy('s.id', 'service', 'type')
            ->selectRaw('count(tasks.id) as total, s.name as service, t.name as type')
            ->join('appointments as a', 'a.id', '=', 'tasks.appointment_id')
            ->join('services as s', 's.id', '=', 'a.service_id')
            ->join('types as t', 't.id', '=', 's.type_id')
            ->orderBy('total', 'desc')
        ->first();

        $tasksEmployee = Task::groupBy('u.id', 'name', 'last')
            ->selectRaw('count(tasks.id) as total, u.name as name, u.last_name as last')
            ->join('appointments as a', 'a.id', '=', 'tasks.appointment_id')
            ->join('users as u', 'u.id', '=', 'a.employee_id')
            ->orderBy('total', 'desc')
        ->first();

        $tasks = Task::orderBy('started', 'desc')
        ->paginate(100);

        return view('admin.resut_tasks.index', compact('tasks', 'tasksMonth', 'tasksService', 'tasksEmployee'));
    }

    public function showTask(Task $task)
    {
        $data = [
            'id' => $task->id,
            'price' => $task->price,
            'service' => $task->appointment->service->name,
            'stocktaking' => $task->stocktaking,
            'start' => date('Y-m-d H:i', strtotime($task->started)),
            'finished' => date('Y-m-d H:i', strtotime($task->finished)),
            'plate' => $task->appointment->vehicle->plate,
            'model' => $task->appointment->vehicle->modelcar->name,
            'mark' => $task->appointment->vehicle->modelcar->mark->name,
            'color' => $task->appointment->vehicle->color->name,
            'type' => $task->appointment->vehicle->modelcar->type->name,
            'client' => $task->appointment->client->name." ".$task->appointment->client->last_name,
            'employee' => $task->appointment->employee->name." ".$task->appointment->employee->last_name,
            'yard' => $task->yardManager->name." ".$task->yardManager->last_name,
        ];

        return view('admin.resut_tasks.show_task', compact('data'));
    }

    public function indexUnscheduledTask()
    {
        $month_cstm = date('Y-m-d', strtotime('-1 month'));

        $tasksMonth = UnscheduledTask::where('unscheduled_tasks.finished', '>=', $month_cstm)
        ->count();
        
        $tasksService = Service::groupBy('services.id', 'service', 'type')
            ->selectRaw('count(services.id) as total, services.id, services.name as service, t.name as type')
            ->join('unscheduled_tasks as ut', 'ut.servicio_id', '=', 'services.id')
            ->join('types as t', 't.id', '=', 'services.type_id')
            ->orderBy('total', 'desc')
        ->first();

        $tasksEmployee = UnscheduledTask::groupBy('id', 'name', 'last')
            ->selectRaw('count(unscheduled_tasks.id) as total, u.id as id, u.name as name, u.last_name as last')
            ->join('users as u', 'u.id', '=', 'unscheduled_tasks.employee_id')
            ->orderBy('total', 'desc')
        ->first();

        $tasks = UnscheduledTask::orderBy('finished', 'desc')->paginate(100);
        
        return view('admin.resut_tasks.index_unscheduled_tasks', compact('tasks', 'tasksService', 'tasksMonth', 'tasksEmployee'));
    }
    
    public function showUnscheduledTask(UnscheduledTask $unscheduled_task)
    {
        return view('admin.resut_tasks.show_unscheduled_task', compact('unscheduled_task'));
    }

    public function summary()
    {
        $month_cstm = date('Y-m-d', strtotime('-1 month'));
        $day_cstm =  date('Y-m-d', strtotime('-7 day'));
        
        // Unscheduled Tasks

        $tasksEmployeeU = UnscheduledTask::groupBy('id', 'name', 'last')
            ->selectRaw('count(unscheduled_tasks.id) as total, u.id as id, u.name as name, u.last_name as last')
            ->join('users as u', 'u.id', '=', 'unscheduled_tasks.employee_id')
            ->orderBy('total', 'desc')
        ->take(3)->get();

        $tasksServiceU = Service::groupBy('services.id', 'service', 'type')
            ->selectRaw('count(services.id) as total, services.id, services.name as service, t.name as type')
            ->join('unscheduled_tasks as ut', 'ut.servicio_id', '=', 'services.id')
            ->join('types as t', 't.id', '=', 'services.type_id')
            ->orderBy('total', 'desc')
        ->take(3)->get();

        $tasksMonthUM = UnscheduledTask::where('unscheduled_tasks.finished', '>=', $month_cstm)
        ->count();

        $tasksDayUD = UnscheduledTask::where('unscheduled_tasks.finished', '>=', $day_cstm)
        ->count();

        // Scheduled Tasks

        $tasksMonthS = Task::where('started', '>=', $month_cstm)
        ->count();

        $tasksDayS = Task::where('started', '>=', $month_cstm)
        ->count();

        $tasksServiceS = Task::groupBy('s.id', 'service', 'type')
            ->selectRaw('count(tasks.id) as total, s.name as service, t.name as type')
            ->join('appointments as a', 'a.id', '=', 'tasks.appointment_id')
            ->join('services as s', 's.id', '=', 'a.service_id')
            ->join('types as t', 't.id', '=', 's.type_id')
            ->orderBy('total', 'desc')
        ->take(3)->get();

        $tasksEmployeeS = Task::groupBy('u.id', 'name', 'last')
            ->selectRaw('count(tasks.id) as total, u.name as name, u.last_name as last')
            ->join('appointments as a', 'a.id', '=', 'tasks.appointment_id')
            ->join('users as u', 'u.id', '=', 'a.employee_id')
            ->orderBy('total', 'desc')
        ->take(3)->get();

        return view("admin.resut_tasks.summary", compact('tasksEmployeeS', 'tasksEmployeeU', 'tasksServiceU', 'tasksServiceS', 'tasksMonthS', 'tasksDayS', 'tasksDayUD', 'tasksMonthUM'));
    }
}
