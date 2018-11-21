<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Appointment;
use Carbon\Carbon;

Route::post('/upload-csv', function (Request $request) {
	$filePath = $request->file('csv')->getRealPath();
	$csvData = file_get_contents($filePath);
	$data = explode(PHP_EOL, trim($csvData));
	$res = [];

	for ($i = 1; $i < count($data); $i++) {
		$row = explode(',', $data[$i]);
		$res[] = Appointment::create([
			'starts_at' => Carbon::createFromFormat('j/n/Y H:i', trim($row[0])),
			'ends_at' => Carbon::createFromFormat('j/n/Y H:i', trim($row[1]))
		]);
	}

    return $res;
});
