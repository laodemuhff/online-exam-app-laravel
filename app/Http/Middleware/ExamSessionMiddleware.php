<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamSessionUserEnroll;

class ExamSessionMiddleware
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
        if (session()->has('registered_exam_session')) {
            if($request->route()->uri == 'doexam/home'){
                return redirect()->route('show-session');
            }
            return $next($request);
        }

        if($exam_session = ExamSessionUserEnroll::where('id_user', auth()->user()->id)->where('is_registered', 1)->first()){
            session([
                'registered_exam_session' => $exam_session['id_exam_session']
            ]);

            return redirect()->route('show-session');
        }

        if($request->route()->uri == 'doexam/home'){
            return $next($request);
        }

        return redirect()->route('home')->withErrors('You\'re not registered to any session');
    }
}
