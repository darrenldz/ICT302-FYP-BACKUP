<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{Appointment, User};

class AppointmentIsBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $apmt;
    public $attendee;
    public $organiser;

    public function __construct(Appointment $apmt, User $organiser)
    {
        $this->apmt = $apmt;
        $this->organiser = $organiser;
        $this->attendee = User::find($apmt->attendee_id);
    }

    public function build()
    {
        return $this->markdown('emails.appointments.booked')
		        ->subject("{$this->attendee->name} booked an appointment.");
    }
}
