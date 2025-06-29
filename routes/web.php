<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('/welcome');
})->name('welcome')->middleware('guest');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
Route::resource('users', UserController::class)->middleware('isAdmin');
Route::post('user-update-role', [UserController::class, 'updateRole'])->name('users.update-role');