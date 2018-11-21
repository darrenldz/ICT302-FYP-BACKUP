<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const Roles = ['attendee', 'organiser', 'convenor'];

    protected $fillable = [
        'email', 'first_name', 'last_name', 'role', 'password'
    ];

    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];

	function setPasswordAttribute($input)
	{
		if ($input) $this->attributes['password'] = \Hash::make($input);
	}

    function getNameAttribute()
    {
        return implode(' ', [$this->first_name, $this->last_name]);
    }

    function appointments()
    {
        return $this->hasMany(Appointment::class, 'attendee_id');
    }

    function isAdmin()
    {
        return in_array($this->role, ['organiser', 'convenor']);
    }
}
