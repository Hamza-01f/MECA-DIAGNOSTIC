<?php


// app/Repositories/PasswordResetRepositoryInterface.php
namespace App\Repositories;

interface PasswordResetRepositoryInterface
{
    public function createResetToken($email);
    public function getResetDataByToken($token);
    public function updateUserPassword($email, $password);
}

