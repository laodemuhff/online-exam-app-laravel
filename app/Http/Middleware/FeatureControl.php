<?php

namespace App\Http\Middleware;

use Closure;

class FeatureControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $feature)
    {
        if(session('level') == 'admin')
            return $next($request);

        $granted = session('granted_features') ?? [];
        if(in_array($feature, $granted))
            return $next($request);
        else {
            $request->session()->put('errors', ['You don\'t have access to this page. Please contact Super Admin']);
            return redirect('/');
        }
    }
}
