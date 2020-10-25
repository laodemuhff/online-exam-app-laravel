<?php

namespace Modules\Armada\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\TipeArmada;
use App\Models\Armada;
use App\Lib\MyHelper;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ArmadaController extends Controller
{
    public function create()
    {
        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_armada'] = Armada::getEnumValues('status_armada');
        $data['status_driver'] = Armada::getEnumValues('status_driver');

        // dd($data);
        return view('armada::create', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->except('_token');
        //dd($post);
        try {
            $result = MyHelper::uploadImagePublic('\image\armada\\');

            if(isset($result['status']) && $result['status'] == 'success'){
                $post['photo'] = asset(str_replace('\\', '/', $result['filename']));
                $post['price'] = str_replace(['Rp', ','], '', $post['price']);
                Armada::create($post);

                DB::commit();
                return redirect()->back()->with('success',['Success add armada']);

            }else{
                DB::rollback();
                return redirect()->back()->withErrors('create armada failed');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors("create armada error");
        }

    }

    public function index(){
        $data['armada'] = Armada::with('tipe_armada')->get();
        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_armada'] = Armada::getEnumValues('status_armada');
        $data['status_driver'] = Armada::getEnumValues('status_driver');

        return view('armada::index', $data);
    }

    public function table(Request $request){
        $post = $request->all();

        $data = Armada::with('tipe_armada');
        if (isset($post['id_tipe_armada']))
            $data->where('id_tipe_armada', $post['id_tipe_armada']);
        if (isset($post['status_armada']))
            $data->where('status_armada', $post['status_armada']);
        if (isset($post['status_driver']))
            $data->where('status_driver', $post['status_driver']);

        $data = $data->orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='".route('armada.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i>Update</a> &nbsp; <a href='".route('armada.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='".$data['kode_armada']."'><i class='flaticon2-trash'></i>Delete</a>";
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addColumn('tipe_armada', function($data){
                return $data->tipe_armada->tipe;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id){
        $id = decSlug($id);
        $armada = Armada::where('id', $id)->first();

        if ($armada) {
            $data['armada'] = $armada;
            $data['tipe_armada'] = TipeArmada::all()->toArray();
            $data['status_armada'] = Armada::getEnumValues('status_armada');
            $data['status_driver'] = Armada::getEnumValues('status_driver');
        }

        return view('armada::edit', $data);
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        $post = $request->except("_token");
        
        $id = decSlug($id);

        try {
            if(isset($post['photo'])){
                $result = MyHelper::uploadImagePublic('\image\armada\\');
            }else{
                $result['status'] = 'success';
            }

            if(isset($result['status']) && $result['status'] == 'success'){
                if(isset($post['photo'])){
                    $post['photo'] = asset(str_replace('\\', '/', $result['filename']));
                }
                $post['price'] = str_replace(['Rp', ','], '', $post['price']);
                
                $armada = Armada::where('id',$id)->update($post);

                DB::commit();
                return redirect()->back()->with('success',['Success update armada']);
            }else{
                DB::rollback();

                if(isset($result['message'])) return redirect()->back()->withErrors($result['message']);

                return redirect()->back()->withErrors('update armada failed');
            }
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->withErrors("update armada error");
        }
    }

    public function delete($id){
        $id = decSlug($id);
        return Armada::destroy($id);
    }
}
