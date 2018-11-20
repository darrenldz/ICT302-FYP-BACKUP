<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{Text, DateTime, Select, BelongsTo};
use App\Nova\Actions\{CancelAppointment, ConfirmAppointment};
use App\Appointment as AppAppointment;
use App\user as AppUser;

class Appointment extends Resource
{
    public static $model = 'App\\Appointment';

    public static $title = 'id';

    public static $search = [
        'id', 'starts_at', 'ends_at', 'status'
    ];

    public static $indexDefaultOrder = [
        'starts_at' => 'desc'
    ];

    public static function availableForNavigation(Request $request)
    {
        return array_search(auth()->user()->role, AppUser::Roles) >= 1; 
    }

    public function fields(Request $request)
    {
        return [
            DateTime::make('Starts At')
                ->sortable()
                ->rules('required'),

            DateTime::make('Ends At')
                ->sortable()
                ->rules('required'),

            Select::make('Status')
                ->options(
                    collect(AppAppointment::Statuses)
                        ->mapWithKeys(function($v){ return [$v => $v]; })
                )
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Attendee', 'attendee', 'App\Nova\User')->nullable()
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [new ConfirmAppointment(), new CancelAppointment()];
    }
}
