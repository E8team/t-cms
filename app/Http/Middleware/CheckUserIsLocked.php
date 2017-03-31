<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CheckUserIsLocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_locked) {
            //todo 国际化
            throw new AuthorizationException('您的账号已被锁定!');
        }
        return $next($request);
    }
}
