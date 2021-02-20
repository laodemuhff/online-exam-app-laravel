<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
use App\Models\AdminFeature;
use App\Models\UserAdminFeature;

class AuthController extends Controller
{
    public function dashboard(){
        return view('dashboard');
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
                $route_name = 'register-session';
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
