@component('mail::message')
# Appointment Booking

Hi {{ $organiser->name }},

{{ $attendee->name }} has booked an appointment on:

<center>
	<strong>
		{{ $apmt->starts_at->format('d M Y') }}: {{ $apmt->starts_at->format('H:i') }} - {{ $apmt->ends_at->format('H:i') }}
	</strong>
</center>

@component('mail::button', ['url' => url('/admin/resources/appointments')])
Manage Appointments
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
