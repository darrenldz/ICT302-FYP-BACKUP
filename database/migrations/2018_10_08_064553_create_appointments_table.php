<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendee_id')->unsigned()->nullable();
            $table->datetime('starts_at');
            $table->datetime('ends_at');
            $table->enum('status', \App\Appointment::Statuses)
                ->default('Available');
            $table->timestamps();

            $table->foreign('attendee_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
