<?php

namespace App\Observers;

use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Task;

class TaskObserver
{
    public function creating(Task $task)
    {
        if (! \App::runningInConsole()) {
            $task->yardManager_id = auth()->user()->id;
            
        }
    }

}
