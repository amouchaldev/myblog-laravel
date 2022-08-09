<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdminOrOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array(session()->get('loginRole'), ['admin', 'owner'])) {
            return $next($request);
        }
        else {
            return abort(404);
        }
    }
}
