<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\DiagnosticsController;
use App\Http\Controllers\FacteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome');

// Public routes 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [PasswordResetController::class, 'showResetPassword'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/resetpassword/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/resetpassword', [PasswordResetController::class, 'updatePassword'])->name('password.update');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Error pages
Route::get('/forbidden', function(){
    return view('forbidden');
})->name('forbidden');

Route::get('/404', function(){
    return view('404');
})->name('404');

// Protected routes 
Route::middleware(['auth'])->group(function() {
    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Vehicules
    Route::prefix('vehicules')->group(function () {
        Route::get('/', [VehiculeController::class, 'index'])->name('vehicules.index');
        Route::get('/create', [VehiculeController::class, 'create'])->name('vehicules.create');
        Route::post('/', [VehiculeController::class, 'store'])->name('vehicules.store');
        Route::get('/{vehicule}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
        Route::put('/{vehicule}', [VehiculeController::class, 'update'])->name('vehicules.update');
        Route::delete('/{vehicule}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');
    });

    // Diagnostics
    Route::prefix('Diagnostics')->group(function () {
        Route::get('/', [DiagnosticsController::class, 'index'])->name('Diagnostics.index');
        Route::get('/create', [DiagnosticsController::class, 'create'])->name('Diagnostics.create');
        Route::post('/', [DiagnosticsController::class, 'store'])->name('Diagnostics.store');
        Route::get('/{diagnostic}/edit', [DiagnosticsController::class, 'edit'])->name('Diagnostics.edit');
        Route::put('/Diagnostics/{diagnostic}', [DiagnosticsController::class, 'update'])->name('Diagnostics.update');
        Route::delete('/{diagnostic}', [DiagnosticsController::class, 'destroy'])->name('Diagnostics.destroy');
        Route::get('/generate-pdf/{diagnostic}', [DiagnosticsController::class, 'generatePdf'])->name('diagnostics.generate-pdf');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';