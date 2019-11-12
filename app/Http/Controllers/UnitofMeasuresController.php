<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitOfMeasure;
use Auth ;

class UnitofMeasuresController extends Controller
{
    public function index()
    {
        return UnitOfMeasure::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id ;
        $save = UnitOfMeasure::create($input) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function update(Request $request, $id)
    {
        $update = UnitOfMeasure::find($id)->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function destroy($id)
    {
        $delete = UnitOfMeasure::find($id)->delete() ;
        if($delete){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }
}
