<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/',[EventController::class,'index'])
 ->name('events.index');

Route::get('/events/create',[EventController::class, 'create'])
 ->middleware('auth')
 ->name('events.create');

Route::get('/events/{id}',[EventController::class, 'show'])->name('events.show');

Route::post('/events',[EventController::class,'store'])
 ->name('events.store');

Route::delete('/events/{id}',[EventController::class, 'destroy'])
 ->name('events.destroy');

Route::get('/events/edit/{id}',[EventController::class, 'edit'])
 ->middleware('auth')
 ->name('events.edit');

Route::put('events/update/{id}',[EventController::class, 'update'])
 ->middleware('auth')
 ->name('events.update');

Route::get('/dashboard', [EventController::class, 'dashboard'])
 ->middleware('auth')
 ->name('events.dashboard');

Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])
->middleware('auth');

Route::delete('/events/leave/{id}',[EventController::class,'leaveEvent'])
 ->middleware('auth');

 