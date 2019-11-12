<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AircraftType ;
use Auth ;
use Maatwebsite\Excel\Facades\Excel;

class AircraftTypeController extends Controller
{
    public function index()
    {
        return AircraftType::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $save = AircraftType::create($input) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id)
    {
        $update = AircraftType::find($id)->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $delete = AircraftType::find($id)->delete() ;
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
                            'aircraft_type' => $v['aircraft_type'],
                            'manufacturer' => $v['manufacturer']
                        );
                    }
                }
                if(!empty($insert)){
                    $save = AircraftType::insert($insert) ;
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
