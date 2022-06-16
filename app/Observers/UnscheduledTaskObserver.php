<?php

namespace App\Observers;

use App\Models\Api\v1\UnscheduledTask;

class UnscheduledTaskObserver
{
    /**
     * Handle the UnscheduledTask "created" event.
     *
     * @param  \App\Models\UnscheduledTask  $unscheduledTask
     * @return void
     */
    public function creating(UnscheduledTask $unscheduledTask)
    {
        if (! \App::runningInConsole()) {
            $unscheduledTask->yardManager_id = auth()->user()->id;
        }
    }
}
