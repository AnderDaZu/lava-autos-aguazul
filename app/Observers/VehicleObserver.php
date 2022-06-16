<?php

namespace App\Observers;

use App\Models\Api\v1\Vehicle;

class VehicleObserver
{
    public function creating(Vehicle $vehicle)
    {
        if (! \App::runningInConsole()) {

            $vehicle->client_id = auth()->user()->id;
        }
    }
}
