<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Service\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;


class ApiAuth
{
    public function handle(Request $request, Closure $next)
    {

        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();
        if ($user) {
            auth()->login($user);
            return $next($request);
        }

        return response([
            'message' => 'Unauthenticated'
        ], 403);
    }
}
