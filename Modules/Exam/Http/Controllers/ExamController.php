<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\ExamSubject;
use App\Models\ExamBaseQuestion;
use App\Models\Question;
use App\Models\QuestionSubject;
use App\Models\Option;
use DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['exams'] = Exam::with(['examBaseQuestions','exam_subject' => function($query){ $query->with('subject')->take(5); }, 'examSessions'])->get()->toArray();
        // dd($data);
        return view('exam::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['subjects'] = json_encode(Subject::all()->toArray());
        return view('exam::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');

        DB::beginTransaction();

        try{
            $create_exam = Exam::create([
                'exam_title' => $post['exam_title'],
                'max_score' => $post['max_score'],
                'default_wrong_point' => $post['default_wrong_point'],
                'default_correct_point' => $post['default_correct_point'],
                'exam_status' => isset($post['oecp_1']) ? 'Active' : 'Inactive',
                'oecp_1' => isset($post['oecp_1']) ? '1' : '0',
                'oecp_2' => isset($post['oecp_2']) ? '1' : '0',
                'oecp_3' => isset($post['oecp_3']) ? '1' : '0',
                'oecp_4' => isset($post['oecp_4']) ? '1' : '0',
                'oecp_5' => isset($post['oecp_5']) ? '1' : '0',
                'oecp_6' => isset($post['oecp_6']) ? '1' : '0',
                'oecp_8' => isset($post['oecp_8']) ? '1' : '0',
            ]);
    
            if($create_exam){
                // insert exam subject
                if(isset($post['exam_subjects'])){
                    $exam_subjects = explode(',',rtrim($post['exam_subjects']));
                    $base_question_subjects = [];

                    foreach($exam_subjects as $key => $exsub){
                        $base_question_subjects[$key] = $exsub;
                        ExamSubject::create(['id_exam' => $create_exam->id, 'id_subject' => $exsub]);
                    }
                }

                // cek if group questions is exist
                if(isset($post['group-questions'])){
                    foreach($post['group-questions'] as $key => $question){
                        if(isset($question['type'])){
                            if(isset($question['question_description'])){
                                $create_question = Question::create([
                                    'type' => $question['type'],
                                    'question_description' => $question['question_description'],
                                    'use_default_correct_point' => isset($question['use_default_correct_point']) ? '1' : '0',
                                    'use_default_wrong_point' => isset($question['use_default_wrong_point']) ? '1' : '0',
                                    'correct_point' => $question['correct_point'] ?? $post['default_correct_point'] ?? null,
                                    'wrong_point' => $question['wrong_point'] ?? $post['default_wrong_point'] ?? null
                                ]);

                                if($create_question){
                                    if($question['type'] == 'multiple_choice' && isset($question['group-options'])){
                                        foreach($question['group-options'] as $key => $option){
                                            $create_option = Option::create([
                                                'id_question' => $create_question->id,
                                                'option_label' => $option['option_label'],
                                                'option_description' => $option['option_description'],
                                                'answer_status' => isset($option['answer_status']) ? '1' : '0' 
                                            ]);

                                            if(!$create_option){
                                                DB::rollback();
    
                                                return redirect()->back()->withErrors(['Something went wrong #ABC123']);
                                            }
                                           
                                        }
                                    }

                                    if(isset($base_question_subjects) && !empty($base_question_subjects )){
                                        foreach($base_question_subjects as $id_subject){
                                            $create_question_subject = QuestionSubject::create([
                                                'id_question' => $create_question->id,
                                                'id_subject' => $id_subject
                                            ]);

                                            if(!$create_question_subject){
                                                DB::rollback();
    
                                                return redirect()->back()->withErrors(['Something went wrong #KIUDGF']);
                                            }
                                        }
                                    }
                                    
                                    $create_exam_base_question = ExamBaseQuestion::create([
                                        'id_exam' => $create_exam->id,
                                        'id_question' => $create_question->id,
                                        'question_validity' => 'valid'
                                    ]);

                                    if(!$create_exam_base_question){
                                        DB::rollback();
    
                                        return redirect()->back()->withErrors(['Something went wrong #CCCDGF']);
                                    }
                                
                                }else{
                                    DB::rollback();

                                    return redirect()->back()->withErrors(['Something went wrong #BBCV43']);
                                }
                            }else{
                                DB::rollback();

                                return redirect()->back()->withErrors(['Question Description can\'t be empty!']);
                            }
                        }
                    }
                }

                DB::commit();

                return redirect()->back()->with('success', ['Exam berhasil dibuat']);
            }

            DB::rollback();
            return redirect()->back()->withErrors(['Exam gagal dibuat']);

        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors([$th->getMessage()]);
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('exam::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {   
        $data['exam'] = Exam::find($id)->toArray();
        $data['subjects'] = json_encode(Subject::all()->toArray());
        $data['exam_base_questions'] = ExamBaseQuestion::with(['question' => function($query){ $query->with('options'); }])->where('id_exam', $id)->get()->toArray();

        return view('exam::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // help im stuck
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
