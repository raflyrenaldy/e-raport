<?php

namespace App\Http\Middleware;

use Closure;

class AccessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles_id = null)
    {
        if ($request->user()->roles_id == $roles_id) {
            return $next($request);
        }
        else {
            return response(view('error'));
        }
    }
}
