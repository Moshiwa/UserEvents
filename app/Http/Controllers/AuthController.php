<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect('register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register(Request $request)
    {
        User::query()->create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'login' => $request->login,
            'password' => bcrypt($request->password)
        ]);
    }
}
