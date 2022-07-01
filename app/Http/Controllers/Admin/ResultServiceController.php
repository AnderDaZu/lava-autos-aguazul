<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\UnscheduledTask;
use App\Models\User;

class ResultServiceController extends Controller
{
    public function index() 
    {
        $day = date('d');
        $month = date('m');
        $year  = date('Y');

        $tasks = Task::latest('id')->get();
        $unscheduled_tasks = UnscheduledTask::latest('id')->get();

        return view('admin.resut_tasks.index', compact('tasks', 'unscheduled_tasks'));
    }

    public function showTask(Task $task)
    {
        $data = [
            'id' => $task->id,
            'price' => $task->price,
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
        return view('admin.resut_tasks.index_unscheduled_tasks');
    }
    
    public function showUnscheduledTask(UnscheduledTask $unscheduled_task)
    {
        return view('admin.resut_tasks.show_unscheduled_task', compact('unscheduled_task'));
    }
}
