<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchAuthUser(Request $request)
    {
        $user = $request->user();
        $user->userRoles;

        $token = UserRepository::createToken($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
