<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DataProyekComponent;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import-data', [DataProyekController::class, 'importData'])->name('importData');

