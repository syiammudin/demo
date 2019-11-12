<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComponentMaterialPlanning ;
class ComponentMaterialPlanningController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'part_number' => 'required',
            'part_description' => 'required',
            // 'qty' => 'required',
        ]);

        $save = ComponentMaterialPlanning::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success', 'data' => $save] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }


    public function show($id){
        return ComponentMaterialPlanning::find($id) ;
    }

    public function update(Request $request, $id){
        $update = ComponentMaterialPlanning::find($id) ;
        $update->update($request->all()) ;
        if($update){
            $res = ['status' => 1, 'message' => 'success', 'data' => $update] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function destroy($id)
    {
        $del = ComponentMaterialPlanning::find($id) ;
        $del->delete() ;
        if($del){
            $res =  ['status' => 1,'message' => 'delete success'];
        }else{
            $res =  ['status' => 0,'message' => 'delete failed'];
        }
        return $res ;
    }
}
