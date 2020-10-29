<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Setting;
use DB;
use App\Lib\MyHelper;

class MaintenanceModeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $setting_maintenance = Setting::where('key', 'LIKE', 'maintenance_%')->get();

        $data = array();
        foreach($setting_maintenance as $item){
            $data[$item['key']] = $item['value'];
        }

        return view('setting::maintenance_mode.index', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        $post = $request->except("_token");

        try {
            if(isset($post['maintenance_background'])){
                $_FILES["photo"] = $_FILES['maintenance_background'];
                $result = MyHelper::uploadImagePublic('\image\maintenance\\');

                $post['maintenance_background'] = asset(str_replace('\\', '/', $result['filename']));
            }
            
            if(isset($post['maintenance_image'])){
                $_FILES["photo"] = $_FILES['maintenance_image'];
                $result = MyHelper::uploadImagePublic('\image\maintenance\\');

                $post['maintenance_image'] = asset(str_replace('\\', '/', $result['filename']));
            }   
            
            if(isset($post['maintenance_status'])){
                $post['maintenance_status'] = 1;
            }else{
                $post['maintenance_status'] = 0;
            }

            foreach($post as $key => $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

            DB::commit();
            return redirect()->back()->with('success',['Success update maintenance']);
          
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors('Galat : '.$th->getMessage());
        }
    }

}
