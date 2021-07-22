<?php

namespace Modules\DoExam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\ExamSessionUserEnroll;
use App\Models\ExamSession;
use App\Models\ExamSessionAnswer;
use Auth;
use Validator;

class DoExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $id_user = Auth::user()->id;

        $data['exam_session'] = ExamSessionUserEnroll::with(['examSession' => function($query){$query->with('exam');}])->where('id_user', $id_user)->where('is_submitted', 0)->get();
        // dd($data);
        return view('doexam::index', $data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function registerSession(Request $r)
    {
        $post = $r->all();

        // cek if register session is expired
        $exam_session = ExamSession::where('id', $post['id_exam_session'])->where('registration_status', 'expired')->first();

        if($exam_session){
            return redirect()->back()->withErrors('Register Session is Ended');
        }

        $session_user_enroll = ExamSessionUserEnroll::where('id_user', $post['id_user'])->where('id_exam_session', $post['id_exam_session'])->where('user_session_code', $post['user_session_code'])->where('is_registered',0);

        if($session_user_enroll->exists()){
            $session_user_enroll->update([
                'is_registered' => 1
            ]);

            session([
                'registered_exam_session' => $post['id_exam_session']
            ]);

            return redirect()->route('show-session');
        }

        return redirect()->back()->withErrors('Pendaftaran Gagal !');
    }

    public function showSession(Request $request)
    {
        // protect by middleware
        $id_exam_session = $request->session()->get('registered_exam_session');

        $raw_data = ExamSessionUserEnroll::with([
            'examSession' => function($query){
                $query->with(['exam' => function($query){
                    $query->with(['examBaseQuestions' => function($query){
                        $query->with(['question' => function($query){
                            $query->with('options');
                        }])->where('question_validity','Valid');
                    }]);
                }]);
            }
        ])->where('id_user', auth()->user()->id)->where('id_exam_session', $id_exam_session)->get()->toArray();


        $data['questions'] = $raw_data[0]['exam_session']['exam']['exam_base_questions'];
        $data['current_active_nav'] = $raw_data[0]['current_active_nav'];
        $data['setting'] =$raw_data[0]['exam_session'];
        $data['user_session_code'] = $raw_data[0]['user_session_code'];
        $data['setting']['subject'] = $data['setting']['exam']['exam_title'];
        $data['history_answer'] = ExamSessionAnswer::where('user_session_code', $data['user_session_code'])->get()->toArray();

        foreach ($data['questions'] as $key => $value) {
            $answer = null;
            foreach ( $data['history_answer']  as $key2 => $value2) {
                if($value2['id_question'] == $value['question']['id']){
                    if($value['question']['type'] == 'multiple_choice')
                        $answer = $value2['multiple_choice_answer'];
                    else
                        $answer = $value2['essay_answer'];
                    break;
                }
            }
            $data['questions'][$key]['question']['answer'] = $answer;
        }

        unset($data['setting']['exam']);

        // acak urutan soal dan jawaban/options saat register pertama kali
        $exam_user_enroll = ExamSessionUserEnroll::where('user_session_code', $data['user_session_code']);
        if(!$exam_user_enroll->first()['is_cached']){
            // if question answer not yet cached
            Cache::put('questions'.$data['user_session_code'], Self::handleOecp3($data['questions'], $data['setting']));
            $exam_user_enroll->update([
                'is_cached' => 1
            ]);
        }else{
            // if already cached
            // cek for updated answer
            $cached_question = Cache::get('questions'.$data['user_session_code']);
            $exam_answer = ExamSessionAnswer::where('user_session_code', $data['user_session_code'])->get()->map(function($item){
                return [
                    'id_question' => $item['id_question'],
                    'multiple_choice_answer' => $item['multiple_choice_answer'],
                    'essay_answer' => $item['essay_answer']
                ];
            });

            $qs = [];
            foreach($exam_answer as $key => $item){
                if(!empty($item['multiple_choice_answer']))
                    $qs[$item['id_question']] = $item['multiple_choice_answer'];
                else
                    $qs[$item['id_question']] = $item['essay_answer'];
            }

            foreach($cached_question as $key => $item){
                if(in_array($item['question']['id'], array_keys($qs))){
                    $cached_question[$key]['question']['answer'] = $qs[$item['question']['id']];
                }
            }

            Cache::put('questions'.$data['user_session_code'], $cached_question);
        }

        return view('doexam::session', $data);
    }

    public function checkExamBeforeSubmit(Request $r){
        if(ExamSession::where('exam_session_code', $r->exam_session_code)->first()['exam_session_status'] == 'Terminated'){
            return response()->json(['status' => 'fail']);
        }else{
            return response()->json(['status' => 'success']);
        }
    }

    public function submitExam(Request $r){

        $exam_answer = ExamSessionAnswer::where('user_session_code', $r->user_session_code)->first();
        $exam = ExamSessionUserEnroll::with('examSession.exam')->where('user_session_code',  $r->user_session_code)->first()->examSession->exam->exam_title ?? null;

        ExamSessionUserEnroll::where('user_session_code', $r->user_session_code)->update([
            'is_registered' => 0,
            'is_cached' => 0,
            'is_submitted' => 1,
            'final_score' => $exam_answer['final_score'],
            'final_score_status' => 'Ready to evaluate'
        ]);

        if(session()->has('registered_exam_session'))
            session()->forget('registered_exam_session');

        if(Cache::has('questions'.$r->user_session_code)){
            Cache::forget('questions'.$r->user_session_code);
        }

        $summary = [
            'final_score' => $exam_answer['final_score'],
            'right_answer' => $exam_answer['right_answer'],
            'wrong_answer' => $exam_answer['wrong_answer'],
            'exam' => $exam
        ];

        return view('doexam::review_session', $summary);
    }

    public function handleOecp3($questions, $setting)
    {
        $shuffled_questions = $questions;

        if($setting['allow_scrambled_questions']){
            $shuffled_questions = array();
            $indexes = array();
            $real_indexes = array();

            for($i = 0; $i < sizeof($questions); $i++){
                $indexes['i_'.$i] = mt_rand() / mt_getrandmax();
            }

            asort($indexes);

            foreach($indexes as $key => $item){
                $real_indexes[] = (int) explode('_', $key)[1];
            }

            foreach($real_indexes as $value)
            {
                $shuffled_questions[] = $questions[$value];
            }
        }

        if($setting['allow_scrambled_options']){

            foreach($shuffled_questions as $key => $item){

                if($item['question']['type'] == 'multiple_choice')
                {
                    $shuffled_options = array();
                    $indexes = array();
                    $real_indexes = array();

                    foreach($item['question']['options'] as $key1 => $option){
                        $indexes['i_'.$key1] = mt_rand() / mt_getrandmax();
                    }

                    asort($indexes);

                    foreach($indexes as $key2 => $v){
                        $real_indexes[] = (int) explode('_', $key2)[1];
                    }

                    foreach($real_indexes as $value)
                    {
                        $shuffled_options[] = $item['question']['options'][$value];
                    }

                    // update label
                    $labels = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

                    foreach($shuffled_options as $key3 => $v){
                        $shuffled_options[$key3]['option_label'] = $labels[$key3];
                    }

                    $shuffled_questions[$key]['question']['options'] = $shuffled_options;
                }
            }

        }

        return $shuffled_questions;
    }
}
