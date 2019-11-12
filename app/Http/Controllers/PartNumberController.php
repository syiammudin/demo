<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartNumber ;
use Auth ;
use Maatwebsite\Excel\Facades\Excel;

class PartNumberController extends Controller
{

    public function index()
    {
        return PartNumber::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $save = PartNumber::create($input) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id)
    {
        $update = PartNumber::find($id)->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $delete = PartNumber::find($id)->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }
    public function importExcel(Request $request){
      if($request->hasFile('excelfile')){
          $path = $request->file('excelfile')->getRealPath();
          $data = Excel::load($path, function($reader) {})->get();
          if(!empty($data) && $data->count()){
              foreach ($data->toArray() as $key => $v) {
                  // if(!empty($v)){
                  $cek = PartNumber::where('part_number', $v['part_number'])->count() ;
                  // echo $cek ." " ;
                    // $insert = array(
                    //   'part_number' => $v['part_number'],
                    //   'ata_chapter' => $v['ata_chapter'],
                    //   'part_description' => $v['part_description'],
                    // );

                    $input['part_number'] =$v['part_number'] ;
                    $input['ata_chapter'] = $v['ata_chapter'] ;
                    $input['part_description'] =$v['part_description'] ;

                    if($cek > 0 ){
                        $update = PartNumber::where('part_number', $v['part_number'])->first();
                        $update->update($input) ;
                        $save = 'ok' ;
                    }else{
                        $save = PartNumber::create($input) ;
                    }

              }
              if(!empty($save)){
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
