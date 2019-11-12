<?php

namespace App\Http\Controllers;

use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\RequestSubmittion ;
use App\SpecialRequest ;
use App\SpecialShopAbility ;
use App\SpecialPersonel ;
use App\SpecialSheetList ;
use App\SpecialTools ;
use App\SpecialPartList ;
use App\SpecialDocument ;
use App\SpecialTestEquipment ;
use App\SpecialMaterial ;
use App\RequestHistory ;
use App\MasterConfig ;
use App\User ;
use App\Http\Controllers\store\StoreController;
use App\Http\Requests\SpecialRequestValidation ;
use Auth ;
use PDF ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmitRequest ;
use App\Mail\ChekedRequest ;
use App\Mail\NotificationUser ;

class SpecialRequestController extends Controller
{
    public function index(Request $request)
    {
      return RequestSubmittion::selectRaw('request_submittions.*,
                                            special_requests.part_number AS part_number ,
                                            special_requests.ata_chapter  as ata_chapter,
                                            special_requests.aircraft_type as aircraft_type')
            ->join('special_requests', 'special_requests.request_submittion_id','=', 'request_submittions.id')
            ->when($request->search, function($q) use ($request) {
                return $q->where(function($qq) use ($request) {
                  return $qq->where('special_requests.part_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_type', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.created_at', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('special_requests.ata_chapter', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('special_requests.aircraft_type', 'LIKE', '%'.$request->search.'%');
                });
            })
            ->where('master_request_id', 4)
            ->when($request->status, function($q) use ($request) {
                return $q->whereIn('request_submittions.status', $request->status);
            })
            ->when($request->part_number, function($q) use ($request) {
              return $q->where('special_requests.part_number', 'LIKE', '%'.$request->part_number.'%');
            })
            ->when($request->ata_chapter, function($q) use ($request) {
              return $q->where('special_requests.ata_chapter', 'LIKE', '%'.$request->ata_chapter.'%');
            })
            ->when($request->aircraft_type, function($q) use ($request) {
              return $q->where('special_requests.aircraft_type', 'LIKE', '%'.$request->aircraft_type.'%');
            })
            ->when($request->request_type, function($q) use ($request) {
              return $q->where('request_submittions.request_type', 'LIKE', '%'.$request->request_type.'%');
            })
            ->when(in_array(auth()->user()->role, ['1','4']), function($q) {
                return $q->where('request_submittions.status', '!=', 0);
            })
            ->when(auth()->user()->role == 3, function($q) {
                return $q->where('user_id', auth()->user()->id)->orWhere('request_submittions.status', '>=', 1);
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
            ->orderBy($request->sort ? $request->sort : 'request_submittions.request_number', $request->order == 'ascending' ? 'asc' : 'desc')
            ->paginate($request->pageSize) ;
    }

    public function store(Request $request)
    {
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
            'aproval_request_carry_out' => 'required',
        ]);

        $input = $request->all() ;
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
        // return $request->equipment_tools ;

        if($request->request_id){
            SpecialRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;
            SpecialShopAbility::where('request_submittion_id',$request->request_id)->first()->update($input) ;

            foreach($request->personel as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialPersonel::create($data) ;
                }else{
                    SpecialPersonel::find($data['id'])->update($data) ;
                }
            }
            foreach($request->sheetlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialSheetList::create($data) ;
                }else{
                    SpecialSheetList::find($data['id'])->update($data) ;
                }
            }
            foreach($request->tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialTools::create($data) ;
                }else{
                    SpecialTools::find($data['id'])->update($data) ;
                }
            }
            foreach($request->partlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialPartList::create($data) ;
                }else{
                    SpecialPartList::find($data['id'])->update($data) ;
                }
            }

            foreach ($request->list_document as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialDocument::create($data) ;
                }else{
                    SpecialDocument::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_test_equipment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialTestEquipment::create($data) ;
                }else{
                    SpecialTestEquipment::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_material as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialMaterial::create($data) ;
                }else{
                    SpecialMaterial::find($data['id'])->update($data) ;
                }
            }

            $request_submittion = RequestSubmittion::find($request->request_id);
        }else{
            $input['request_number'] = $this->request_number()  ;
            $request_submittion = RequestSubmittion::create($input) ;
            $request_submittion->SpecialRequest()->create($input) ;
            $request_submittion->SpecialShopAbility()->create($input) ;
            $request_submittion->SpecialPersonel()->createMany($request->personel) ;
            $request_submittion->SpecialSheetList()->createMany($request->sheetlist) ;
            $request_submittion->SpecialTools()->createMany($request->tools) ;
            $request_submittion->SpecialPartList()->createMany($request->partlist) ;
            $request_submittion->SpecialDocument()->createMany($request->list_document) ;
            $request_submittion->SpecialTestEquipment()->createMany($request->list_test_equipment) ;
            $request_submittion->SpecialMaterial()->createMany($request->list_material) ;
        }

        if($request_submittion){
            $res = ['status' => 1, 'message' => 'success', 'id' => $request_submittion->id ] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function submit(SpecialRequestValidation $request){
        $input = $request->all() ;
        $input['user_id'] = auth::user()->id;
        $input['status'] = 1;
        if($request->status == 6){
            $input['step_request_type'] ='re-Submit' ;
        }else{
            $input['step_request_type'] = 'New' ;
        }

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

        $input['submit_date'] = date('Y-m-d') ;
        if($request->request_id){
            $input['status'] = 1 ;
            $input['request_submittion_id'] = $request->request_id ;
            $input['aproval'] = auth::user()->name ;

            RequestHistory::create($input);

            $submit = RequestSubmittion::find($request->request_id);
            $submit->update($input) ;

            SpecialRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;
            SpecialShopAbility::where('request_submittion_id',$request->request_id)->first()->update($input) ;

            foreach($request->personel as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialPersonel::create($data) ;
                }else{
                    SpecialPersonel::find($data['id'])->update($data) ;
                }
            }
            foreach($request->sheetlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialSheetList::create($data) ;
                }else{
                    SpecialSheetList::find($data['id'])->update($data) ;
                }
            }
            foreach($request->tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialTools::create($data) ;
                }else{
                    SpecialTools::find($data['id'])->update($data) ;
                }
            }
            foreach($request->partlist as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialPartList::create($data) ;
                }else{
                    SpecialPartList::find($data['id'])->update($data) ;
                }
            }

            foreach ($request->list_document as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialDocument::create($data) ;
                }else{
                    SpecialDocument::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_test_equipment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialTestEquipment::create($data) ;
                }else{
                    SpecialTestEquipment::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_material as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    SpecialMaterial::create($data) ;
                }else{
                    SpecialMaterial::find($data['id'])->update($data) ;
                }
            }

        }else{
            $input['request_number'] = $this->request_number()  ;
            $submit = RequestSubmittion::create($input) ;
            $submit->SpecialRequest()->create($input) ;
            $submit->SpecialShopAbility()->create($input) ;
            $submit->SpecialPersonel()->createMany($request->personel) ;
            $submit->SpecialSheetList()->createMany($request->sheetlist) ;
            $submit->SpecialTools()->createMany($request->tools) ;
            $submit->SpecialPartList()->createMany($request->partlist) ;
            $submit->SpecialDocument()->createMany($request->list_document) ;
            $submit->SpecialTestEquipment()->createMany($request->list_test_equipment) ;
            $submit->SpecialMaterial()->createMany($request->list_material) ;
            $input['request_submittion_id'] = $submit->id ;
            $input['aproval'] = auth::user()->name ;
            RequestHistory::create($input);
        }

        $data =  RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                       'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                       'SpecialDocument','SpecialTestEquipment','SpecialMaterial')->find($submit->id) ;

        $qsa = \App\User::where('role', 3)->where('role_request', 4)->first() ;

        Mail::to($qsa->email)->queue(new ChekedRequest($data));

        if($submit){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function show($id)
    {
        return RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                       'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                       'SpecialDocument','SpecialTestEquipment','SpecialMaterial')
                                 ->find($id);
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('excelfile')){
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        if($request->type == 'personel'){
                            $insert[] = array(
                                'name' => $v['name'],
                                'id_number' => $v['id_number'],
                                'job_title' => $v['job_title'],
                                'auth_no_stamp_holder' => $v['auth_no_stamp_holder'],
                                'unit' => $v['unit'],
                                'scope_competency' => $v['scope_competency'],
                            );
                        }
                        if($request->type == 'sheetlist'){
                            $insert[] = array(
                                'category' => $v['category'],
                                'pd_sheet_number' => $v['pd_sheet_number'],
                                'desciption' => $v['desciption'],
                            );
                        }
                        if($request->type == 'tools'){
                            $insert[] = array(
                                'part_name' => $v['part_name'],
                                'tool_name' => $v['tool_name'],
                                'qty' => $v['qty'],
                                'availability' => $v['availability'],
                            );
                        }
                        if($request->type == 'partlist'){
                            $insert[] = array(
                                'part_name' => $v['part_name'],
                                'example_part_number' => $v['example_part_number'],
                                'vendor_name' => $v['vendor_name'],
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

    public function destroy(Request $request, $id)
    {
        if($request->type == 'personel'){
            SpecialPersonel::find($id)->delete() ;
        }

        if($request->type == 'partlist'){
            SpecialPartList::find($id)->delete() ;
        }

        if($request->type == 'sheetlist'){
            SpecialSheetList::find($id)->delete() ;
        }

        if($request->type == 'tools'){
            SpecialTools::find($id)->delete() ;
        }

        if($request->type == 'delete_request'){
            RequestSubmittion::find($id)->delete() ;
        }

        if($request->type == 'note_resubmit'){
            \App\AttachmentResubmit::find($id)->delete();
        }
        if($request->type == 'document'){
            \App\specialDocument::find($id)->delete();
        }
        if($request->type == 'test_equipment'){
            \App\SpecialTestEquipment::find($id)->delete();
        }
        if($request->type == 'material'){
            \App\SpecialMaterial::find($id)->delete();
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
        $data =  RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                       'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                       'SpecialDocument','SpecialTestEquipment','SpecialMaterial')->find($id) ;

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
        $input['aproval'] = auth::user()->name ;
        $input['request_submittion_id'] = $id ;
        $update = RequestSubmittion::find($id);
        $update->update($input) ;

        $input['user_id'] = auth::user()->id ;
        $reject = RequestHistory::create($input);

        $data =  RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                       'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                       'SpecialDocument','SpecialTestEquipment','SpecialMaterial')->find($id) ;

        RequestHistory::find($reject->id)->update(['data' => $data]) ;
        if(auth::user()->role == 6){
            $qsa = User::find($update->qsa_part_approve) ;
            Mail::to($qsa->email)->queue(new ChekedRequest($data));
            Mail::to($data->User->email)->queue(new NotificationUser($data));
        }else{
            Mail::to($data->User->email)->queue(new NotificationUser($data));
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
        $input['approve_name'] = auth::user()->id ;
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
        $update = RequestSubmittion::with(['SpecialRequest'])->find($id) ;


        if(auth::user()->role == 5){
            $update->update($input) ;
            $input['user_id'] = auth::user()->id ;
            $data =  RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                           'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                           'SpecialDocument','SpecialTestEquipment','SpecialMaterial')
                                     ->find($id) ;
            RequestHistory::create($input);
            Mail::to($qsa->email)->queue(new ChekedRequest($data));
        }else{
            if($update->request_type == 'Add'){
                $part_number = explode('|', $update->SpecialRequest->part_number) ;
                $cek =  \App\MasterConfig::whereIn('part_number', $part_number )->where('master_request_id', 4)->count() ;

                if($cek >= 1){
                    foreach(\App\MasterConfig::whereIn('part_number', $part_number)->get() as $pn){
                        $part[] = $pn->part_number ;
                    }
                    return ['status' => 2, 'message' => 'failed' , 'note' =>  implode(", ", $part) ] ;
                }else{
                    $update->update($input) ;
                    $data = RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                                   'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                                   'SpecialDocument','SpecialTestEquipment','SpecialMaterial')
                                             ->find($id) ;
                    $input['data'] = $data ;
                    $input['user_id'] = auth::user()->id ;

                    foreach($part_number as $pn){
                        $input['request_number'] = $data->request_number ;
                        $input['request_submittion_id'] = $data->id ;
                        $input['part_number'] = $pn ;
                        $input['master_request_id'] = 4 ;
                        $input['data'] = $data ;

                        $masterConfig = \App\MasterConfig::create($input) ;

                        $authority =  json_decode($data->SpecialRequest->for_rating, true) ;
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
                $data = RequestSubmittion::with('RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                               'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                               'SpecialDocument','SpecialTestEquipment','SpecialMaterial')
                                         ->find($id) ;

                $input['data'] = $data ;
                $input['request_number'] = $data->request_number ;
                $input['request_submittion_id'] = $data->id ;

                $input['user_id'] = auth::user()->id ;

                // add authority MasterConfig
                $part_number = explode('|', $data->SpecialRequest->part_number) ;
                $authority =  json_decode($data->SpecialRequest->for_rating, true) ;
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

                  if(\App\MasterConfig::where('part_number', $value )->where('master_request_id', 4)->count() >= 1){
                    $master = \App\MasterConfig::where('part_number', $value )->first() ;
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

                $master = \App\MasterConfig::where('part_number', $data->SpecialRequest->part_number )->where('master_request_id', 4)->first() ;

                $master->update($input) ;

                Mail::to($data->User->email)->queue(new NotificationUser($data));
            }

        }

        $res = ['status' => 1, 'message' => 'success'] ;
        return $res;
    }

    public function detail($id){
        $m = new Merger();
        $request = RequestSubmittion::with(['RequestHistory','SpecialRequest','SpecialShopAbility','SpecialPersonel',
                                       'SpecialSheetList','SpecialTools','SpecialPartList','AttachmentResubmit',
                                       'SpecialDocument','SpecialTestEquipment','SpecialMaterial'])->find($id) ;

        $pdf = PDF::loadView('detail.request_special', ['request' => $request, 'type' => 'potrait'] )
                    ->setOptions(['isPhpEnabled' => true])
                    ->setPaper('a4', 'portrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_special',  ['request' => $request, 'type' => 'lanscape'])
                    ->setOptions(['isPhpEnabled' => true])
                    ->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        if($request->SpecialRequest->attachment != null){
            $attachment = explode('|', $request->SpecialRequest->attachment) ;
            foreach ($attachment as $doc) {
                if(file_exists('uploads/special/attachment/'.$doc)){
                    $m->addFile('uploads/special/attachment/'.$doc);
                }
            }
        }

        foreach ($request->specialDocument as $doc) {
            if($doc->attachment != null){
                if(file_exists('uploads/special/document/'.$doc->attachment)){
                    $m->addFile('uploads/special/document/'.$doc->attachment);
                }
            }
            if($doc->manual_status_confirmation != null){
                if(file_exists('uploads/special/document/'.$doc->manual_status_confirmation)){
                    $m->addFile('uploads/special/document/'.$doc->manual_status_confirmation);
                }
            }
            if($doc->component_maintenance_manual != null){
                if(file_exists('uploads/special/document/'.$doc->component_maintenance_manual)){
                    $m->addFile('uploads/special/document/'.$doc->component_maintenance_manual);
                }
            }
            if($doc->proposed_pd_sheet != null){
                if(file_exists('uploads/special/document/'.$doc->proposed_pd_sheet)){
                    $m->addFile('uploads/special/document/'.$doc->proposed_pd_sheet);
                }
            }
        }


        foreach ($request->SpecialPersonel as $personel) {
            if($personel->training_certificate != null){
                if(file_exists('uploads/special/personel/'.$personel->training_certificate)){
                    $m->addFile('uploads/special/personel/'.$personel->training_certificate );
                }
            }
            if($personel->staff_authorization != null){
                if(file_exists('uploads/special/personel/'.$personel->staff_authorization)){
                    $m->addFile('uploads/special/personel/'.$personel->staff_authorization );
                }
            }
            if($personel->certificate_competence != null){
                if(file_exists('uploads/special/personel/'.$personel->certificate_competence)){
                    $m->addFile('uploads/special/personel/'.$personel->certificate_competence );
                }
            }
            if($personel->personal_ability != null){
                if(file_exists('uploads/special/personel/'.$personel->personal_ability)){
                    $m->addFile('uploads/special/personel/'.$personel->personal_ability );
                }
            }
        }

        file_put_contents('document_n_import/special/special.pdf', $m->merge());
        if(auth::user()->role == 5 || auth::user()->role == 6){
          $data = array('documents' => 'document_n_import/special/special.pdf' , 'id' => $id, 'master_request_id' => $request->master_request_id);
          return view('decision.Decision', compact('data'));
        }else{
          return response()->file('document_n_import/special/special.pdf');
        }
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
                $file->move('uploads/special/document/', $fileName);
                $converter->convert('uploads/special/document/'.$fileName, '1.4');
              }elseif($request->type == 'personel'){
                $file->move('uploads/special/personel/', $fileName);
                $converter->convert('uploads/special/personel/'.$fileName, '1.4');
              }else{
                $file->move('uploads/special/attachment/', $fileName);
                $converter->convert('uploads/special/attachment/'.$fileName, '1.4');
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
        if(auth::user()->role == 3 or auth::user()->role == 4 or auth::user()->role == 5 or auth::user()->role == 6){
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
        $data = MasterConfig::where('part_number', $request->part_number)->where('master_request_id', 4)->first()->data ;

        $data['status'] = 0 ;
        $data['request_type'] = $request->request_type ;
        $data['status_read'] = null ;
        $data['decision'] = null ;
        $data['score'] = null ;
        $data['user_id'] = auth::user()->id ;
        $data['step_request_type'] = 'New' ;
        $data['request_number'] = $this->request_number() ;

        $ekstrak = RequestSubmittion::create($data);
        if(!empty($data['special_personel'])){
          $ekstrak->SpecialPersonel()->createMany($data['special_personel']) ;
        }
        if(!empty($data['special_sheet_list'])){
          $ekstrak->SpecialSheetList()->createMany($data['special_sheet_list']) ;
        }
        if(!empty($data['special_tools'])){
          $ekstrak->SpecialTools()->createMany($data['special_tools']) ;
        }
        if(!empty($data['special_part_list'])){
          $ekstrak->SpecialPartList()->createMany($data['special_part_list']) ;
        }
        if(!empty($data['special_document'])){
          $ekstrak->SpecialDocument()->createMany($data['special_document']) ;
        }
        if(!empty($data['special_test_equipment'])){
          $ekstrak->SpecialTestEquipment()->createMany($data['special_test_equipment']) ;
        }
        if(!empty($data['special_material'])){
          $ekstrak->SpecialMaterial()->createMany($data['special_material']) ;
        }

        // untuk component main table
        $component = $data['special_request'] ;
        $component['part_number'] =  $request->part_number ;
        $component['request_number'] = $this->request_number() ;
        $component['for_rating'] = json_decode(json_encode($data['special_request']['for_rating'])) ;;
        $component['manual_revision'] = json_decode(json_encode($data['special_request']['manual_revision'])) ;;
        $component['qualified_personel'] = json_decode(json_encode($data['special_request']['qualified_personel'])) ;;
        $ekstrak->SpecialRequest()->create($component) ;

        // unutk shop ability
        $shopability = $data['special_shop_ability'] ;
        $shopability['equipment_tools'] = $data['special_shop_ability']['equipment_tools'];
        $shopability['qualified_personel'] = $data['special_shop_ability']['qualified_personel'];
        $shopability['consumable_material'] = $data['special_shop_ability']['consumable_material'];

        $ekstrak->SpecialShopAbility()->create($shopability) ;

        return ['status' => 1, 'message' => 'success', 'id' => $ekstrak->id , 'type' => 'form_special'] ;
    }

    public function request_number(){
        $request = SpecialRequest::orderBy('id','desc')->first();

        if($request){
            $cek = str_replace('SP','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 9){
            $number = 'SP00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = 'SP0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = 'SP000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = 'SP00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = 'SP0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = 'SP'.($cek+1) ;
        }

        return $number ;
    }
}
