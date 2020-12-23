<?php

namespace App\Http\Middleware;

use Closure;

class EntryMiddleware
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
        if(session('level') == 'entry')
            return $next($request);
        else
            return redirect('login')->withErrors('Please login.');
    }
}
