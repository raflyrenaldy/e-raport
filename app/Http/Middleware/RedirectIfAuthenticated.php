<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch(Auth::user()->roles_id)
            {
                case User::ADMIN :
                    return redirect('/admin/dashboard');
                break;
                case User::STUDENT :
                    return redirect('/student/dashboard');
                break;
                default :
                    return redirect('404page');
                break;
            }
        }

        return $next($request);
    }
}
