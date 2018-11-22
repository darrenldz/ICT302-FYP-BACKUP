<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'password' => \Hash::make('password'),
        'role' => $faker->randomElement(['attendee', 'organiser', 'convenor']),
    ];
});
