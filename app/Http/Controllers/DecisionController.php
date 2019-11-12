<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestSubmittion ;
use App\VendorManagement ;
use Auth ;
use App\User ;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmitRequest ;
use App\Mail\ChekedRequest ;
use App\Mail\NotificationUser ;
use App\RequestHistory ;

class DecisionController extends Controller
{
    public function store(Request $request){
      $input = $request->all() ;
      $save = RequestSubmittion::find($request->id) ;
      if($save->master_request_id == 1 ){
        $data =     RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                             'AircraftAuthorizedPersonel','AircraftMaterial',
                             'AircraftToolEquipment','EngineTool','AttachmentResubmit'])
                             ->find($request->id) ;
      }
      if($save->master_request_id == 2 ){
        $data =  RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                          'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                          ->find($request->id) ;
      }
      if($save->master_request_id == 3 ){
        $data =    RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool'])->find($request->id);
      }
      if($save->master_request_id == 4 ){
        $data =    RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                  'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit')
                                 ->find($request->id);
      }

      if(auth::user()->role == 5){
        $input['status'] = 4 ;
        $save->update($input);

        $qsa = User::where('role', 6)->first() ;
        $input['data'] = $data ;
        $input['user_id'] = auth::user()->id ;
        $input['request_submittion_id'] = $request->id ;

        Mail::to($qsa->email)->queue(new ChekedRequest($data));
        Mail::to($data->User->email)->queue(new NotificationUser($data));
        RequestHistory::create($input);
      }

      if(auth::user()->role == 6){
        $input['user_id'] = auth::user()->id ;
        $input['request_submittion_id'] = $request->id ;
        $input['status'] = 5 ;
        $save->update($input);
        Mail::to($data->User->email)->queue(new NotificationUser($data));
        RequestHistory::create($input);
      }

        if($save){
            $res = ['status' => 1, 'message' => 'success'];
        }else {
            $res = ['status' => 0, 'message' => 'failed'];
        }

        return $res ;
    }


    public function show(Request $request, $id){
        if($request->type){
            $data = VendorManagement::with(['VendorAttachment','VendorManagementHistory'])->find($id);
            $data['master_request_id'] = 5 ;
            return $data ;
        }else{
            return RequestSubmittion::with('RequestHistory')->find($id);
        }
    }
}
