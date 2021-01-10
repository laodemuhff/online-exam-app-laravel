<?php

namespace Modules\UserEnrollment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\ExamSession;
use App\Models\ExamSessionUserEnroll;
use App\Lib\MyHelper;


class UserEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($session_id)
    {


        $data['this_session'] = ExamSession::with('exam')->where('id', $session_id)->first();
        $data['user_enroll_instructor'] = ExamSessionUserEnroll::with('user')->where('id_exam_session', $session_id)->where('user_type', 'instructor')->get()->toArray();
        $data['user_enroll_entry'] = ExamSessionUserEnroll::with('user')->where('id_exam_session', $session_id)->where('user_type', 'entry')->get()->toArray();

        $data['ids_user_enroll_instructor'] = json_encode(array_map(function($item){return $item['id_user'];}, $data['user_enroll_instructor']));
        $data['ids_user_enroll_entry'] = json_encode(array_map(function($item){return $item['id_user'];}, $data['user_enroll_entry']));

        $data['instructors'] = json_encode(User::where('level', 'instructor')->get()->toArray());
        $data['entries'] = json_encode(User::where('level', 'entry')->get()->toArray());
        $data['exam_sessions'] = ExamSession::with('exam')->where('exam_session_status', 'Pending')->orWhere('exam_session_status', 'On Going')->get()->toArray();

        return view('userenrollment::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function saveUserEnrollment(Request $request)
    {
        $post = $request->except('_token');

        ExamSessionUserEnroll::updateOrCreate(['id_user' => $post['id_user'], 'id_exam_session' => $post['id_exam_session']], $post);

        return response()->json(['status' => 'success']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function deleteUserEnrollment($id)
    {
        return ExamSessionUserEnroll::where('id', $id)->delete();
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('userenrollment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('userenrollment::edit');
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
