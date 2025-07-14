<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HargaController;
use App\Models\Harga;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('/welcome');
})->name('welcome')->middleware('guest');

Auth::routes();

Route::get('/home', function () {
    $hargas = Harga::all();
    return view('home', compact('hargas'));
})->name('home')->middleware('auth');
Route::get('/my-transaksi',[TransaksiController::class,'myTransaction']);

// Admin
Route::resource('users', UserController::class)->middleware('isAdmin');
Route::post('user-update-role', [UserController::class, 'updateRole'])->name('users.update-role');
Route::put('/transaksi/{transaksi}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus')->middleware('isAdmin');
Route::get('/harga', function () {
    return view('harga.index');
})->name('harga')->middleware('auth');

// Masyarakat
Route::resource('profile', ProfileController::class);
Route::resource('transaksi', TransaksiController::class);
Route::post('/transaksi/upload-foto', [TransaksiController::class, 'uploadFoto'])->name('transaksi.upload-foto');

//Harga
Route::resource('harga', HargaController::class);

// Route::get('test', function(){
//     $kode = Transaksi::nomorTransaksi();
//     dd($kode);
// });