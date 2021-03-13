<?php

namespace Modules\DoExam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\ExamSessionUserEnroll;
use App\Models\ExamSession;
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

        $data['exam_session'] = ExamSessionUserEnroll::with(['examSession' => function($query){$query->with('exam');}])->where('id_user', $id_user)->get();

        return view('doexam::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('doexam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function registerSession(Request $r)
    {

        $post = $r->all();

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

        $raw_data = ExamSessionUserEnroll::with(['examSession' => function($query){
            $query->with(['exam' => function($query){
                $query->with(['examBaseQuestions' => function($query){
                    $query->with(['question' => function($query){
                        $query->with('options');
                    }])->where('question_validity','Valid');
                }]);
            }]);
        }])->where('id_user', auth()->user()->id)->where('id_exam_session', $id_exam_session)->get()->toArray();

        $data['questions'] = $raw_data[0]['exam_session']['exam']['exam_base_questions'];
        $data['setting'] =$raw_data[0]['exam_session'];
        $data['setting']['subject'] = $data['setting']['exam']['exam_title'];

        unset($data['setting']['exam']);

        // dd($data);
        return view('doexam::session', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('doexam::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
