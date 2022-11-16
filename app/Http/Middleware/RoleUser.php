<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (in_array($request->user($request->tokenCan($request->user_role)), $levels)) {
            return $next($request);
        }

        abort(400, 'Access denied');
    }
}
