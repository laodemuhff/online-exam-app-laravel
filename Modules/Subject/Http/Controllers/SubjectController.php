<?php

namespace Modules\Subject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use App\Models\Subject;
use Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['subjects'] = Subject::withCount(['exam_subject', 'question_subject'])->get();

        return view('subject::index', $data);
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
            'name' => 'unique:subjects,name'
        ];

        $validate = Validator::make($post, $rules);

        if(!empty($validate->errors()->messages())){
            $request->flash();
            return redirect()->back()->withErrors($validate->errors()->messages());
        }

        try{
            $save = Subject::create($post);
            if($save){
                return redirect()->back()->with('success', ['Subject Sukses Ditambahkan']);
            }
            return redirect()->back()->withErrors(['Subject Gagal Ditambahkan']);

        }catch(\Throwable $th){
            return redrect()->back()->withErrors(['Something went wrong']);
        }
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

        $rules = [
            'name' => Rule::unique('subjects','name')->ignore($id)
        ];

        $validate = Validator::make($post, $rules);

        if(!empty($validate->errors()->messages())){
            $request->flash();
            return redirect()->back()->withErrors($validate->errors()->messages());
        }

        try{
            $update = Subject::where('id', $id)->update($post);
            if($update){
                return redirect()->back()->with('success', ['Subject Sukses Diubah']);
            }
            return redirect()->back()->withErrors(['Subject Gagal Diubah']);

        }catch(\Throwable $th){
            return redrect()->back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $delete = Subject::find($id)->delete();

        if($delete){
            return redirect()->back()->with('success', ['Subject berhasil dihapus']);
        }

        return redirect()->back()->withErrors(['Subject gagal dihapus']);
    }
}
