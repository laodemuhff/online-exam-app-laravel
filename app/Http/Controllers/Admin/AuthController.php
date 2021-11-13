<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminFeature;
use App\Models\UserAdminFeature;
use App\Models\Subject;
use App\Models\ExamSession;
use App\Models\Exam;
use App\Models\Question;
use Auth;
use Validator;
use DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function dashboard(){

        $question_subject = DB::table('question_subjects')
                            ->select('id_subject', DB::raw('count(*) as total'))
                            ->groupBy('id_subject')
                            ->orderBy('total', 'desc')
                            ->get();
       
        $treshold = 5;
        $popular_subjects = [];
        foreach($question_subject as $key => $item){
            if($key == 5) break;
            $subject = Subject::where('id', $item->id_subject)->first();
            $popular_subjects[$key]['subject'] = $subject->name;
            $popular_subjects[$key]['total'] = $item->total;
        }

        $ratings = [];

        $ratings['all_time']['exams_created'] = Exam::all()->count();
        $ratings['all_time']['questions_created'] = Question::all()->count();
        $ratings['all_time']['session_enrolled'] = ExamSession::all()->count();
        $ratings['all_time']['session_evaluated'] = ExamSession::where('is_evaluation_send', 1)->count();

        $awal_bulan = Carbon::now()->startOfMonth();
        $akhir_bulan = Carbon::now()->endOfMonth();
      
        $ratings['monthly']['exams_created'] = Exam::whereBetween('created_at', [$awal_bulan, $akhir_bulan])->count();
        $ratings['monthly']['questions_created'] = Question::whereBetween('created_at', [$awal_bulan, $akhir_bulan])->count();
        $ratings['monthly']['session_enrolled'] = ExamSession::whereBetween('created_at', [$awal_bulan, $akhir_bulan])->count();
        $ratings['monthly']['session_evaluated'] = ExamSession::whereBetween('created_at', [$awal_bulan, $akhir_bulan])->where('is_evaluation_send', 1)->count();
        
        return view('dashboard', [
            'ratings' => $ratings,
            'popular_subjects' => $popular_subjects
        ]);
    }

    public function login(){
        return view('guest.login');
    }

    public function loginPost(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all());
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            // check if user level is for apps
            if (!in_array($user->level, ['entry', 'instructor', 'admin']))
                return redirect()->back()->withErrors("Invalid Credential");

            // get token
            if($user->level == 'admin'){
                $token = $user->createToken($user->email,['admin'])->accessToken;
                $route_name = 'admin.dashboard';
            }elseif($user->level == 'instructor'){
                $token = $user->createToken($user->email,['instructor'])->accessToken;
                $route_name = 'admin.dashboard';
            }else{
                $token = $user->createToken($user->email,['entry'])->accessToken;
                $route_name = 'home';
            }

            if ($token) {
                // get feature
                $features = [];
                if ($user->level == "admin")
                    $features = AdminFeature::get()->toArray() ?? [];
                else{
                    $data_feature = UserAdminFeature::where('id_user', $user->id)->with('adminFeature')->get()->toArray() ?? [];
                    foreach ($data_feature as $key => $value) {
                        array_push($features, $value['admin_feature'][0] ?? null);
                    }
                }

                session([
                    'access_token'      => 'Bearer '.$token,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'level'             => $user->level,
                    'granted_features'  => array_column($features, 'key'),
                ]);

                return redirect()->route($route_name);
            }else
                return redirect()->back()->withErrors("Invalid Credential");
        }else
            return redirect()->back()->withErrors("Invalid Credential");

        return redirect()->back()->withErrors("Invalid Credential");
    }

    public function logout(Request $request) {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
