<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/sensor/latest', function () {
    return response()->json(
        \App\Models\SensorData::latest()->first()
    );
});