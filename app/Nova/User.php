<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\{Text, Gravatar, Password, Select, HasMany};
use App\User as AppUser;

class User extends Resource
{
    public static $model = 'App\\User';

    public static $title = 'first_name';

    public static $search = [
        'id', 'role', 'first_name', 'last_name', 'email',
    ];

    public static function availableForNavigation(Request $request)
    {
        return array_search(auth()->user()->role, AppUser::Roles) >= 2; 
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Select::make('Role')->options([
                collect(AppUser::Roles)->mapWithKeys(function($v){ return [$v => $v]; })
            ]),

            Text::make('First Name')
                ->sortable()
                ->rules('required', 'max:100'),

            Text::make('Last Name')
                ->sortable()
                ->rules('required', 'max:100'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:100')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            HasMany::make('Appointments'),
        ];
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
        return [];
    }
}
