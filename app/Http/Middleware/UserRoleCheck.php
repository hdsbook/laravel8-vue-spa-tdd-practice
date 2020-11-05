<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRepo = new UserRepository(auth()->user());
        return $userRepo->isRole($role)
            ? $next($request)
            : redirect('unauthorized');
    }
}
