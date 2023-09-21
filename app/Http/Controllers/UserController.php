<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function get(User $user)
    {
        return response()->json([
            'error' => null,
            'result' => $user
        ]);
    }
}
