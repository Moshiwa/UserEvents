<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

            $user = Auth::user();

            $token = $user->createToken('MyApp')->plainTextToken;
            $user->token = $token;
            $user->save();

            return redirect()->intended('/')->with(['Auth' => $token]);
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

        $user = User::query()->create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'login' => $request->login,
            'password' => bcrypt($request->password),
            'registration_date' => now()
        ]);

        return redirect('login');
    }
}
