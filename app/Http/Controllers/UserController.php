<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchAuthUser(Request $request)
    {
        $user = $request->user();
        $user->userRoles;

        $user->tokens()->delete();
        $token = $user->createToken('my-app-token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
