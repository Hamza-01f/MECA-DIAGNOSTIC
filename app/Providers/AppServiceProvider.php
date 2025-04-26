<?php


// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\ClientRepository;

class AppServiceProvider extends ServiceProvider
{

    public function register(){

        $this->app->bind(
                         AuthRepositoryInterface::class,
                         AuthRepository::class
                        );

        $this->app->bind(
                            ClientRepositoryInterface::class,
                            ClientRepository::class
                        );
    }



    public function boot(){

    }
}

