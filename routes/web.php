<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/allusers', function(){
	return view('pages.allusers');
})->name('allusers');
Route::get('/adduser', function(){
	return view('pages.adduser');
})->name('adduser');