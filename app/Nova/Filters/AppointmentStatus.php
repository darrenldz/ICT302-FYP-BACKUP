<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\Appointment;

class AppointmentStatus extends Filter
{
    public function apply(Request $request, $query, $value)
    {
        return $query->where('status', $value);
    }

    public function options(Request $request)
    {
        return collect(Appointment::Statuses)->mapWithKeys(function($status){
        	return [$status => $status];
        });
    }
}
