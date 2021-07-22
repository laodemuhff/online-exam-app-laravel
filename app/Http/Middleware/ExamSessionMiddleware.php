<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamSessionUserEnroll;
use App\Models\ExamSession;
use App\Models\ExamSessionAnswer;

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
        // cek apakah apakah session masih berjalan skrg dan user mencoba menakses home exam, kalau iya alihkan ke sesi ujian tersebut
        if (session()->has('registered_exam_session')) {
            // kalau user belum submit
            if($request->route()->uri == 'doexam/home'){
                return redirect()->route('show-session');
            }

            // sblm alihkan ke session, cek dulu apakah sesi ujian sudah Terminated
            $status = ExamSession::where('id', session('registered_exam_session'))->first()['exam_session_status'];
            if($status == 'Terminated'){
                session()->forget('registered_exam_session');

                return redirect()->route('home')->withErrors('You\'re not registered to any session');
            }

            // nah, ini baru alihkan ke session yg sdh berlangsung
            return $next($request);
        }

        // ini kalau logout di tengah2 sesi ujian, terus mau login lagi
        // jika ada session yang sudah teregistrasi maka alihkan lansgsung ke session tersebut
        if($exam_session = ExamSessionUserEnroll::where('id_user', auth()->user()->id)->where('is_registered', 1)->where('is_submitted', 0)->first()){
            session([
                'registered_exam_session' => $exam_session['id_exam_session']
            ]);

            return redirect()->route('show-session');
        }

        // kalau urlnya home dan sesi blm terdaftar masuk ke home
        if($request->route()->uri == 'doexam/home'){
            return $next($request);
        }

        // kalau sesi blm terdaftar dan user mencoba akses sesi ujian
        return redirect()->route('home')->withErrors('You\'re not registered to any session');
    }
}
