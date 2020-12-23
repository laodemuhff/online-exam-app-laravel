<?php

namespace Modules\ExamSession\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\ExamSessionQuestion;
use App\Models\ExamSessionInstructorEnrolls;
use App\Models\ExamSessionStudentEnrolls;
use Carbon;

class ExamSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['exam_sessions'] = ExamSession::with('exam')->get();

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

    public function store(Request $request)
    {
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
            return redirect('exam-session')->with('success', ['Exam Session berhasil ditambahkan']);
        }

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
            return redirect('exam-session')->with('success', ['Exam Session berhasil diupdate']);
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
        return ExamSession::where('id', $id)->delete();
    }

    public function startSession($id){
        $update = ExamSession::where('id', $id)->update(['exam_session_status' => 'On Going']);

        if($update){
            return redirect()->back()->with('success',['Exam Session Started At :'.date('Y-m-d H:i:s')]);
        }

        return redirect()->back()->withErrors(['Exam Session failed to start']);
    }

    public function endSession($id){
        $update = ExamSession::where('id', $id)->update(['exam_session_status' => 'Terminated']);

        if($update){
            return redirect()->back()->with('success',['Exam Session Ended At :'.date('Y-m-d H:i:s')]);
        }

        return redirect()->back()->withErrors(['Exam Session failed to end']);
    }
}
