<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Appointment;

class AppointmentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function(Appointment $appointment){
            $start = $appointment->starts_at;
            $end = $appointment->ends_at;

            $appointment['meta'] = [
                'year' => $start->year,
                'month' => $start->month,
                'day' => $start->day,
                'start_time' => $start->format('H:i'),
                'end_time' => $end->format('H:i'),
            ];

            return $appointment;
        })->groupBy('meta.year')
        ->map->groupBy('meta.month');
    }
}
