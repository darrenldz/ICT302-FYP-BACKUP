<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Appointment;

class AppointmentStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appointment;

    public function __construct(Appointment $apmt)
    {
		$this->appointment = $apmt;
    }
}
