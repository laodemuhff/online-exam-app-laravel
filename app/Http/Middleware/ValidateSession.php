<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ExamSession;
use App\Models\ExamSessionUserEnroll;
use Modules\ExamSession\Http\Controllers\ExamSessionController;

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
        date_default_timezone_set("Asia/Jakarta");

        if(session()->has('access_token')){
            Self::handleOecp1();
            Self::handleOecp2();
            Self::handleOecp5();

            $counter_pending = ExamSession::where('exam_session_status', 'Pending')->count();
            $counter_on_going = ExamSession::where('exam_session_status', 'On Going')->count();

            session([
                'counter_pending' => $counter_pending,
                'counter_on_going' => $counter_on_going
            ]);

            return $next($request);
        }
        else
            return redirect('login')->withErrors('Please login.');
    }

    public function handleOecp1(){
        $exam_session = ExamSession::with('examSessionUserEnrolls')->where('exam_session_status', 'Pending')->where('exam_datetime', '!=', null)->where('exam_datetime', '<=', date('Y-m-d H:i:s'))->get();
        // dd($exam_session);
        foreach($exam_session as $key => $item)
        {
            $is_entry_exist = false;
            $is_instructor_exist = false;

            foreach($item['examSessionUserEnrolls'] as $key2 => $user_enroll)
            {
                if($user_enroll['user_type'] == 'entry')
                {
                    $is_entry_exist = true;
                }

                if($user_enroll['user_type'] == 'instructor')
                {
                    $is_instructor_exist = true;
                }
            }

            if($is_entry_exist && $is_instructor_exist){
                $update = ExamSession::where('id', $item['id'])->update([
                    'exam_session_status' => 'On Going'
                ]);

                if($update){
                    $user_enrolls = ExamSessionUserEnroll::with('user')->where('id_exam_session', $item['id'])->get();

                    foreach($user_enrolls as $enroll){
                        $type = 'EN';
                        if($enroll['user']->level == 'instructor'){
                            $type = 'INS';
                        }

                        $update_user_enroll = ExamSessionUserEnroll::where('id', $enroll->id)->update(['user_session_code' => (new ExamSessionController)->generateUserExamSessionCode($type, 4)]);
                    }
                }
            }
        }
    }

    public function handleOecp2(){
        $exam_session = ExamSession::with('examSessionUserEnrolls')->where('exam_session_status', 'On Going')->whereNull('registration_status')->whereNotNull('register_duration')->get();

        foreach($exam_session as $key => $item){
            $start_at = $item['exam_datetime'];

            if(!empty($item['started_on_going_at'])){
                $start_at = $item['started_on_going_at'];
            }

            $expired_at = date('Y-m-d H:i:s', strtotime('+'.$item['register_duration'].' minutes', strtotime($start_at)));

            if(strtotime(date('Y-m-d H:i:s')) >= strtotime($expired_at)){
                ExamSession::where('id', $item['id'])->update([
                    'registration_status' => 'expired'
                ]);
            }
        }
    }

    public function handleOecp5(){
        $exam_session = ExamSession::where('exam_session_status', 'On Going')->get();

        foreach($exam_session as $key => $item){
            $start_at = $item['exam_datetime'];

            if(!empty($item['started_on_going_at'])){
                $start_at = $item['started_on_going_at'];
            }

            $exam_end_at = date('Y-m-d H:i:s', strtotime('+'.$item['exam_duration'].' minutes', strtotime($start_at)));

            if(strtotime(date('Y-m-d H:i:s')) >= strtotime($exam_end_at)){
                ExamSession::where('id', $item['id'])->update([
                    'exam_session_status' => 'Terminated',
                    'registration_status' => 'expired'
                ]);
            }
        }
    }
}
