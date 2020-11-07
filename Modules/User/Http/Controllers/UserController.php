<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\AdminFeature;
use App\Models\UserAdminFeature;
use Validator;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($level)
    {
        $data['users'] = User::where('level', $level)->get();
        $data['level'] = $level;

        return view('user::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $features = AdminFeature::all();
        $admin_features = array();
        foreach($features as $key => $item){
            $admin_features[$item['module']][] = [
                'action' => $item['action'],
                'id' => $item['id']
            ];
        }

        $data['features'] = $admin_features;
        $data['level'] = User::getPossibleEnumValues('level');

        return view('user::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');

        $rules = [
            'level'                 => ['required'],
            'name'                  => ['required'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'phone'                 => ['required', 'unique:users,phone'],
            'password'              => ['min:6'],
            'password_confirmation' => ['same:password', 'min:6']
        ];

        $validator = Validator::make($post, $rules);

        if(!empty($validator->errors()->messages())){
            $request->flash();
            return redirect()->back()->withErrors($validator->errors()->messages());
        }

        DB::beginTransaction();

        $save = User::create([
            'level' => $post['level'],
            'name' => $post['name'],
            'email' => $post['email'],
            'phone' => $post['phone'],
            'password' => Hash::make($post['password']),
        ]);

        if($save){
            if(isset($feature) && !empty($feature)){
                foreach($feature as $id_admin_feature){
                    UserAdminFeature::create(['id_user' => $save->id, 'id_admin_feature' => $id_admin_feature]);
                }
            }

            DB::commit();
            return redirect('user/list/'.$post['level'])->with('success', ['User Sukses Dibuat']);
        }else{
            DB::rollback();
            $request->flash();
            return redirect()->back()->withErrors(['User Gagal Dibuat']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);

        return view('user::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['level'] = User::getPossibleEnumValues('level');

        return view('user::edit', $data);
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

        $update = User::where('id', $id)->update($post);

        if($update){
            Session::flash('message', 'User berhasil diupdate');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message', 'User gagal diupdate');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->except('_token')['id'];

        $delete = User::where('id', $id)->delete();

        if($delete){
            Session::flash('message', 'User berhasil dihapus');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message', 'User gagal dihapus');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('user');
    }
}
