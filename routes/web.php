<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\GarbageTypeController;
use App\Http\Controllers\CollectionController;

//Root route redirects
Route::get('/', function () {
    return view('collections');
})->middleware('setup');

//Why would you type index in the URL? Well, I got that covered too.
Route::redirect('/index', '/collections');

Route::resource('days', DayController::class);

Route::resource('collections', CollectionController::class);

Route::resource('garbagetype', GarbageTypeController::class);