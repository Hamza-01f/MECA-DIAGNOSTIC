<?php

// app/Repositories/AuthRepositoryInterface.php
namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function register($data);
    public function login($credentials);
    public function logout();
}
