<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('/welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', function () {
    return view('home');
});