<?php

namespace App\Observers;

use App\Models\Admin\Agenda;

class AgendaObserver
{

    public function creating(Agenda $agenda)
    {
        if (! \App::runningInConsole()) {
            $agenda->admin_id = auth()->user()->id;
        }
    }


}
