<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{Appointment, User};

class AppointmentIsRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $apmt;
    public $attendee;
    public $organiser;

    public function __construct(Appointment $apmt)
    {
        $this->apmt = $apmt;
        $this->attendee = User::find($apmt->attendee_id);
    }

    public function build()
    {
        return $this->markdown('emails.appointments.rejected')
                ->subject("Your appointment has been rejected.");
    }
}
