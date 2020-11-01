<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\AdminFeature;

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
            $admin_features[$item['module']] = [
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

        $save = User::create($post);

        if($save){
            Session::flash('message', 'User berhasil disimpan!');
            Session::flash('alert-class', 'alert-outline-success');
        }else{
            Session::flash('message', 'User gagal disimpan');
            Session::flash('alert-class', 'alert-outline-danger');
        }

        return redirect('user');

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
