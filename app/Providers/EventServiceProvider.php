<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\User;
use App\Models\Admin\Agenda;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Vehicle;
use App\Observers\AgendaObserver;
use App\Observers\Api\v1\AppointmentObserver;
use App\Observers\Api\v1\VehicleObserver;
use App\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Agenda::observe(AgendaObserver::class);
        Vehicle::observe(VehicleObserver::class);
        Appointment::observe(AppointmentObserver::class);
    }
}
