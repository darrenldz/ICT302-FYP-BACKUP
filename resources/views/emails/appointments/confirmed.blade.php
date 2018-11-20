@component('mail::message')
# Appointment Confirmed

Hi {{ $attendee->name }},

Your appointment below is confirmed.

<center>
	<strong>
		{{ $apmt->starts_at->format('d M Y') }}: {{ $apmt->starts_at->format('H:i') }} - {{ $apmt->ends_at->format('H:i') }}
	</strong>
</center>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
