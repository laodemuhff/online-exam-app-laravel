<?php

namespace Modules\Armada\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TipeArmada;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class TipeArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['tipe_armada'] = TipeArmada::all();   

        return view('armada::tipe_armada.index', $data);
    }

    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|unique:tipe_armadas,tipe'
        ]);

        DB::beginTransaction();

        try{
            $post = $request->except('_token');
            $save = TipeArmada::create($post);

            if($save){
                DB::commit();
                return redirect()->back()->withSuccess(['Tipe Armada Behasil Disimpan'] ?? 'Tipe Armada Behasil Disimpan');
            }else{
                DB::rollback();
                return redirect()->back()->withErrors(['Tipe Armada Gagal Disimpan'] ?? 'Tipe Armada Behasil Disimpan');
            }
        }catch(\Throwable $th){
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function table(Request $request){
        $post = $request->all();

        $data = TipeArmada::orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<a href='#' data-toggle='modal' data-target='#updateTipeArmada".$data['id']."' class='btn btn-warning btn-sm' style='color: white'><i class='flaticon-edit'></i>Update</a> &nbsp; <a href='".route('tipe_armada.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='delete ".$data['tipe']."'><i class='flaticon2-trash'></i>Delete</a>";
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
           'tipe' => [
                'required',
                Rule::unique('tipe_armadas', 'tipe')->ignore($id)
           ]
        ]);

        if(!empty($validator->errors()->messages())){
            return redirect()->back()->withErrors($validator->errors()->messages());
        }
        
        DB::beginTransaction();

        try{
            $save = TipeArmada::where('id', $id)->update($post);

            if($save){
                DB::commit();
                return redirect()->back()->withSuccess(['Tipe Armada Behasil Diubah'] ?? 'Tipe Armada Behasil Diubah');
            }else{
                DB::rollback();
                return redirect()->back()->withErrors(['Tipe Armada Gagal Diubah'] ?? 'Tipe Armada Gagal Diubah');
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

        $delete = TipeArmada::where('id', $id)->delete();

        if($delete){
            return redirect()->back()->withErrors(['Tipe Armada sukses dihapus'] ?? 'Tipe Armada sukses dihapus');
        }

        return redirect()->back()->withErrors(['Tipe Armada gagal dihapus'] ?? 'Tipe Armada gagal dihapus');
    }
}
