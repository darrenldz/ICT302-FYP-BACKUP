<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Appointment::class, function (Faker $faker) {
    return [
		'attendee_id' => App\User::inRandomOrder()->first()->id,
		'starts_at' => $datetime = Carbon::instance($faker->dateTimeThisYear('2018-10-01')),
		'ends_at' => (clone $datetime)->addMinutes(30),
		'status' => \App\Appointment::Statuses[2],
    ];
});
