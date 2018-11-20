<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{Appointment, User};
use App\Mail\{AppointmentIsBooked, AppointmentIsCancelled, AppointmentIsConfirmed};
use Mail;

class SendAppointmentNotifications
{
	const AVAILABLE = Appointment::Statuses[0];
	const PENDING = Appointment::Statuses[1];
	const CONFIRMED = Appointment::Statuses[2];

    public function handle($event)
    {
        $apmt = $event->appointment;

        $attendee = User::find($apmt->attendee_id);
        $organisers = User::whereRole('organiser')->get();

        switch ($apmt->status) {
        	case self::AVAILABLE:
        		foreach ($organisers as $organiser)
		        	return Mail::to($organiser)->send(new AppointmentIsCancelled($apmt, $organiser));

        	case self::PENDING:
	        	foreach ($organisers as $organiser)
	        		return Mail::to($organiser)->send(new AppointmentIsBooked($apmt, $organiser));

        	case self::CONFIRMED:
        		return Mail::to($attendee)->send(new AppointmentIsConfirmed($apmt));
        }
    }
}
