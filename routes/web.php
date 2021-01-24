<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\SearchController;
Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/users',UsersController::class);

Route::get('/search', [SearchController::class,'search'])->name('search');