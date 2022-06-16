<?php

namespace App\Providers;

use App\Models\Admin\Post;
use App\Models\Api\v1\Appointment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\Vehicle;
use App\Observers\AppointmentObserver;
use App\Observers\PostObserver;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
use App\Observers\VehicleObserver;

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
        Appointment::observe(AppointmentObserver::class);
        Vehicle::observe(VehicleObserver::class);
        Task::observe(TaskObserver::class);
        Post::observe(PostObserver::class);
    }
}
