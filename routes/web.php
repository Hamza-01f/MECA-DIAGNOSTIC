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

// Route::middleware(['auth','admin'])->group(function(){

    // Route::resource('Clients',ClientController::class);
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    //service begins

    // Route::resource('Services',ServiceController::class);
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    //service ends

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

    Route::get('/forbidden', function(){
           return view('forbidden');
    })->name('forbidden');

    Route::get('/404', function(){
         return view('404');
    })->name('404');

// });

require __DIR__.'/auth.php';
