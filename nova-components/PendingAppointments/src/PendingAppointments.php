<?php

namespace Darren\PendingAppointments;

use Laravel\Nova\Card;
use App\Appointment;

class PendingAppointments extends Card
{
    public $width = '1/3';

    public function showTotal() {
        return $this->withMeta([
            'total' => Appointment::future()->pending()->count()
        ]);
    }

    public function component()
    {
        return 'pending-appointments';
    }
}
