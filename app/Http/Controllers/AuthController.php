<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;


class AuthController extends Controller
{
    protected $authRepository;


    public function __construct(AuthRepositoryInterface $authRepository){
       $this->authRepository = $authRepository;
    }

    public function showLogin()
    {
        return view('login');
    }


    public function showRegister()
    {
        return view('register');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authRepository->attemptLogin($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function register(RegisterRequest $request)
    {
        $this->authRepository->createUser($request->validated());
        return redirect()->route('login')->with('success', 'Compte créé avec succès.');
    }

    public function logout()
    {
        $this->authRepository->logout();
        return view('welcome');
    }
}
