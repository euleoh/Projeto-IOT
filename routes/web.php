<?php

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::resource('ambientes', AmbienteController::class)->except('show');
Route::resource('sensores', SensorController::class)->except('show')->parameters(['sensores' => 'sensor']);
