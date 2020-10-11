<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use DB;
use App\Models\User;
use App\Models\AdminFeature;
use App\Models\UserAdminFeature;
use Yajra\DataTables\Facades\DataTables;

class AdminManagementController extends Controller
{
    public function create()
    {
        $get_feature = AdminFeature::get();
        $grouped_modules = array();

        foreach($get_feature as $module){
            $grouped_modules[$module['module']][] = $module;
        }
        $data = [
            'features' => $grouped_modules
        ];
        return view('user::admin-management.create', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->all();
        $post['level'] = 2;
         // validasi input
        $validate = validateRequest($post, [
            'name'             => 'required|max:100',
            'email'            => 'required|max:100',
            'password'         => 'required|max:50|confirmed',
        ]);
        if (!empty($validate))
            return $validate;

        try {
            $post['password'] = bcrypt($post['password']);
            $user = User::create($post);
            if ($user) {
                foreach ($post['feature'] as $value) {
                    UserAdminFeature::create([
                        'id_user' => $user->id,
                        'id_admin_feature' => $value
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success',['Success create admin']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors("create admin error #CA1432");
        }

    }

    public function index(){
        $data['users'] = User::where('level', 2)->get();
        return view('user::admin-management.index', $data);
    }

    public function table(Request $request){
        $post = $request->all();

        $data = User::where('level', 2);
        if (isset($post['name']))
            $data->where('name', 'LIKE', '%'.$post['name'].'%');
        if (isset($post['email']))
            $data->where('email', 'LIKE', '%'.$post['email'].'%');
        $data = $data->orderBy('updated_at','desc')->select(['id','name','email'])->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='".route('admin.admin.management.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i>Update</a> &nbsp; <a href='".route('admin.admin.management.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='".$data['name']."'><i class='flaticon2-trash'></i>Delete</a>";
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id){
        $id = decSlug($id);
        $user = User::where('id', $id)->with('userAdminFeature')->select(['id','name','email'])->first();

        if ($user) {
            $get_feature = AdminFeature::get();
            $grouped_modules = array();

            foreach($get_feature as $module){
                $grouped_modules[$module['module']][] = $module;
            }
            $data = [
                'user' => $user,
                'features' => $grouped_modules
            ];
        }
        return view('user::admin-management.edit', $data);
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        $post = $request->except("_token");
        $id = decSlug($id);
        $feature = $post['feature'];
        unset($post['feature']);

        if (isset($post['password'])) {
            $validate_data = ['name' => 'required|max:100', 'email' => 'required|max:100', 'password' => 'required|max:50|confirmed'];
            $post['password'] = bcrypt($post['password']);
        }else{
            $validate_data = ['name' => 'required|max:100', 'email' => 'required|max:100'];
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // validation data
        $validate = validateRequest($post, $validate_data);
        if (!empty($validate))
            return $validate;

        try {
            $user = User::where('id',$id)->update($post);
            if ($user) {
                $delete = UserAdminFeature::where('id_user', $id)->delete();
                foreach ($feature as $value) {
                    UserAdminFeature::create([
                        'id_user' => $id,
                        'id_admin_feature' => $value
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success',['Success update admin']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors("create admin error #CA1432");
        }
    }

    public function delete($id){
        $id = decSlug($id);
        return User::destroy($id);
    }

}
