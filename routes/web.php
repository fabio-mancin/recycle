<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\Garbage_TypeController;
use App\Http\Controllers\CollectionController;

//Root route redirects
Route::get('/', function () {
    return view('index');
})->middleware('setup');

//Why would you type index into the URL? Well, I got that covered too.
Route::redirect('/index', '/collections');

Route::resource('days', DayController::class);

Route::resource('garbage_type', Garbage_TypeController::class);

Route::resource('collections', CollectionController::class);