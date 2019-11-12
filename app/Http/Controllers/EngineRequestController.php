<?php

namespace App\Http\Controllers;

use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use Auth ;
use App\RequestSubmittion;
use App\EngineRequest;
use App\EnginePersonel;
use App\EngineVendorList;
use App\EngineTasklistNumber;
use App\EngineConsumableMaterial;
use App\EngineShopAbility;
use App\RequestHistory;
use App\EngineTool;
use App\EngineDocument;
use App\EngineTestEquipment;
use App\EngineSpecialTools;
use App\MasterConfig;
use App\User;
use PDF;
use Dompdf\Dompdf;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmitRequest ;
use App\Mail\ChekedRequest ;
use App\Mail\NotificationUser ;

class EngineRequestController extends Controller
{
    public function index(Request $request){
      return RequestSubmittion::selectRaw('request_submittions.*,
                                            engine_requests.part_number AS part_number ,
                                            engine_requests.ata_chapter  as ata_chapter,
                                            engine_requests.aircraft_type as aircraft_type')
            ->join('engine_requests', 'engine_requests.request_submittion_id','=', 'request_submittions.id')
            ->when($request->search, function($q) use ($request) {
                return $q->where(function($qq) use ($request) {
                  return $qq->where('engine_requests.part_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_type', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.created_at', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('engine_requests.ata_chapter', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('engine_requests.aircraft_type', 'LIKE', '%'.$request->search.'%');
                });
            })
            ->where('master_request_id', 3)
            ->when($request->status, function($q) use ($request) {
                return $q->whereIn('request_submittions.status', $request->status);
            })
            ->when($request->part_number, function($q) use ($request) {
              return $q->where('engine_requests.part_number', 'LIKE', '%'.$request->part_number.'%');
            })
            ->when($request->ata_chapter, function($q) use ($request) {
              return $q->where('engine_requests.ata_chapter', 'LIKE', '%'.$request->ata_chapter.'%');
            })
            ->when($request->aircraft_type, function($q) use ($request) {
              return $q->where('engine_requests.aircraft_type', 'LIKE', '%'.$request->aircraft_type.'%');
            })
            ->when($request->request_type, function($q) use ($request) {
              return $q->where('request_submittions.request_type', 'LIKE', '%'.$request->request_type.'%');
            })
            ->when(in_array(auth()->user()->role, ['1','4']), function($q) {
                return $q->where('request_submittions.status', '!=', 0);
            })
            ->when(auth()->user()->role == 3 , function($q) {
                return $q->where('user_id', auth()->user()->id)
                       ->orWhere('request_submittions.status', '>=', 1);
            })
            ->when(auth()->user()->role == 2, function($q) {
                return $q->where('user_id', auth()->user()->id);
            })
            ->when(auth()->user()->role == 5, function($q) use ($request) {
                if ($request->type) {
                  return $q->whereIn('request_submittions.status',[3,8]);
                }
                return $q->whereIn('request_submittions.status',[4,5,6]);
            })->when(auth()->user()->role == 6, function($q) use ($request) {
              if ($request->type) {
                return $q->whereIn('request_submittions.status',[4]);
              }
              return $q->whereIn('request_submittions.status',[4,5,6]);
            })
            ->orderBy($request->sort ? $request->sort : 'request_submittions.request_number', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize) ;

    }

    public function show($id){
        return  RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool','AttachmentResubmit',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])
                ->where('id', $id)->get();
    }

    public function store(Request $request){
        $request->validate([
            'request_type' => 'required',
            'engine_name' => 'required',
            'vendor_manufacturer' => 'required',
            'aircraft_type' => 'required',
            'part_number' => 'required',
            'ata_chapter' => 'required',
            'workshop' => 'required',
            'shop_maintenance' => 'required',
            'for_rating' => 'required',
            'manager_statement' => 'required',
            // 'number_ability' => 'required',
            // 'manufacture_documentation_drawing' => 'required',
            // 'inspection' => 'required',
            // 'tool_equipment' => 'required',
            // 'special_work' => 'required',
            // 'particular' => 'required',
            // 'available_qualified' => 'required',
        ]);


        $input = $request->all() ;
        // $input['part_number'] = implode('|',$request->part_number);
        $input['user_id'] = auth::user()->id;
        $input['status'] = 0;

        if($request->attachment != null){
            $input['attachment'] = implode('|',$request->attachment);
        }else{
            $input['attachment'] = null ;
        }

        if( implode('|', $request->aircraft_type)  != ''){
            $input['aircraft_type'] =  implode('|', $request->aircraft_type) ;
        }else{
            $input['aircraft_type'] =  null ;
        }

        if( implode('|', $request->part_number)  != ''){
            $input['part_number'] =  implode('|', $request->part_number) ;
        }else{
            $input['part_number'] =  null ;
        }

        if($request->request_id){
            EngineRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;
            EngineShopAbility::where('request_submittion_id',$request->request_id)->first()->update($input) ;

            foreach ($request->personel as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EnginePersonel::create($data) ;
                }else{
                    EnginePersonel::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->vendorlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineVendorList::create($data) ;
                }else{
                    EngineVendorList::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->tasklist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTasklistNumber::create($data) ;
                } else {
                    EngineTasklistNumber::find($data['id'])->update($data);
                }
            }

            foreach ($request->material as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineConsumableMaterial::create($data) ;
                }else{
                    EngineConsumableMaterial::find($data['id'])->update($data) ;
                }
            }

            foreach ($request->tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTool::create($data) ;
                }else{
                    EngineTool::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_document as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineDocument::create($data) ;
                }else{
                    EngineDocument::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_test_equipment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTestEquipment::create($data) ;
                }else{
                    EngineTestEquipment::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_special_tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineSpecialTools::create($data) ;
                }else{
                    EngineSpecialTools::find($data['id'])->update($data) ;
                }
            }

            $request_submittion = RequestSubmittion::find($request->request_id);
        }else{
            $input['request_number'] = $this->request_number() ;
            $request_submittion = RequestSubmittion::create($input) ;
            $request_submittion->EngineRequest()->create($input) ;
            $request_submittion->EngineShopAbility()->create($input) ;
            $request_submittion->EnginePersonel()->createMany($request->personel) ;
            $request_submittion->EngineVendorList()->createMany($request->vendorlist) ;
            $request_submittion->EngineConsumableMaterial()->createMany($request->material) ;
            $request_submittion->EngineTasklistNumber()->createMany($request->tasklist) ;
            $request_submittion->EngineTool()->createMany($request->tools) ;
            $request_submittion->EngineDocument()->createMany($request->list_document) ;
            $request_submittion->EngineTestEquipment()->createMany($request->list_test_equipment) ;
            $request_submittion->EngineSpecialTools()->createMany($request->list_special_tools) ;
        }

        if($request_submittion){
            $res = ['status' => 1, 'message' => 'success', 'id' => $request_submittion->id ] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function submit(Request $request){
        $request->validate([
            'request_type' => 'required',
            'part_number' => 'required',
            'engine_name' => 'required',
            'vendor_manufacturer' => 'required',
            'aircraft_type' => 'required',
            'ata_chapter' => 'required',
            'workshop' => 'required',
            'shop_maintenance' => 'required',
            'number_ability' => 'required',
            'manufacture_documentation_drawing' => 'required',
            'inspection' => 'required',
            'tool_equipment' => 'required',
            'special_work' => 'required',
            'particular' => 'required',
            // 'available_qualified' => 'required',
        ]);

        // return $request->all();
        $input = $request->all() ;
        if($request->status == 6){
            $input['step_request_type'] ='re-Submit' ;
        }else{
            $input['step_request_type'] = 'New' ;
        }
          $input['submit_date'] = date('Y-m-d') ;
        // $input['part_number'] = implode('|',$request->part_number);
        $input['user_id'] = auth::user()->id;
        $input['status'] = 1;

        if($request->attachment != null){
            $input['attachment'] = implode('|',$request->attachment);
        }else{
            $input['attachment'] = null ;
        }
        if( implode('|', $request->aircraft_type)  != ''){
            $input['aircraft_type'] =  implode('|', $request->aircraft_type) ;
        }else{
            $input['aircraft_type'] =  null ;
        }

        if( implode('|', $request->part_number)  != ''){
            $input['part_number'] =  implode('|', $request->part_number) ;
        }else{
            $input['part_number'] =  null ;
        }

        // $dr = '' ;
        // $stp_name = '' ;
        // $stp_number = '' ;
        // $tep_name = '' ;
        // $tep_number = '' ;
        // $remark = '' ;
        // foreach ($request->document_ability as $value) {
        //     $dr .=  $value['document_requirement']."|" ;
        //     $stp_name .= $value['special_tool_part_name'] ."|";
        //     $stp_number .=$value['special_tool_part_number']."|" ;
        //     $tep_name .= $value['test_equipment_part_name']."|" ;
        //     $tep_number .= $value['test_equipment_part_number']."|" ;
        //     $remark .= $value['remark']."|" ;
        // }
        // $input['document_requirement'] = $dr ;
        // $input['special_tool_part_name'] = $stp_name ;
        // $input['special_tool_part_number'] = $stp_number;
        // $input['test_equipment_part_name'] = $tep_name ;
        // $input['test_equipment_part_number'] = $tep_number ;
        // $input['remark'] = $remark ;

        $input['status'] = 1 ;

        if($request->request_id){
            $input['request_submittion_id'] = $request->request_id ;
            $input['aproval'] = auth::user()->name ;
            // $input['part_number'] = implode('|',$request->part_number);

            // RequestHistory::create($input);
            $submit = RequestSubmittion::find($request->request_id) ;
            $submit->update($input) ;

            EngineRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;
            EngineShopAbility::where('request_submittion_id',$request->request_id)->first()->update($input) ;

            foreach ($request->personel as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EnginePersonel::create($data) ;
                }else{
                    EnginePersonel::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->vendorlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineVendorList::create($data) ;
                }else{
                    EngineVendorList::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->tasklist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTasklistNumber::create($data) ;
                } else {
                    EngineTasklistNumber::find($data['id'])->update($data);
                }
            }
            foreach ($request->material as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineConsumableMaterial::create($data) ;
                }else{
                    EngineConsumableMaterial::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTool::create($data) ;
                }else{
                    EngineTool::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_document as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineDocument::create($data) ;
                }else{
                    EngineDocument::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_test_equipment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineTestEquipment::create($data) ;
                }else{
                    EngineTestEquipment::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_special_tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    EngineSpecialTools::create($data) ;
                }else{
                    EngineSpecialTools::find($data['id'])->update($data) ;
                }
            }

        }else{
            $input['request_number'] = $this->request_number() ;
            $submit = RequestSubmittion::create($input) ;
            $submit->EngineRequest()->create($input) ;
            $submit->EngineShopAbility()->create($input) ;
            $submit->EnginePersonel()->createMany($request->personel) ;
            $submit->EngineVendorList()->createMany($request->vendorlist) ;
            $submit->EngineConsumableMaterial()->createMany($request->material) ;
            $submit->EngineTasklistNumber()->createMany($request->tasklist) ;
            $submit->EngineTool()->createMany($request->tools) ;
            $submit->EngineDocument()->createMany($request->list_document) ;
            $submit->EngineTestEquipment()->createMany($request->list_test_equipment) ;
            $submit->EngineSpecialTools()->createMany($request->list_special_tools) ;
        }

        $input['request_submittion_id'] = $submit->id ;
        $input['aproval'] = auth::user()->name ;
        RequestHistory::create($input);
        $data =  RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool', 'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($submit->id) ;

        $gm = \App\User::where('role', 3)->where('role_request', 3)->first() ;

        Mail::to($gm->email)->queue(new ChekedRequest($data));

        if($submit){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }



        return $res ;
    }

    public function destroy(Request $request,$id){

        if($request->type == 'personel'){
            EnginePersonel::find($id)->delete() ;
        }

        if($request->type == 'vendorlist'){
            EngineVendorList::find($id)->delete() ;
        }

        if($request->type == 'tasklist'){
            EngineTasklistNumber::find($id)->delete() ;
        }

        if($request->type == 'material'){
            EngineConsumableMaterial::find($id)->delete() ;
        }

        if($request->type == 'delete_request'){
            RequestSubmittion::find($id)->delete() ;
        }

        if($request->type == 'tools'){
            EngineTool::find($id)->delete() ;
        }

        if($request->type == 'note_resubmit'){
            \App\AttachmentResubmit::find($id)->delete();
        }
        if($request->type == 'document'){
            \App\EngineDocument::find($id)->delete();
        }
        if($request->type == 'test_equipment'){
            \App\EngineTestEquipment::find($id)->delete();
        }
        if($request->type == 'specialtools'){
            \App\EngineSpecialTools::find($id)->delete();
        }


        if($request->type == 'Alltasklist'){
            return EngineTasklistNumber::destroy($request->all()) ;
        }
        if($request->type == 'Allvendorlist'){
            return EngineVendorList::destroy($request->all()) ;
        }
        if($request->type == 'AllconsMaterial'){
            return EngineConsumableMaterial::destroy($request->all()) ;
        }
        if($request->type == 'AlltestEquipment'){
            return EngineTestEquipment::destroy($request->all()) ;
        }
        if($request->type == 'Alltools'){
            return EngineSpecialTools::destroy($request->all()) ;
        }

        return 'success' ;
    }


    public function checked($id)
    {
        if(auth::user()->role == 3){
            $input['status'] = 2 ;
            $qsa = \App\User::where('role', 4)->where('role_request', 1)->first() ;
        }
        if(auth::user()->role == 4){
            $input['status'] = 3 ;
            $qsa = \App\User::where('role', 5)->first() ;
        }

        $input['checked_name'] = auth::user()->id ;
        $update = RequestSubmittion::find($id)->update($input) ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $data =  RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($id);

        $input['user_id'] = auth::user()->id ;
        RequestHistory::create($input);

        Mail::to($qsa->email)->queue(new ChekedRequest($data));
        Mail::to($data->User->email)->queue(new NotificationUser($data));

        if($update){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function reject(Request $request, $id){
        $input = $request->all() ;
        if(auth::user()->role == 6){
            $input['status'] = 8 ;
        }else{
            $input['status'] = 6 ;
        }
        $input['checked_name'] = null ;
        $input['status_read'] = null ;
        $update = RequestSubmittion::find($id) ;
        $update->update($input) ;

        $data =  RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool','AttachmentResubmit',  'EngineDocument',
                                         'EngineTestEquipment', 'EngineSpecialTools'])->find($id) ;
        $input['data'] = $data ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $input['user_id'] = auth::user()->id ;
        $reject = RequestHistory::create($input);
        if(auth::user()->role == 6){
          $qsa = User::find($update->qsa_part_approve );
          Mail::to($qsa->email)->queue(new ChekedRequest($data));
        }
        Mail::to($data->User->email)->queue(new NotificationUser($data));
        if($reject){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function approve(Request $request, $id)
    {
        $input = $request->all() ;
        if(auth::user()->role == 5){
            $input['status'] = 4 ;
            $role = 6 ;
        }
        if(auth::user()->role == 6){
            $input['status'] = 5 ;
            $role = 5;
        }
        $qsa = \App\User::where('role', $role )->first() ;

        $input['approve_name'] = auth::user()->id ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $input['date_approve'] = date('Y-m-d') ;
        $update = RequestSubmittion::with(['EngineRequest'])->find($id) ;

        if(auth::user()->role == 5){
            $update->update($input) ;
            $input['user_id'] = auth::user()->id ;
            $data =  RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                             'EngineVendorList','EngineTasklistNumber',
                                             'EngineConsumableMaterial','EngineShopAbility',
                                             'EngineTool','AttachmentResubmit',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($id) ;
            RequestHistory::create($input);
            Mail::to($qsa->email)->queue(new ChekedRequest($data));
        }else{
            if($update->request_type == 'Add'){
                $part_number = explode('|', $update->EngineRequest->part_number) ;
                $cek =  \App\MasterConfig::whereIn('part_number', $part_number )->where('master_request_id', 3)->count() ;

                if($cek >= 1){
                    foreach(\App\MasterConfig::whereIn('part_number', $part_number)->get() as $pn){
                        $part[] = $pn->part_number ;
                    }
                    return ['status' => 2, 'message' => 'failed' , 'note' =>  implode(", ", $part) ] ;
                }else{
                    $update->update($input) ;
                    $data = RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                                     'EngineVendorList','EngineTasklistNumber',
                                                     'EngineConsumableMaterial','EngineShopAbility',
                                                     'EngineTool','AttachmentResubmit',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($id) ;
                    $input['data'] = $data ;
                    $input['user_id'] = auth::user()->id ;

                    foreach($part_number as $pn){
                        $input['request_number'] = $data->request_number ;
                        $input['request_submittion_id'] = $data->id ;
                        $input['part_number'] = $pn ;
                        $input['data'] = $data ;
                        $input['master_request_id'] = 3 ;

                        $masterConfig = \App\MasterConfig::create($input) ;

                        $authority =  json_decode($data->EngineRequest->for_rating, true) ;
                        $i = 0 ;
                        $for_rating = [] ;
                        foreach (\App\ForRating::get() as $key => $value) {
                          if(!empty($authority[$value->name_of_rating])){
                            if($authority[$value->name_of_rating] == true){
                              $rating['value'] = $authority[$i] ;
                              $rating['rating'] = $authority[$i.'_name'] ;
                              $rating['status'] = $authority[$value->name_of_rating] ;
                            }
                            $for_rating[] = $rating ;
                          }
                          $i++ ;
                        }
                        $masterConfig->MasterConfigAuthority()->createMany($for_rating) ;
                    }

                    RequestHistory::create($input);
                    Mail::to($data->User->email)->queue(new NotificationUser($data));
                }
            }else{
                $update->update($input) ;
                $data = RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                                 'EngineVendorList','EngineTasklistNumber',
                                                 'EngineConsumableMaterial','EngineShopAbility',
                                                 'EngineTool','AttachmentResubmit',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($id) ;

                $input['data'] = $data ;
                $input['request_number'] = $data->request_number ;
                $input['request_submittion_id'] = $data->id ;
                $input['user_id'] = auth::user()->id ;

                // add authority MasterConfig
                $part_number = explode('|', $data->EngineRequest->part_number) ;
                $authority =  json_decode($data->EngineRequest->for_rating, true) ;
                foreach ($part_number as $value) {
                  $input['part_number'] = $value ;

                  $i = 0 ;
                  $for_rating = [] ;
                  foreach (\App\ForRating::get() as $key => $vrating) {
                    if(!empty($authority[$i])){
                      $rating['rating'] = $authority[$i.'_name'] ;
                      $rating['status'] = $authority[$vrating->name_of_rating] ;
                      $rating['value'] = $authority[$i] ;

                      $for_rating[] = $rating ;
                    }
                    $i++ ;
                  }

                  if(\App\MasterConfig::where('part_number', $value )->where('master_request_id', 3)->count() >= 1){
                    $master = \App\MasterConfig::where('part_number', $value )->where('master_request_id', 3)->first() ;
                    $master->update($input) ;
                    foreach ($for_rating as $valueRating) {
                        if(\App\MasterConfigAuthority::where('rating', $valueRating['rating'])->where('master_config_id', $master->id)->count() >= 1 ){
                          $masterConfig =  \App\MasterConfigAuthority::where('rating', $valueRating['rating'])->where('master_config_id', $master->id)->first() ;
                          $masterConfig->update($valueRating);
                        }else{
                          if($valueRating['status'] == true){
                            $valueRating['master_config_id'] = $master->id ;
                            \App\MasterConfigAuthority::create($valueRating) ;
                          }
                        }
                    }
                  }else{
                    $masterConfig = \App\MasterConfig::create($input);
                    $masterConfig->MasterConfigAuthority()->createMany($for_rating) ;
                  }
                }
                // and add authority MasterConfig
                RequestHistory::create($input);

                $master = \App\MasterConfig::where('part_number', $data->EngineRequest->part_number )->where('master_request_id', 3)->first() ;

                $master->update($input) ;

                Mail::to($data->User->email)->queue(new NotificationUser($data));
            }

        }

        $res = ['status' => 1, 'message' => 'success'] ;
        return $res;
    }

    public function detail($id){
        $m = new Merger();
        $request = RequestSubmittion::with(['RequestHistory','EngineRequest', 'EnginePersonel',
                                         'EngineVendorList','EngineTasklistNumber',
                                         'EngineConsumableMaterial','EngineShopAbility',
                                         'EngineTool','AttachmentResubmit',  'EngineDocument', 'EngineTestEquipment', 'EngineSpecialTools'])->find($id) ;

        $pdf = PDF::loadView('detail.request_engine', ['request' => $request, 'type' => 'potrait'] )
                    ->setOptions(['isPhpEnabled' => true])
                    ->setPaper('a4', 'portrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_engine',  ['request' => $request, 'type' => 'lanscape'])
                    ->setOptions(['isPhpEnabled' => true])
                    ->setPaper('a4', 'landscape');

        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_engine',  ['request' => $request, 'type' => 'potrait2'])->setPaper('a4', 'portrait');
        $m->addRaw($pdf->output());


        foreach ($request->EngineDocument as $doc) {
            if($doc->manual_status_confirmation != null){
              if(file_exists("uploads/engine/document/".$doc->manual_status_confirmation)){
                $m->addFile('uploads/engine/document/'.$doc->manual_status_confirmation);
              }
            }
            if($doc->component_maintenance_manual != null){
              if(file_exists("uploads/engine/document/".$doc->component_maintenance_manual)){
                $m->addFile('uploads/engine/document/'.$doc->component_maintenance_manual);
              }
            }
            if($doc->proposed_pd_sheet != null){
              if(file_exists("uploads/engine/document/".$doc->proposed_pd_sheet)){
                $m->addFile('uploads/engine/document/'.$doc->proposed_pd_sheet);
              }
            }
        }

        if($request->EngineRequest->attachment != null ){
            $loop = explode('|', $request->EngineRequest->attachment) ;
            foreach ($loop as $atc) {
              if(file_exists("uploads/engine/attachment/".$atc)){
                  $m->addFile('uploads/engine/attachment/'.$atc);
              }
            }
        }

        file_put_contents('document_n_import/engine/engine.pdf', $m->merge());

        if(auth::user()->role == 5 || auth::user()->role == 6){
          $data = array('documents' => 'document_n_import/engine/engine.pdf' , 'id' => $id , 'master_request_id' => $request->master_request_id);
          return view('decision.Decision', compact('data'));
        }else{
          return response()->file('document_n_import/engine/engine.pdf');
        }
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('excelfile')){
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        if($request->type == 'vendor_list'){
                            $insert[] = array(
                                'ata' => $v['ata'],
                                'part_name' => $v['part_name'],
                                'vendor' => $v['vendor'],
                                'remark_vendorlist' => $v['remark_vendorlist'],
                            );
                        }
                        if($request->type == 'specialtool'){
                            $insert[] = array(
                                'part_number' => $v['part_number'],
                                'part_name' => $v['part_name'],
                                'remark' => $v['remark'],
                            );
                        }
                        if($request->type == 'test_equipment'){
                            $insert[] = array(
                                'part_number' => $v['part_number'],
                                'part_name' => $v['part_name'],
                            );
                        }

                        if($request->type == 'tasklist'){
                            $insert[] = array(
                                'no_group' => $v['no_group'],
                                'description_tasklist' => $v['description_tasklist'],
                                'remark_tasklist' => $v['remark_tasklist'],
                            );
                        }

                        if($request->type == 'personel'){
                            $insert[] = array(
                                'name' => $v['name'],
                                'id_number' => $v['id_number'],
                                'function' => $v['function'],
                                'auth_no_stamp_holder' => $v['auth_no_stamp_holder'],
                                'unit' => $v['unit'],
                                'scope_competency' => $v['scope_competency'],
                            );
                        }

                        if($request->type == 'tools'){
                            $insert[] = array(
                                'special_tool' => $v['special_tool'],
                                'base_pn' => $v['base_pn'],
                                'tool_desciption' => $v['tool_desciption'],
                                'task' => $v['task'],
                                'est_arrival' => $v['est_arrival'],
                            );
                        }
                        if($request->type == 'material'){
                            $insert[] = array(
                                'part_number' => $v['part_number'],
                                'description_material' => $v['description_material'],
                                'qty' => $v['qty'],
                                'remark' => $v['remark']
                            );
                        }


                    }
                }
                if(!empty($insert)){
                    return ['status' => 1, 'data' => $insert, 'type' => $request->type] ;
                }
            }
        }

    return back()->with('error','Please Check your file, Something is wrong there.');

    }

    public function attachment(Request $request)
    {
      $command = new GhostscriptConverterCommand();
      $filesystem = new Filesystem();
      $converter = new GhostscriptConverter($command, $filesystem);
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().str_replace(' ','_',$request->file->getClientOriginalName());
            $extension = $request->file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['pdf']))
            {
                return [
                    'success' => false,
                    'message' => 'File extension not permitted'
                ];
            }

            try {
                if($request->type == 'document'){
                  $file->move('uploads/engine/document/', $fileName);
                  $converter->convert('uploads/engine/document/'.$fileName, '1.4');
                }elseif($request->type == 'personel'){
                  $file->move('uploads/engine/personel/', $fileName);
                  $converter->convert('uploads/engine/personel/'.$fileName, '1.4');
                }else{
                  $file->move('uploads/engine/attachment/', $fileName);
                  $converter->convert('uploads/engine/attachment/'.$fileName, '1.4');
                }
            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Failed to move file'
                ];
            }

            return [
                'success' => true,
                'file' => $fileName,
                'index' => $request->index,
                'message' => 'OK'
            ];
        }
    }

    public function read($id){
        if(auth::user()->role == 3 or auth::user()->role == 4  or auth::user()->role == 5 or auth::user()->role == 6){
            $request = RequestSubmittion::find($id) ;
            if($request->status_read == null){
                $input['status_read'] = "|". auth::user()->id ;
            }else{
                $cek = explode('|',$request->status_read) ;
                if (in_array(auth::user()->id ,$cek)) {
                    $input['status_read'] = $request->status_read ;
                }else{
                    $input['status_read'] = $request->status_read."|". auth::user()->id ;
                }
            }
            if(auth::user()->role == 5 and $request->qsa_part_approve == null){
              $input['qsa_part_approve'] = auth::user()->id ;
            }
            $request->update($input) ;
        }
        return 'success';
    }

    public function ekstracData(Request $request){
        $data = MasterConfig::where('part_number', $request->part_number)->where('master_request_id', 3)->first()->data ;
        $data['status'] = 0 ;
        $data['request_type'] = $request->request_type ;
        $data['status_read'] = null ;
        $data['decision'] = null ;
        $data['score'] = null ;
        $data['step_request_type'] = 'New' ;
        $data['user_id'] = auth::user()->id ;
        $data['request_number'] = $this->request_number() ;

        $ekstrak = RequestSubmittion::create($data);
        if(!empty($data['engine_personel'])){
          $ekstrak->EnginePersonel()->createMany($data['engine_personel']) ;
        }
        if(!empty($data['engine_vendor_list'])){
          $ekstrak->EngineVendorList()->createMany($data['engine_vendor_list']) ;
        }
        if(!empty($data['engine_tasklist_number'])){
          $ekstrak->EngineTasklistNumber()->createMany($data['engine_tasklist_number']) ;
        }
        if(!empty($data['engine_consumable_material'])){
          $ekstrak->EngineConsumableMaterial()->createMany($data['engine_consumable_material']) ;
        }
        if(!empty($data['engine_tool'])){
          $ekstrak->EngineTool()->createMany($data['engine_tool']) ;
        }
        if(!empty($data['engine_document'])){
          $ekstrak->EngineDocument()->createMany($data['engine_document']) ;
        }
        if(!empty($data['engine_test_equipment'])){
          $ekstrak->EngineTestEquipment()->createMany($data['engine_test_equipment']) ;
        }
        if(!empty($data['engine_special_tools'])){
          $ekstrak->EngineSpecialTools()->createMany($data['engine_special_tools']) ;
        }

        // untuk component main table
        $component = $data['engine_request'] ;
        $component['request_number'] = $this->request_number() ;
        $component['part_number'] =  $request->part_number ;
        $component['for_rating'] = json_decode(json_encode($data['engine_request']['for_rating'])) ;;
        $ekstrak->EngineRequest()->create($component) ;

        // unutk shop ability
        $shopability = $data['engine_shop_ability'] ;
        $shopability['summary_of_maintenance'] = $data['engine_shop_ability']['summary_of_maintenance'];
        $shopability['consumable_material'] = $data['engine_shop_ability']['consumable_material'];

        $ekstrak->EngineShopAbility()->create($shopability) ;

        return ['status' => 1, 'message' => 'success', 'id' => $ekstrak->id , 'type' => 'form_engine'] ;
    }

    public function request_number(){
        $request = EngineRequest::orderBy('id','desc')->first();

        if($request){
            $cek = str_replace('EN','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 9){
            $number = 'EN00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = 'EN0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = 'EN000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = 'EN00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = 'EN0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = 'EN'.($cek+1) ;
        }

        return $number ;
    }

}
