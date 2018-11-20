<?php

use Illuminate\Database\Seeder;
use App\{User, Location, Appointment};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->users();
        $this->appointments();
    }

    private function users() {
    	User::truncate();
        factory(User::class)->create([
            'role' => 'convenor', 
            'email' => 'admin@gmail.com', 
        ]);
        factory(User::class)->create([
            'role' => 'organiser',
            'email' => 'ldz092@gmail.com'
        ]);
		factory(User::class)->create([
            'role' => 'attendee',
            'email' => 'darrenonce@gmail.com'
        ]);
		factory(User::class, 5)->create(['role' => 'attendee']);
    }

    private function appointments() {
        $faker = resolve('Faker\Generator');
        Appointment::truncate();
        factory(Appointment::class, 5)->create();
        for ($i=0;$i<5;$i++) factory(Appointment::class)->create([
            'attendee_id' => null,
            'status' => Appointment::Statuses[0],
            'starts_at' => $datetime = Carbon::instance($faker->dateTimeBetween('now', '+6 months')),
            'ends_at' => (clone $datetime)->addMinutes(30)
        ]);
    }
}
