<?php

namespace App\Http\Middleware;

use Closure;

class ValidateSession
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
        if(session()->has('access_token'))
            return $next($request);
        else
            return redirect('login')->withErrors('Please login.');
    }
}
