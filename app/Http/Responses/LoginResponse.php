<?php

namespace App\Http\Responses;

use App\Repositories\UserRepository;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // generate new token
        $user = $request->user();
        $token = UserRepository::createToken($user);

        $result = [
            'two_factor' => false,
            'token' => $token,
            'user' => $user
        ];
        return $request->wantsJson()
            ? response()->json($result)
            : redirect()->intended(config('fortify.home'));
    }
}
