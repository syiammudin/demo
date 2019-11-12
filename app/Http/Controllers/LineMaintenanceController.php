<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaintenanceArea ;
use Auth ;
use Maatwebsite\Excel\Facades\Excel;

class LineMaintenanceController extends Controller
{
    public function index()
    {
        return MaintenanceArea::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $save = MaintenanceArea::create($input) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id)
    {
        $update = MaintenanceArea::find($id)->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $delete = MaintenanceArea::find($id)->delete() ;
        if($delete){
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
                            'code' => $v['code'],
                            'description' => $v['description'],
                            'station' => $v['station']
                        );
                    }
                }
                if(!empty($insert)){
                    $save = MaintenanceArea::insert($insert) ;
                    if($save){
                        return ['status' => 1, 'message' => 'success'] ;
                    }else{
                        return ['status' => 0, 'message' => 'failed'] ;
                    }
                }
            }
        }
    }

}
