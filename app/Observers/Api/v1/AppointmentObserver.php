<?php

namespace App\Observers\Api\v1;

use App\Models\Api\v1\Appointment;

class AppointmentObserver
{

    public function creating(Appointment $appointment)
    {
        if (! \App::runningInConsole()) {
            $appointment->client_id = auth()->user()->id;
        }
    }

}
