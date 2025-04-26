<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function createUser(array $data);
    public function attemptLogin(array $credentials);
    public function logout();
}