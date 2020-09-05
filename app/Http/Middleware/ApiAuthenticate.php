<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Traits\Unauthorised;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticate
{
    use Unauthorised;

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userToken = $request->header('User-Token');

        if (!$userToken) {
            return $this->handleError();
        }

        Auth::setUser(User::findByToken($userToken));

        return $next($request);
    }
}
