<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop ;

class WorkshopController extends Controller
{
    public function index(){
        return Workshop::all() ;
    }

    public function store(Request $request){
        $save = Workshop::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function update(Request $request, $id){
        $data = Workshop::find($id) ;
        $update = $data->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function destroy($id){
        $delete = Workshop::find($id) ;
        $delete->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }
}
