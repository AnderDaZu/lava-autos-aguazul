<?php

namespace App\Observers\Api\v1;

use App\Models\Api\v1\Appointment;

class AppointmentObserver
{

    public function creating(Appointment $appointment)
    {
        if (! \App::runningInConsole()) {

            if ( auth()->user()->roles[0]['name'] === 'user' ) {

                $appointment->client_id = auth()->user()->id;

            }else if( auth()->user()->roles[0]['name'] === 'yard_manager' ){

                $appointment->client_id = null;

            }
        }
    }
}
