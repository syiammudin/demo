<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComponentEquivalent ;
use App\ComponentTestEquipment ;
use App\Http\Requests\EquivalentValidate ;

class ComponentEquivalentController extends Controller
{
    public function store(EquivalentValidate $request){
        $test_equipment = ComponentTestEquipment::find($request->component_test_equipment_id) ;

        $input = $request->all() ;
        $input['request_submittion_id'] =$test_equipment->request_submittion_id ;
        $test = ComponentEquivalent::where('component_test_equipment_id', $request->component_test_equipment_id)->first() ;

        if($test){
            $save = $test->update($input) ;
        }else{
            $save = ComponentEquivalent::create($input) ;
            $input['equivalent'] = $save->id ;
            $test_equipment->update($input) ;
        }
        if($save){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function show($id){
        $data = ComponentEquivalent::where('component_test_equipment_id', $id)->first() ;
        if($data){
            return ['status' => 1, 'data' => $data] ;
        }else{
            return ['status' => 0, 'message' => 'failed'] ;
        }
    }
}
