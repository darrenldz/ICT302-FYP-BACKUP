<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Appointment;

class RejectAppointment extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each->reject();
    }

    public function fields()
    {
        return [];
    }
}
