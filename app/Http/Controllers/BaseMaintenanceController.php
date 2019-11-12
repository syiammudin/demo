<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hangar ;

class BaseMaintenanceController extends Controller
{
    public function index(){
        return Hangar::all() ;
    }

    public function store(Request $request){
        $save = Hangar::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function update(Request $request, $id){
        $data = Hangar::find($id) ;
        $update = $data->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function destroy($id){
        $delete = Hangar::find($id) ;
        $delete->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }
}
