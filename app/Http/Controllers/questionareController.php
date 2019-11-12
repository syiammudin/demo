<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire ;
use Maatwebsite\Excel\Facades\Excel;

class questionareController extends Controller
{
    public function index(){
        return Questionnaire::all() ;
    }

    public function show($id){
        return Questionnaire::find($id) ;
    }

    public function update(Request $request, $id){
        $update = Questionnaire::find($id) ;
        $save = $update->update($request->all()) ;
        if($save) {
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('excelfile')){
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        $insert[] = array(
                            'question' => $v['question'],
                        );
                    }
                }
                if(!empty($insert)){
                    return ['status' => 1, 'data' => $insert ] ;
                }
            }
        }
        return back()->with('error','Please Check your file, Something is wrong there.');
    }
}
