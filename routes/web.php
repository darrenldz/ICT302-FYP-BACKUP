<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', function(){ return redirect()->route('appointments'); })->name('home');
	
	Route::get('/profile', 'ProfileController@index')->name('profile');
	
	Route::get('/appointments', 'AppointmentController@index')->name('appointments');

	Route::post('/appointments/{apmt}/book', 'AppointmentController@book');
	Route::post('/appointments/{apmt}/cancel', 'AppointmentController@cancel');
});
