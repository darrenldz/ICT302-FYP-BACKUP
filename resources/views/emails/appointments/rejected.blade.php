@component('mail::message')
# Appointment Cancelled

Hi {{ $attendee->name }},

Your appointment below is rejected.

<center>
	<strong>
		{{ $apmt->starts_at->format('d M Y') }}: {{ $apmt->starts_at->format('H:i') }} - {{ $apmt->ends_at->format('H:i') }}
	</strong>
</center>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
