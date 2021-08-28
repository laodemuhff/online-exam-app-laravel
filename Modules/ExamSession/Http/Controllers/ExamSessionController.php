<?php

namespace Modules\ExamSession\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Exam;
use App\Models\ExamBaseQuestion;
use App\Models\Question;
use App\Models\Option;
use App\Models\ExamSession;
use App\Models\ExamSessionQuestion;
use App\Models\ExamSessionOption;
use App\Models\ExamSessionBaseQuestion;
use App\Models\ExamSessionUserEnroll;
use App\Models\ExamSessionAnswer;
use App\Jobs\SendEmail;
use Cache;
use Carbon;
use Auth;
use DB;

class ExamSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($status)
    {
        $data['exam_sessions'] = ExamSession::with('exam', 'examSessionUserEnrolls')->where('exam_session_status', $status)->orderBy('created_at', 'desc')->get();
        $data['status'] = str_replace(' ', '-', strtolower($status));

        return view('examsession::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['exams'] = Exam::all();
        return view('examsession::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */

    public function determineExamSimilarityValue(){
        return 0;
    }

    public function generateUserExamSessionCode($user_type, $rand = 3){
        do{
            $rand_number = '';
            for ($i=0; $i < $rand; $i++) {
                $rand_number .= rand(0,9);
            }

            $user_session = $user_type.'-'.$rand_number;

        }while((ExamSessionUserEnroll::where('user_session_code', $user_session)->first()));

        return $user_session;
    }

    public function generateExamSessionCode($rand = 3){
        do{
            $rand_number = '';
            for ($i=0; $i < $rand; $i++) {
                $rand_number .= rand(0,9);
            }

            $exam_session = 'exam'.$rand_number;

        }while((ExamSession::where('exam_session_code', $exam_session)->first()));

        return $exam_session;
    }

    public function copyExamBaseQuestion($id_exam, $id_exam_session){
        try {
            $id_questions = ExamBaseQuestion::where('id_exam', $id_exam)->get()->map(function($item){
                return $item->id_question;
            });

            // create exam session question
            foreach($id_questions as $id_question){
                $question = Question::find($id_question);

                if($question){
                    $exam_session_question = ExamSessionQuestion::create([
                        "question_description" => $question->question_description,
                        "type" => $question->type,
                        "use_default_correct_point" => $question->use_default_correct_point,
                        "use_default_wrong_point" => $question->use_default_wrong_point,
                        "correct_point" => $question->correct_point,
                        "wrong_point" => $question->wrong_point
                    ]);

                    if($exam_session_question){
                        // create exam option if exist
                        $options = Option::where('id_question', $id_question)->get();
                        foreach($options as $option){
                            ExamSessionOption::create([
                                'id_exam_session_question' => $exam_session_question->id,
                                'option_label' => $option->option_label,
                                'option_description' => $option->option_description,
                                'answer_status' => $option->answer_status
                            ]);
                        }

                        //create exam session base question
                        ExamSessionBaseQuestion::create([
                            'id_exam_session' => $id_exam_session,
                            'id_exam_session_question' => $exam_session_question->id,
                            'question_validity' => 'Valid'
                        ]);
                    }
                }
            }

            return true;
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return false;
        }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $post = $request->except('_token');

        $post['exam_session_code'] = Self::generateExamSessionCode(4);

        if(isset($post['start_anytime'])){
            unset($post['start_anytime']);
            $post['exam_datetime'] = isset($post['exam_datetime']) ? date('Y-m-d H:i', strtotime($post['exam_datetime'])) : null;
        }

        if(isset($post['end_anytime'])){
            unset($post['end_anytime']);
        }

        if(isset($post['unbound_registration'])){
            unset($post['unbound_registration']);
        }

        if(isset($post['allow_scrambled_questions'])){
            $post['allow_scrambled_questions'] = '1';
        }

        if(isset($post['allow_scrambled_options'])){
            $post['allow_scrambled_options'] = '1';
        }

        if(isset($post['disallow_multiple_login'])){
            $post['disallow_multiple_login'] = '1';
        }

        if(isset($post['disallow_navigation'])){
            $post['disallow_navigation'] = '1';
        }

        if(isset($post['check_on_exam_similarity'])){
            $post['check_on_exam_similarity'] = '1';
            $post['exam_similarity_value'] = Self::determineExamSimilarityValue();
        }

        $create_session = ExamSession::create($post);

        if($create_session){
            // create the copy of questions, options, and exam base questions
            $copyExam = Self::copyExamBaseQuestion($post['id_exam'], $create_session->id);

            if($copyExam){
                DB::commit();
                return redirect()->route('exam-session', 'Pending')->with('success', ['Exam Session berhasil ditambahkan']);
            }
        }

        DB::rollback();
        return redirect()->back()->withErrors(['Exam Session gagal ditambahkan'])->withInput();

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('examsession::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data['exam_session'] = ExamSession::where('id', $id)->first();
        $data['exams'] = Exam::all();

        return view('examsession::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');


        if(isset($post['start_anytime'])){
            unset($post['start_anytime']);
            $post['exam_datetime'] = isset($post['exam_datetime']) ? date('Y-m-d H:i', strtotime($post['exam_datetime'])) : null;
        }else{
            $post['exam_datetime'] = null;
        }

        if(isset($post['end_anytime'])){
            unset($post['end_anytime']);
        }else{
            $post['exam_duration'] = null;
        }

        if(isset($post['unbound_registration'])){
            unset($post['unbound_registration']);
        }else{
            $post['register_duration'] = null;
        }


        $post['allow_scrambled_questions'] =  isset($post['allow_scrambled_questions']) ? '1' : '0';
        $post['allow_scrambled_options'] = isset($post['allow_scrambled_options']) ? '1' : '0';
        $post['disallow_multiple_login'] = isset($post['disallow_multiple_login']) ? '1' : '0';
        $post['disallow_navigation'] = isset($post['disallow_navigation']) ? '1' : '0';
        $post['check_on_exam_similarity'] = isset($post['check_on_exam_similarity']) ? '1' : '0';
        $post['exam_similarity_value'] = isset($post['check_on_exam_similarity']) ? Self::determineExamSimilarityValue() : '0';


        $update_session = ExamSession::where('id',$id)->update($post);

        if($update_session){
            return redirect()->back()->with('success', ['Exam Session berhasil diupdate']);
        }

        return redirect()->back()->withErrors(['Exam Session gagal diupdate'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $exam_session_base_question = ExamSessionBaseQuestion::where('id_exam_session', $id)->get();

        foreach($exam_session_base_question as $value){
            ExamSessionQuestion::where('id', $value->id_exam_session_question)->delete();
        }

        return ExamSession::where('id', $id)->delete();
    }

    public function startSession($id){
        $update = ExamSession::where('id', $id)->update([
            'exam_session_status' => 'On Going',
            'started_on_going_at' => date('Y-m-d H:i:s'),
            'started_by' => Auth::user()->id
        ]);

        if($update){
            $user_enrolls = ExamSessionUserEnroll::with(['user', 'examSession.exam'])->where('id_exam_session', $id)->get();

            foreach($user_enrolls as $enroll){
                $type = 'EN';
                if($enroll['user']->level == 'instructor'){
                    $type = 'INS';
                }
                $generated_user_session_code = Self::generateUserExamSessionCode($type, 4);
                $update_user_enroll = ExamSessionUserEnroll::where('id', $enroll->id)->update(['user_session_code' => $generated_user_session_code]);

                $details = ['enroll' => $enroll, 'session_code' => $generated_user_session_code];
                SendEmail::dispatch($details);
            }

            return redirect()->back()->with('success',['Exam Session Started At :'.date('Y-m-d H:i:s')]);
        }

        return redirect()->back()->withErrors(['Exam Session failed to start']);
    }

    public function endSession($id){
        $update = ExamSession::where('id', $id)->update([
            'exam_session_status' => 'Terminated',
            'registration_status' => 'expired'
        ]);

        if($update){
            $user_enrolls = ExamSessionUserEnroll::with('user')->where('id_exam_session', $id)->get();

            foreach($user_enrolls as $key => $enroll){
                if(strpos($enroll->user_session_code, 'EN-') !== false){
                    $exam_answer = ExamSessionAnswer::where('user_session_code', $enroll->user_session_code)->first();

                    if(Cache::has('questions'.$enroll->user_session_code)){
                        Cache::forget('questions'.$enroll->user_session_code);
                    }

                    $update_user_enroll = ExamSessionUserEnroll::where('is_registered', 1)->where('id', $enroll->id)->update([
                        'is_registered' => 0,
                        'is_cached' => 0,
                        'is_submitted' => 1,
                        'final_score' => $exam_answer['final_score'] ?? null,
                        'final_score_status' => 'Ready to evaluate'
                    ]);
                }
            }

            return redirect()->back()->with('success',['Exam Session Ended At :'.date('Y-m-d H:i:s')]);
        }

        return redirect()->back()->withErrors(['Exam Session failed to end']);
    }

    public function cekAndUpdateExamSession($id_user){
        $data = ExamSessionUserEnroll::with('exam_session')->where('id_user', $id_user)->first();

        if(!empty($data['exam_session']['exam_datetime'])){
            if(strtotime($data['exam_session']['exam_datetime']) < strtotime(date('Y-m-d H:i:s'))){
                ExamSession::where('id', $data['id_exam_session'])->update([
                    'exam_session_status' => 'Terminated',
                    'registration_status' => 'expired'
                ]);
            }
        }
    }

    public function submitEnrollment($id_exam_session){
        ExamSession::where('id', $id_exam_session)->update([
            'enrollment_status' => 1
        ]);

        return redirect()->route('exam-session', 'Pending');
    }
}
