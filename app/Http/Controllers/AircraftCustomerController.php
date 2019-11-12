<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterAircraftCustomer ;

class AircraftCustomerController extends Controller
{
  public function index(){
      return MasterAircraftCustomer::get() ;
  }

  public function store(Request $request){
      $save = MasterAircraftCustomer::create($request->all()) ;
      if($save){
          $res = ['status' => 1, 'message' => 'success'] ;
      }else{
        $res = ['status' => 0, 'message' => 'failed'] ;
      }

      return $res ;
  }

  public function update(Request $request, $id){
      $update = MasterAircraftCustomer::find($id) ;
      $update->update($request->all()) ;
      if($update){
          $res = ['status' => 1, 'message' => 'success'] ;
      }else{
        $res = ['status' => 0, 'message' => 'failed'] ;
      }

      return $res ;
  }

  public function destroy($id){
      $delete = MasterAircraftCustomer::find($id) ;
      $delete->delete() ;
      
      if($delete){
          $res = ['status' => 1, 'message' => 'success'] ;
      }else{
          $res = ['status' => 0, 'message' => 'failed'] ;
      }

      return $res ;
  }
}
