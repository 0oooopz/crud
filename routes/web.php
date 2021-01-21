<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsersController;
Route::get('/', function () {
    return view('home');
})->name('home');

//Route::group(['prefix'=>'users', 'as' =>'users'],function(){
//	Route::get('/all',[UsersController::class,'index'])->name('index');
//	Route::get('/add',[UsersController::class, 'create'])->name('create');
//	Route::get('/{user}',[UsersController::class,'show'])->name('show');
//});

Route::resource('/users',UsersController::class);