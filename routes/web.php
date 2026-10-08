<?php

use App\Livewire\Ambiente\AmbienteCreate;
use App\Livewire\Ambiente\AmbienteEdit;
use App\Livewire\Ambiente\AmbienteIndex;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Sensor\SensorCreate;
use App\Livewire\Sensor\SensorEdit;
use App\Livewire\Sensor\SensorIndex;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', Dashboard::class);

Route::get('ambiente/create', AmbienteCreate::class)->name('ambiente.create');

Route::get('ambiente/index', AmbienteIndex::class)->name('ambiente.index');

Route::get('ambiente/edit/{id}', AmbienteEdit::class)->name('ambiente.edit');

Route::get('sensor/create', SensorCreate::class)->name('sensor.create');

Route::get('sensor/index', SensorIndex::class)->name('sensor.index');

Route::get('sensor/edit/{id}', SensorEdit::class)->name('sensor.edit');
