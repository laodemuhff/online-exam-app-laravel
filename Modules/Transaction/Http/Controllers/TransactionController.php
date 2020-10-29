<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Transaction;
use App\Models\TipeArmada;
use App\Models\Armada;
use App\Lib\MyHelper;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TransactionController extends Controller
{
    public function create()
    {
        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');

        // dd($data);
        return view('transaction::index', $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        $post = $request->except('_token');

        $request->validate([
            'id_tipe_armada' => 'required',
            'kode_armada' => 'required|unique:armadas,kode_armada',
            'status_armada' => 'required',
            'status_driver' => 'required',
            'price' => 'required',
            'photo' => 'required|image'
        ]);

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
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }

    }

    public function index($status){
        $data['transaction'] = Transaction::with(['armada' => function($query){
                $query->with('tipe_armada');
            }
        ])
        ->where('status_transaksi', $status)
        ->where('is_deleted', 0)
        ->get();

        $data['tipe_armada'] = TipeArmada::all()->toArray();
        $data['status_lepas_kunci'] = Transaction::getEnumValues('status_lepas_kunci');
        $data['status_pengambilan'] = Transaction::getEnumValues('status_pengambilan');
        $data['status'] = $status;

        return view('transaction::index', $data);
    }

    public function table(Request $request, $status){
        $post = $request->all();

        $data = Transaction::select('transactions.*', 'armadas.kode_armada as kode_armada', 'armadas.price as harga_sewa', 'tipe_armadas.tipe as tipe_armada')
                            ->join('armadas', 'armadas.id', 'transactions.id_armada')
                            ->join('tipe_armadas', 'tipe_armadas.id', 'armadas.id_tipe_armada')
                            ->where('status_transaksi', $status)
                            ->where('is_deleted', 0);

        if (isset($post['nama_customer']))
            $data->where('nama_customer', 'LIKE', '%'.$post['nama_customer'].'%');

        if (isset($post['alamat_customer']))
            $data->where('alamat_customer', 'LIKE', '%'.$post['alamat_customer'].'%');
            
        if (isset($post['no_hp_customer']))
            $data->where('no_hp_customer', 'LIKE', '%'.$post['no_hp_customer'].'%');

        if (isset($post['nomor_faktur']))
            $data->where('nomor_faktur', 'LIKE', '%'.$post['nomor_faktur'].'%');
            
        if (isset($post['tipe_armada']))
            $data->where('tipe_armada', $post['tipe_armada']);

        if (isset($post['durasi_sewa']))
            $data->where('durasi_sewa', $post['durasi_sewa']);

        if (isset($post['pickup_date']))
            $data->where('pickup_date', $post['pickup_date']);

        if (isset($post['status_lepas_kunci']))
            $data->where('status_lepas_kunci', $post['status_lepas_kunci']);

        if (isset($post['status_pengambilan']))
            $data->where('status_pengambilan', $post['status_pengambilan']);

        $data = $data->orderBy('updated_at','desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                if($data['status_lepas_kunci'] == null){
                    return "<a href='".route('transaction.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white; width:35px; padding: 8px !important' title='edit ".$data['nomor_faktur']."'><i class='la la-edit'></i></a><a href='".route('transaction.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='hapus ".$data['nomor_faktur']."' style='width:35px; padding: 8px !important'><i class='la la-trash'></i></a><a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx".$data['id']."' title='detail ".$data['nomor_faktur']."'><i class='la la-eye'></i></a><a href='".route('transaction.assign.driver',[encSlug($data['id'])])."' class='btn btn-success btn-sm btn-success' title='assign to driver' style='width:35px; padding: 8px !important'><i class='la la-user'></i></a>";
                }else{
                    return "<a href='".route('transaction.edit',[encSlug($data['id'])])."' class='btn btn-warning btn-sm' style='color: white; width:35px; padding: 8px !important' title='edit ".$data['nomor_faktur']."'><i class='la la-edit'></i></a><a href='".route('transaction.delete',[encSlug($data['id'])])."' class='btn btn-danger btn-sm btn-delete' title='hapus ".$data['nomor_faktur']."' style='width:35px; padding: 8px !important'><i class='la la-trash'></i></a><a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx".$data['id']."' title='detail ".$data['nomor_faktur']."'><i class='la la-eye'></i></a>";
                }
                // return "<a href='".route('admin.brand.edit', [$data['id'], $data['email']])."'><i class='fa fa-edit text-warning'></i></a> | <a href='".route('admin.brand.destroy', [$data['id'], $data['email']])."' class='btn-delete' title=".$data['name']."><i class='fa fa-trash text-danger'></i></a>";
            })
            ->addColumn('kode_armada', function($data){
                return $data['kode_armada'];
            })
            ->addColumn('tipe_armada', function($data){
                return $data['tipe_armada'];
            })
            ->addColumn('harga_sewa', function($data){
                return $data['harga_sewa'];
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
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }
    }

    public function delete($id){
        $id = decSlug($id);
        return Armada::destroy($id);
    }

    public function generateRandomCode(Request $request){
        $id = str_replace(' ', '', $request->get('id'));
        $code = $id.'-'.MyHelper::createrandom(4, null, '123456789');

        return response()->json(['code' => $code]);
    }
}
