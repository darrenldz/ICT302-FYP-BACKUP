<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\AppointmentStatusUpdated;
use App\Listeners\SendAppointmentNotifications;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AppointmentStatusUpdated::class => [
            SendAppointmentNotifications::class,
        ],
    ];


    public function boot()
    {
        parent::boot();

        //
    }
}
