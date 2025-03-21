<?php


// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\PasswordResetRepository;
use App\Repositories\PasswordResetRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind interfaces to their implementations
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);
    }
}

