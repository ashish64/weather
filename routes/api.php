<?php

use App\Http\Controllers\Api\v1\WeatherLookUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeatherLookUpController::class, 'index']);
