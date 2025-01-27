<?php

use App\Http\Controllers\CalenderController;
use App\Http\Controllers\CalenderViewController;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Route;



Route::get('/', [CalenderViewController::class, 'getCalender'])->name('calendar.view');
Route::get('/sportEvent/{id}', [CalenderViewController::class, 'showEvent'])->name('sport.event');

Route::post('/sportEvent', [SportController::class, 'createSportEvent'])->name('create.event');
Route::put('/update/{id}', [SportController::class, 'updateEvent'])->name('update.event');
