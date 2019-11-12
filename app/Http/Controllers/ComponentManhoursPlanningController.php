<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComponentManhoursPlanning ;
class ComponentManhoursPlanningController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'man_hour' => 'required',
            'man_power' => 'required',
        ]);

        $save = ComponentManhoursPlanning::create($request->all()) ;
        if($save){
            $res = ['status' => 1, 'message' => 'success', 'data' => $save] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function show($id){
        return ComponentManhoursPlanning::find($id) ;
    }

    public function update(Request $request, $id){
        $request->validate([
            'task_name' => 'required',
            'man_hour' => 'required',
            'man_power' => 'required',
        ]);
        $update = ComponentManhoursPlanning::find($id);
        $save = $update->update($request->all()) ;
        if($save){
            $data = ComponentManhoursPlanning::find($id);
            $res = ['status' => 1, 'message' => 'success', 'data' => $data] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function destroy($id)
    {
        $del = ComponentManhoursPlanning::find($id) ;
        $del->delete() ;
        if($del){
            $res =  ['status' => 1,'message' => 'delete success'];
        }else{
            $res =  ['status' => 0,'message' => 'delete failed'];
        }
        return $res ;
    }
}
