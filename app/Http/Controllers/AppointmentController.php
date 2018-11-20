<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AppointmentCollection;
use App\Appointment;

class AppointmentController extends Controller
{
    function index(Request $request)
    {
    	$apmts = Appointment::where(function($query){
    				if (request('filter') !== 'booked') 
    					$query->where(function($query){
	    					$query->whereNull('attendee_id')->available();
	    				});
    				$query->orWhere('attendee_id', auth()->id());
		    	})
		    	->where('starts_at', '>', now())
		    	->orderBy('starts_at', 'ASC')
		    	->get();

    	return view('appointments', [
    		'appointments' => (new AppointmentCollection($apmts))->toArray($request)
    	]);
    }

    function book(Appointment $apmt) {
        $apmt->book(auth()->id());
        return redirect()->back();
    }

    function cancel(Appointment $apmt) {
        $apmt->cancel();
        return redirect()->back();
    }
}
