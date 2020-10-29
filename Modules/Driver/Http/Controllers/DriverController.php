<?php

namespace Modules\Driver\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Driver;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['driver'] = Driver::all();   

        return view('driver::index', $data);
    }

    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:drivers,phone'
        ]);

        DB::beginTransaction();

        try{
            $post = $request->except('_token');
            $save = Driver::create($post);

            if($save){
                DB::commit();
                return redirect()->back()->withSuccess(['Driver Behasil Disimpan'] ?? 'Driver Behasil Disimpan');
            }else{
                DB::rollback();
                return redirect()->back()->withErrors(['Driver Gagal Disimpan'] ?? 'Driver Behasil Disimpan');
            }
        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function table(Request $request){
        $post = $request->all();

        $data = Driver::orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='#' data-toggle='modal' data-target='#updatedriver".$data['id']."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i>Update</a> &nbsp; <a href='".route('driver.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='delete ".$data['']."'><i class='flaticon2-trash'></i>Delete</a>";
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
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
        $id = decSlug($id);
        
        $validator = Validator::make($post, [
            'name' => ['required'],
            'phone' => [
                    'required',
                    Rule::unique('drivers', 'phone')->ignore($id)
            ]
        ]);

        if(!empty($validator->errors()->messages())){
            return redirect()->back()->withErrors($validator->errors()->messages());
        }
        
        DB::beginTransaction();

        try{
            $save = Driver::where('id', $id)->update($post);

            if($save){
                DB::commit();
                return redirect()->back()->withSuccess(['Driver Behasil Diubah'] ?? 'Driver Behasil Diubah');
            }else{
                DB::rollback();
                return redirect()->back()->withErrors(['Driver Gagal Diubah'] ?? 'Driver Gagal Diubah');
            }
        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $id = decSlug($id);

        $delete = Driver::where('id', $id)->delete();

        if($delete){
            return redirect()->back()->withErrors(['Driver sukses dihapus'] ?? 'Driver sukses dihapus');
        }

        return redirect()->back()->withErrors(['Driver gagal dihapus'] ?? 'Driver gagal dihapus');
    }
}
