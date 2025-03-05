<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\DiagnosticsController;
use App\Http\Controllers\FacteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;




Route::view('/', 'welcome');

Route::resource('Clients',ClientController::class);
Route::resource('Services',ServiceController::class);
Route::resource('Vehicule',VehiculeController::class);
Route::resource('Diagnostics',DiagnosticsController::class);
Route::resource('Facteur',FacteurController::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Password Reset Routes
Route::get('/forgot-password', [PasswordResetController::class, 'showResetPassword'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/resetpassword/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/resetpassword', [PasswordResetController::class, 'updatePassword'])->name('password.update');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
