<?php

namespace Modules\Answer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\ExamSessionAnswer;
use App\Models\ExamSessionUserEnroll;
use App\Models\Question;

class AnswerController extends Controller
{
   public function saveAnswer(Request $r){

        $question = Question::with('options')->where('id', $r->id_question)->first();

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

        $save = ExamSessionAnswer::updateOrCreate(
        [
            'id_question' => $r->id_question,
            'user_session_code' => $r->user_session_code
        ],
        [
            'user_session_code' => $r->user_session_code,
            'id_question' => $r->id_question,
            'multiple_choice_answer' => $r->question_type == 'multiple_choice' ? $r->option_id : null ,
            'essay_answer' => $r->question_type == 'essay' ? $r->essay_answer : null,
            'given_point' => $given_point
        ]);

        return $save;
   }

   public function saveNavPosition(Request $r){
        $update = ExamSessionUserEnroll::where('user_session_code', $r->user_session_code)->update(['current_active_nav' => $r->current_active_nav]);

        return $update;
   }
}
