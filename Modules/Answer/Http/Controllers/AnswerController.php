<?php

namespace Modules\Answer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\ExamSession;
use App\Models\ExamSessionAnswer;
use App\Models\ExamSessionUserEnroll;
use App\Models\ExamSessionQuestion;
use Modules\DoExam\Http\Controllers\DoExamController;

class AnswerController extends Controller
{
   public function saveAnswer(Request $r){

        try {
            if(ExamSession::where('exam_session_code', $r->exam_session_code)->first()['exam_session_status'] == 'Terminated'){
                return response()->json(['status' => 'fail']);
            }else{
                $question = ExamSessionQuestion::with('options')->where('id', $r->id_question)->first();

                $given_point = null;
                if($r->question_type == 'multiple_choice'){
                    if($r->answer_status){
                        // if correct
                        $given_point = $question['correct_point'];
                    }else{
                        // if wrong
                        $given_point = $question['wrong_point'];
                    }
                }

                if((int) $r->is_delete){
                    ExamSessionAnswer::where('id_exam_session_question', $r->id_question)->where('user_session_code', $r->user_session_code)->delete();

                    $id_exam_session = ExamSession::where('exam_session_code', $r->exam_session_code)->first()['id'];

                    $data = (new DoExamController)->updateQuestionAndAnswer($id_exam_session);

                    return response()->json(['status' => 'success', 'data' => $data]);
                }else{
                    $save = ExamSessionAnswer::updateOrCreate(
                    [
                        'id_exam_session_question' => $r->id_question,
                        'user_session_code' => $r->user_session_code
                    ],
                    [
                        'user_session_code' => $r->user_session_code,
                        'id_exam_session_question' => $r->id_question,
                        'multiple_choice_answer' => $r->question_type == 'multiple_choice' ? $r->option_id : null ,
                        'essay_answer' => $r->question_type == 'essay' ? $r->essay_answer : null,
                        'given_point' => $given_point ?? null
                    ]);
                }
                return response()->json(['status' => 'success']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'fail', 'messages' => $th->getMessage()]);
        }

   }

   public function saveNavPosition(Request $r){

        if(ExamSession::where('exam_session_code', $r->exam_session_code)->first()['exam_session_status'] == 'Terminated'){
            return response()->json(['status' => 'fail']);
        }else{
            $update = ExamSessionUserEnroll::where('user_session_code', $r->user_session_code)->update(['current_active_nav' => $r->current_active_nav]);

            return response()->json(['status' => 'success']);
        }
   }
}
