<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeSupplier ;

class TypeSupplierController extends Controller
{
    public function index(){
        return TypeSupplier::all() ;
    }

    public function store(Request $request){
        $save = TypeSupplier::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function update(Request $request, $id){
        $data = TypeSupplier::find($id) ;
        $update = $data->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }

    public function destroy($id){
        $delete = TypeSupplier::find($id) ;
        $delete->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res ;
    }
}
