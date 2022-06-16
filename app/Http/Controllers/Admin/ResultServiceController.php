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
        
        // $users = User::where('birthdate', date('Y', strtotime('1998')))->count();
        
        // return $users;

        return view('admin.resut_tasks.index', compact('tasks', 'unscheduled_tasks'));
    }

    public function showTask(Task $task)
    {
        return view('admin.resut_tasks.show_task', compact('task'));
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
