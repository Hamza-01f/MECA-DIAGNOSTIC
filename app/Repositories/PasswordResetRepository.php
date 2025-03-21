<?php

// app/Repositories/PasswordResetRepository.php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRepository
{
    public function createResetToken($email)
    {
        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        return $token;
    }

    public function getResetDataByToken($token)
    {
        return DB::table('password_resets')->where('token', $token)->first();
    }

    public function updateUserPassword($email, $password)
    {
        $user = User::where('email', $email)->first();
        $user->update(['password' => bcrypt($password)]);
        DB::table('password_resets')->where('email', $email)->delete();
    }
}
