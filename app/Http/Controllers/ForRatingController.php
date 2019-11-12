<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ForRating ;

class ForRatingController extends Controller
{
    public function index(){
      return ForRating::get() ;
    }

    public function store(Request $request){
        $save = ForRating::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
          $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id){
        $update = ForRating::find($id) ;
        $update->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
          $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id){
        $delete = ForRating::find($id) ;
        $delete->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

}
