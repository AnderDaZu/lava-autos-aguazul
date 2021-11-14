<?php

namespace App\Observers\Api\v1;

use App\Models\Api\v1\Vehicle;

class VehicleObserver
{
    
    public function creating(Vehicle $vehicle)
    {
        if (! \App::runningInConsole()) {

            if ( auth()->user()->roles[0]['name'] === 'user' ) {
                
                $vehicle->client_id = auth()->user()->id;

            }else if( auth()->user()->roles[0]['name'] === 'yard_manager' ){

                $vehicle->client_id = null;

            }
        }
    }
}
