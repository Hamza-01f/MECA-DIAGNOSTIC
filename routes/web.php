<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\DiagnosticsController;
use App\Http\Controllers\FacteurController;
use App\Http\Controllers\AuthController;




// Route::view('/', 'dashboard');

Route::resource('Clients',ClientController::class);
Route::resource('Services',ServiceController::class);
Route::resource('Vehicule',VehiculeController::class);
Route::resource('Diagnostics',DiagnosticsController::class);
Route::resource('Facteur',FacteurController::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/resetpassword', [AuthController::class, 'showResetPassword'])->name('resetpassword');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
