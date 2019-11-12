<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NdtMethods ;
class NDTMethodsController extends Controller
{
    public function index(){
        return NdtMethods::get() ;
    }
    public function store(Request $request) {
        $save = NdtMethods::create($request->all()) ;
        if($save){
          $res = ['status' => 1, 'message', 'success'] ;
        }else{
          $res = ['status' => 0, 'message', 'success'] ;
        }
        return $res ;
    }

    public function update(Request $request, $id){
        $update = NdtMethods::find($id) ;
        $update->update($request->all()) ;
        if($update){
          $res = ['status' => 1, 'message', 'success'] ;
        }else{
          $res = ['status' => 0, 'message', 'success'] ;
        }
        return $res ;

    }

    public function destroy($id){
      $delete = NdtMethods::find($id) ;
      $delete->delete() ;
      
      if($delete){
        $res = ['status' => 1, 'message', 'success'] ;
      }else{
        $res = ['status' => 0, 'message', 'success'] ;
      }
      return $res ;

    }
}
