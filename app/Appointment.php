<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\AppointmentStatusUpdated;

class Appointment extends Model
{
	const Statuses = ['Available', 'Pending', 'Confirmed', 'Rejected'];

    protected $fillable = [
		'starts_at', 'ends_at', 'status', 'attendee_id'
    ];

    protected $dates = [
    	'starts_at', 'ends_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    function cancel() {
        $this->attendee_id = null;
        $this->status = self::Statuses[0];
        $this->save();
    }

    function book($attendee_id) {
        $this->attendee_id = $attendee_id;
        $this->status = self::Statuses[1];
        $this->save();
        event(new AppointmentStatusUpdated($this));
    }

    function confirm() {
        $this->status = self::Statuses[2];
        $this->save();
        event(new AppointmentStatusUpdated($this));
    }

    function reject() {
        $this->status = self::Statuses[3];
        $this->save();
        event(new AppointmentStatusUpdated($this));
    }

    function attendee() {
    	return $this->belongsTo(User::class);
    }

    function scopeAvailable($query)
    {
        return $query->where('status', self::Statuses[0]);
    }

    function scopePending($query)
    {
        return $query->where('status', self::Statuses[1]);
    }

    function scopeConfirmed($query)
    {
        return $query->where('status', self::Statuses[2]);
    }

    function scopeFuture($query)
    {
        return $query->where('starts_at', '>', now());
    }
}
