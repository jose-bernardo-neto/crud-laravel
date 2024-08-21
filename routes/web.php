<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/',[EventController::class,'index'])->name('events.index');
Route::get('/events/create',[EventController::class, 'create'])->name('events.create');
Route::get('/events/{id}',[EventController::class, 'show'])->name('events.show');
Route::post('/events',[EventController::class,'store'])->name('events.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
