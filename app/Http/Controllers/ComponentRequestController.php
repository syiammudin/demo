<?php

namespace App\Http\Controllers;
// require_once __DIR__.'/vendor/autoload.php';

// import the namespaces
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use App\RequestSubmittion ;
use App\ComponentRequest ;
use App\ComponentShopAbility ;
use App\RequestHistory ;
use App\ComponentEquivalent ;
use App\ComponentTestEquipment ;
use App\MasterConfig ;
use App\User ;
use Auth ;
use PDF ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ComponentRequestValidate ;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmitRequest ;
use App\Mail\ChekedRequest ;
use App\Mail\NotificationUser ;

class ComponentRequestController extends Controller
{
    public function index(Request $request)
    {   
        $type = auth::user()->component_type ;
        return RequestSubmittion::selectRaw('request_submittions.*,
                                      component_requests.part_number AS part_number ,
                                      component_requests.ata_chapter as ata_chapter,
                                      component_requests.component_type as component_type,
                                      component_requests.aircraft_type as aircraft_type')
              ->join('component_requests', 'component_requests.request_submittion_id','=', 'request_submittions.id')
              ->where('master_request_id', 2)
              ->when($type, function($q) use ($type) {
                return $q->where('component_requests.component_type', $type);
              })
              ->when($request->status, function($q) use ($request) {
                return $q->whereIn('request_submittions.status', $request->status);
              })
              ->when($request->component_type, function($q) use ($request) {
                return $q->where('component_requests.component_type', 'LIKE', '%'.$request->component_type.'%');
              })
              ->when($request->part_number, function($q) use ($request) {
                return $q->where('component_requests.part_number', 'LIKE', '%'.$request->part_number.'%');
              })
              ->when($request->ata_chapter, function($q) use ($request) {
                return $q->where('component_requests.ata_chapter', 'LIKE', '%'.$request->ata_chapter.'%');
              })
              ->when($request->aircraft_type, function($q) use ($request) {
                return $q->where('component_requests.aircraft_type', 'LIKE', '%'.$request->aircraft_type.'%');
              })
              ->when($request->request_type, function($q) use ($request) {
                return $q->where('request_submittions.request_type', 'LIKE', '%'.$request->request_type.'%');
              })
              ->when($request->search, function($q) use ($request) {
                  return $q->where(function($qq) use ($request) {
                    return $qq->where('component_requests.part_number', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('request_submittions.request_number', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('request_submittions.request_type', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('request_submittions.created_at', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('component_requests.ata_chapter', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('component_requests.aircraft_type', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('component_requests.component_type', 'LIKE', '%'.$request->search.'%');
                    });
                })
                ->when(auth()->user()->role == 1, function($q) {
                    return $q->where('request_submittions.status', '!=', 0);
                })
                ->when(auth::user()->role == 3, function($q) use($type){
                    return $q->where('user_id', auth()->user()->id)
                              ->orWhere('request_submittions.status', '>=', 1)
                              ->where('component_requests.component_type', $type) ;
                })
                ->when(auth()->user()->role == 2, function($q) {
                    return $q->where('user_id', auth()->user()->id);
                })
                ->when(auth()->user()->role == 5, function($q) use ($request) {
                    if ($request->type) {
                      return $q->whereIn('request_submittions.status',[3,8]);
                    }
                    return $q->whereIn('request_submittions.status',[4,5,6]);
                })
                ->when(auth()->user()->role == 6, function($q) use ($request) {
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
          'component_type'  => 'required',
          'request_type' => 'required',
          'part_number' => 'required',
          'component_name'  => 'required',
          'vendor_manufacturer'  => 'required',
          'aircraft_type' => 'required',
          'ata_chapter' => 'required',
          'workshop' => 'required',
          'for_rating' => 'required',
          'aproval_request_carry_out' => 'required',
          'manager_statement' => 'required',
        ]);

        $input = $request->all() ;

        if( implode('|', $request->part_number)  != ''){
            $input['part_number'] =  implode('|', $request->part_number) ;
        }else{
            $input['part_number'] =  null ;
        }
        if( implode('|', $request->aircraft_type)  != ''){
            $input['aircraft_type'] =  implode('|', $request->aircraft_type) ;
        }else{
            $input['aircraft_type'] =  null ;
        }

        $input['user_id'] = auth::user()->id ;
        $input['master_request_id'] = 2 ;
        $input['step_request_type'] = 'New' ;
        $input['request_type'] = 'Add' ;

        // $input['for_rating'] = "{}" ;
        // $input['aproval_request_carry_out'] = "{}" ;
        // $input['manager_statement'] = "{}" ;
        $input['summary_of_maintenance'] ="{}" ;
        $input['consumable_material'] ="[]" ;
        $input['request_number'] = $this->request_number() ;

        $save = RequestSubmittion::create($input) ;
        $save->ComponentRequest()->create($input) ;
        $save->ComponentShopAbility()->create($input) ;

        if($save){
            $res = ['status' => 1, 'message' => 'success', 'id' => $save->id, 'type' => $request->component_type ] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }
        return $res;
    }

    public function show($id)
    {
        return RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument',
                                        'ComponentAttachment','ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning',
                                        'ComponentManhoursPlanning','ComponentEquivalent','AttachmentResubmit'])
                                ->find($id) ;
    }

    public function update(Request $request, $id)
    {
        $input = $request->all() ;

        if( implode('|', $request->part_number)  != ''){
            $input['part_number'] =  implode('|', $request->part_number) ;
        }else{
            $input['part_number'] =  null ;
        }
        if( implode('|', $request->part_number_new)  != ''){
            $input['part_number_new'] =  implode('|', $request->part_number_new) ;
        }else{
            $input['part_number_new'] =  null ;
        }
        if( implode('|', $request->aircraft_type)  != ''){
            $input['aircraft_type'] =  implode('|', $request->aircraft_type) ;
        }else{
            $input['aircraft_type'] =  null ;
        }

        $update = RequestSubmittion::find($id)->update($input) ;
        ComponentRequest::where('request_submittion_id', $id)->first()->update($input) ;
        ComponentShopAbility::where('request_submittion_id', $id)->first()->update($input) ;

        if($update){
            $res = ['status' => 1, 'message' => 'success' ] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        return $res ;
    }

    public function submit(ComponentRequestValidate $request, $id){
        $input = $request->all() ;
        if($request->submit){
            $input['status'] = 1 ;
            $input['submit_date'] = date('Y-m-d') ;
        }


        $cek =  \App\MasterConfig::whereIn('part_number', $request->part_number )->count() ;

        if($cek >= 1 && $request->request_type == 'Add'){
            foreach(\App\MasterConfig::whereIn('part_number', $request->part_number)->get() as $pn){
                $part[] = $pn->part_number ;
            }
            return ['status' => 2, 'message' => 'failed' , 'note' =>  implode(", ", $part) ] ;
        }else{
            if($request->status == 6){
                $input['step_request_type'] ='re-Submit' ;
            }else{
                $input['step_request_type'] = 'New' ;
            }
            if( implode('|', $request->part_number_new)  != ''){
                $input['part_number_new'] =  implode('|', $request->part_number_new) ;
            }else{
                $input['part_number_new'] =  null ;
            }

            if( implode('|', $request->part_number)  != ''){
                $input['part_number'] =  implode('|', $request->part_number) ;
            }else{
                $input['part_number'] =  null ;
            }
            if( implode('|', $request->aircraft_type)  != ''){
                $input['aircraft_type'] =  implode('|', $request->aircraft_type) ;
            }else{
                $input['aircraft_type'] =  null ;
            }

            $update = RequestSubmittion::find($id) ;
            $update->update($input) ;
            ComponentRequest::where('request_submittion_id', $id)->first()->update($input) ;
            ComponentShopAbility::where('request_submittion_id', $id)->first()->update($input) ;

            if($update){
                $res = ['status' => 1, 'message' => 'success' ] ;
            }else{
                $res = ['status' => 0, 'message' => 'failed'] ;
            }

            $input['aproval'] = auth::user()->name ;

            $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory',
            'ComponentDocument','ComponentAttachment','ComponentTestEquipment','ComponentSpecialTool',
            'ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
            ->find($update->id) ;

            if($request->submit){
                $input['request_submittion_id'] = $id ;
                $input['user_id'] = auth::user()->id ;

                RequestHistory::create($input);
            }
            $gm = \App\User::where('role', 3)->where('role_request', 2)->first() ;
            Mail::to($gm->email)->queue(new SubmitRequest($data));
            return $res ;
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
        $update = RequestSubmittion::find($id) ;
        $update->update($input) ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;

        $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory',
                                        'ComponentDocument','ComponentAttachment','ComponentTestEquipment','ComponentSpecialTool',
                                        'ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                                        ->find($update->id) ;

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
        $update = RequestSubmittion::find($id);
        $update->update($input) ;
        $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                                        'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                                        ->find($id) ;
        $input['data'] = $data ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $input['user_id'] = auth::user()->id ;
        $reject = RequestHistory::create($input);
        if(auth::user()->role == 6){
          $qsa = User::find($update->qsa_part_approve);
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

        $input['approve_name'] = auth::user()->name ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $input['date_approve'] = date('Y-m-d') ;
        $update = RequestSubmittion::with(['ComponentRequest'])->find($id) ;

        if(auth::user()->role == 5){
            $update->update($input) ;
            $input['user_id'] = auth::user()->id ;
            $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                    'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                    ->find($id) ;
            RequestHistory::create($input);
            Mail::to($qsa->email)->queue(new ChekedRequest($data));
        }else{

            if($update->request_type == 'Add'){
                $part_number = explode('|', $update->ComponentRequest->part_number) ;
                $cek =  \App\MasterConfig::whereIn('part_number', $part_number )->where('master_request_id',2)->count() ;

                if($cek >= 1){
                    foreach(\App\MasterConfig::whereIn('part_number', $part_number)->get() as $pn){
                        $part[] = $pn->part_number ;
                    }
                    return ['status' => 2, 'message' => 'failed' , 'note' =>  implode(", ", $part) ] ;
                }else{
                    $update->update($input) ;
                    $input['user_id'] = auth::user()->id ;
                    $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                            'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                            ->find($id) ;

                    $input['data'] = $data ;
                    RequestHistory::create($input);

                    $fullData = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                            'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                            ->find($id) ;
                    foreach($part_number as $pn){
                        $input['request_number'] = $data->request_number ;
                        $input['request_submittion_id'] = $data->id ;
                        $input['part_number'] = $pn ;
                        $input['data'] = $fullData ;
                        $input['authority'] = $fullData->ComponentRequest->for_rating ;
                        $input['master_request_id'] = 2 ;
                        $input['component_type'] = $data->ComponentRequest->component_type ;

                        $masterConfig = \App\MasterConfig::create($input) ;

                        $authority =  json_decode($fullData->ComponentRequest->for_rating, true) ;
                        $i = 0 ;
                        $for_rating = [] ;
                        foreach (\App\ForRating::get() as $key => $value) {
                          if(!empty($authority[$value->name_of_rating])){
                            if($authority[$value->name_of_rating] == true){
                              $rating['value'] = $authority[$i] ;
                              $rating['rating'] = $authority[$i.'_name'] ;
                              $rating['status'] = $authority[$value->name_of_rating] ;
                              $rating['status_of_application'] = 1 ;

                            }
                            $for_rating[] = $rating ;
                          }
                          $i++ ;
                        }
                        $masterConfig->MasterConfigAuthority()->createMany($for_rating) ;
                    }

                    Mail::to($data->User->email)->queue(new NotificationUser($data));
                }
            }else{
                $update->update($input) ;
                if($update->ComponentRequest->part_number_new != null){
                  $pnw = "|".$update->ComponentRequest->part_number_new ;
                }else{
                  $pnw = '';
                }
                $inputPn['part_number'] = $update->ComponentRequest->part_number .$pnw ;
                $inputPn['part_number_new'] = null ;
                $cr = ComponentRequest::where('request_submittion_id', $id)->first() ;
                $cr->update($inputPn) ;

                $data = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                                                'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
                                                ->find($id) ;

                $input['request_number'] = $data->request_number ;
                $input['request_submittion_id'] = $data->id ;
                $input['master_request_id'] = 2 ;
                $input['data'] = $data ;
                $input['authority'] = $data->ComponentRequest->for_rating ;
                $input['user_id'] = auth::user()->id ;
                $input['component_type'] = $data->ComponentRequest->component_type ;


                // add authority MasterConfig
                $part_number = explode('|', $data->ComponentRequest->part_number) ;
                $authority =  json_decode($data->ComponentRequest->for_rating, true) ;

                foreach ($part_number as $value) {
                  $input['part_number'] = $value ;

                  $i = 0 ;
                  $for_rating = [] ;
                  foreach (\App\ForRating::get() as $key => $vrating) {
                    if(!empty($authority[$i])){
                      $rating['rating'] = $authority[$i.'_name'] ;
                      $rating['status'] = $authority[$vrating->name_of_rating] ;
                      $rating['value'] = $authority[$i] ;
                      if($update->request_type == 'Add Change'){
                        $rating['status_of_application'] = 1 ;
                      }

                      $for_rating[] = $rating ;
                    }
                    $i++ ;
                  }

                  if(\App\MasterConfig::where('part_number', $value )->where('master_request_id', 2)->count() >= 1){

                    $master = \App\MasterConfig::where('part_number', $value )->where('master_request_id', 2)->first() ;
                    $master->update($input) ;
                    foreach ($for_rating as $valueRating) {
                        if(\App\MasterConfigAuthority::where('rating', $valueRating['rating'])->where('master_config_id', $master->id)->count() >= 1 ){
                          $masterConfig =  \App\MasterConfigAuthority::where('rating', $valueRating['rating'])->where('master_config_id', $master->id)->first() ;
                          if($update->request_type == 'Change'){
                            $valueRating['status_of_application'] = 2 ;
                          }else{
                            $valueRating['status_of_application'] = $masterConfig->status_of_application ;
                          }
                          $masterConfig->update($valueRating);
                        }else{
                          if($valueRating['status'] == true){
                            $valueRating['master_config_id'] = $master->id ;
                            $valueRating['status_of_application'] = 1 ;
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

                Mail::to($data->User->email)->queue(new NotificationUser($data));
            }

            foreach (explode('|', $update->ComponentRequest->part_number) as $value) {
                if(\App\PartNumber::where('part_number', $value)->count() != 1 ){
                    $inputPn['part_number'] = $value ;
                    $inputPn['part_description'] = $update->ComponentRequest->component_name ;
                    \App\PartNumber::create($inputPn);
                }
            }

        }

        $res = ['status' => 1, 'message' => 'success'] ;
        return $res;
    }

    public function detail($id)
    {
        $m = new Merger();
        $request = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory','ComponentDocument','ComponentAttachment',
                                        'ComponentTestEquipment','ComponentSpecialTool','ComponentMaterialPlanning','ComponentManhoursPlanning'])
                                   ->find($id) ;

        $pdf = PDF::loadView('detail.component.coverComponent', ['request' => $request ] )
                                   ->setPaper('a4', 'portrait');
                                   $m->addRaw($pdf->output());

        if($request->ComponentRequest->component_type == 'TCE' || $request->ComponentRequest->component_type == 'TCW'){
            $pdf = PDF::loadView('detail.component.headerComponent', ['request' => $request, 'type' => 'potrait'] )
                        ->setOptions(['isPhpEnabled' => true])
                        ->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.component.ComponentTCERquest',  ['request' => $request, 'type' => 'lanscape'])
                        ->setOptions(['isPhpEnabled' => true])
                        ->setPaper('a4', 'landscape');
                        $m->addRaw($pdf->output());

        }

        if($request->ComponentRequest->component_type == 'TCA'){
            $pdf = PDF::loadView('detail.component.headerComponent', ['request' => $request, 'type' => 'potrait'] )
                    ->setOptions(['isPhpEnabled' => true])
                    ->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.component.ComponentTCARquest',  ['request' => $request, 'type' => 'lanscape'])
                                ->setOptions(['isPhpEnabled' => true])
                                ->setPaper('a4', 'landscape');
            $m->addRaw($pdf->output());
        }

        if($request->ComponentRequest->component_type == 'TBR' || $request->ComponentRequest->component_type == 'TNO'){
            $pdf = PDF::loadView('detail.component.headerComponent', ['request' => $request, 'type' => 'potrait'] )
                    ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.component.ComponentTBRRquest',  ['request' => $request, 'type' => 'lanscape'])
                                ->setOptions(['isPhpEnabled' => true])
                                ->setPaper('a4', 'landscape');
            $m->addRaw($pdf->output());
        }

        if($request->ComponentRequest->component_type == 'Engine'){
            $pdf = PDF::loadView('detail.component.headerComponent', ['request' => $request, 'type' => 'potrait'] )
                                ->setOptions(['isPhpEnabled' => true])
                                ->setPaper('a4', 'portrait');
            $m->addRaw($pdf->output());

            $pdf = PDF::loadView('detail.component.component_engine',  ['request' => $request, 'type' => 'lanscape'])
                                ->setOptions(['isPhpEnabled' => true])
                                ->setPaper('a4', 'landscape');
            $m->addRaw($pdf->output());

            if (count($request->ComponentPersonel) > 3) {
              $pdf = PDF::loadView('detail.component.component_engine',  ['request' => $request, 'type' => 'potrait2'])
              ->setPaper('a4', 'potrait');
              $m->addRaw($pdf->output());
            }
        }

        $test = \App\ComponentTestEquipment::where('request_submittion_id', $request->id)->get();
        foreach ($test as $data) {
            if($data->attachment !=null){
                if(file_exists('uploads/component/test_equipment/'.$data->attachment)){
                    $m->addFile('uploads/component/test_equipment/'.$data->attachment);
                }
            }
        }
        $specialtool = \App\ComponentSpecialTool::where('request_submittion_id', $request->id)->get();
        foreach ($specialtool as $data) {
            if($data->attachment !=null){
                if(file_exists('uploads/component/special_tools/'.$data->attachment)){
                    $m->addFile('uploads/component/special_tools/'.$data->attachment);
                }
            }
        }

        foreach ($request->ComponentDocument as $doc) {
            if($doc->attachment != null){
                if(file_exists('uploads/component/document/'.$doc->attachment)){
                    $m->addFile('uploads/component/document/'.$doc->attachment);
                }
            }
            if($doc->manual_status_confirmation != null){
                if(file_exists('uploads/component/document/'.$doc->manual_status_confirmation)){
                    $m->addFile('uploads/component/document/'.$doc->manual_status_confirmation);
                }
            }
            if($doc->component_maintenance_manual != null){
                if(file_exists('uploads/component/document/'.$doc->component_maintenance_manual)){
                    $m->addFile('uploads/component/document/'.$doc->component_maintenance_manual);
                }
            }
            if($doc->proposed_pd_sheet != null){
                if(file_exists('uploads/component/document/'.$doc->proposed_pd_sheet)){
                    $m->addFile('uploads/component/document/'.$doc->proposed_pd_sheet);
                }
            }
        }


        foreach ($request->ComponentPersonel as $personel) {
            if($personel->training_certificate != null){
                if(file_exists('uploads/component/personel/'.$personel->training_certificate)){
                    $m->addFile('uploads/component/personel/'.$personel->training_certificate );
                }
            }
            if($personel->staff_authorization != null){
                if(file_exists('uploads/component/personel/'.$personel->staff_authorization )){
                    $m->addFile('uploads/component/personel/'.$personel->staff_authorization );
                }
            }
            if($personel->certificate_competence != null){
                if(file_exists('uploads/component/personel/'.$personel->certificate_competence)){
                    $m->addFile('uploads/component/personel/'.$personel->certificate_competence );
                }
            }
            if($personel->personal_ability != null){
                if(file_exists('uploads/component/personel/'.$personel->personal_ability )){
                    $m->addFile('uploads/component/personel/'.$personel->personal_ability );
                }
            }
        }

        if($request->ComponentAttachment != null){
            if($request->ComponentAttachment->vendor_statement != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->vendor_statement)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->vendor_statement);
                }
            }
            if($request->ComponentAttachment->simple_component_evaluation != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->simple_component_evaluation)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->simple_component_evaluation);
                }
            }
            if($request->ComponentAttachment->component_similarity != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->component_similarity)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->component_similarity);
                }
            }
            if($request->ComponentAttachment->maintenance_record != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->maintenance_record)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->maintenance_record);
                }
            }
            if($request->ComponentAttachment->sample_component_relase != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->sample_component_relase)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->sample_component_relase);
                }
            }
            if($request->ComponentAttachment->other != null){
                if(file_exists('uploads/component/attachment/'.$request->ComponentAttachment->other)){
                    $m->addFile('uploads/component/attachment/'.$request->ComponentAttachment->other);
                }
            }
        }

        file_put_contents('document_n_import/component/ComponentRequest.pdf', $m->merge());

        if(auth::user()->role == 5 || auth::user()->role == 6){
            $data = array('documents' => 'document_n_import/component/ComponentRequest.pdf' , 'id' => $id , 'master_request_id' => $request->master_request_id  );
            return view('decision.Decision', compact('data'));
        }else{
            return response()->file('document_n_import/component/ComponentRequest.pdf');
        }

    }

    public function destroy(Request $request,$id){
        if($request->type == 'note_resubmit'){
            \App\AttachmentResubmit::find($id)->delete();
        }
        if($request->type == 'delete_request'){
            \App\RequestSubmittion::find($id)->delete();
        }
        return 'success' ;
    }

    public function ekstracData(Request $request){
        $data = MasterConfig::where('part_number', $request->part_number)->first()->data ;
        $data['status'] = 0 ;
        $data['request_type'] = $request->request_type ;
        $data['status_read'] = null ;
        $data['decision'] = null ;
        $data['score'] = null ;
        $data['step_request_type'] = 'New' ;
        $data['user_id'] = auth::user()->id ;
        $data['request_number'] = $this->request_number() ;

        $ekstrak = RequestSubmittion::create($data);

        if(!empty($data['component_document'])){
          $ekstrak->ComponentDocument()->createMany($data['component_document']) ;
        }
        if(!empty($data['component_personel'])){
          $ekstrak->ComponentPersonel()->createMany($data['component_personel']) ;
        }
        if(!empty($data['component_test_equipment'])){
          $ekstrak->ComponentTestEquipment()->createMany($data['component_test_equipment']) ;
        }
        if(!empty($data['component_special_tool'])){
          $ekstrak->ComponentSpecialTool()->createMany($data['component_special_tool']) ;
        }
        if(!empty($data['component_material_planning'])){
          $ekstrak->ComponentMaterialPlanning()->createMany($data['component_material_planning']) ;
        }
        if(!empty($data['component_manhours_planning'])){
          $ekstrak->ComponentManhoursPlanning()->createMany($data['component_manhours_planning']) ;
        }

        if(!empty($data['component_attachment'])){
            $ekstrak->ComponentAttachment()->create($data['component_attachment']) ;
        }
        // untuk component main table
        $component = $data['component_request'] ;
        // $component['part_number'] = $request->part_number ;
        $component['component_type'] =  $request->component_type ;
        $component['request_number'] = $this->request_number() ; ;
        $component['for_rating'] = json_decode(json_encode($data['component_request']['for_rating'])) ;
        $component['aproval_request_carry_out'] = json_decode(json_encode($data['component_request']['aproval_request_carry_out'])) ;
        $component['manager_statement'] = json_decode(json_encode($data['component_request']['manager_statement'])) ;
        $ekstrak->ComponentRequest()->create($component) ;

        // unutk shop ability
        $shopability = $data['component_shop_ability'] ;
        $shopability['summary_of_maintenance'] = $data['component_shop_ability']['summary_of_maintenance'];
        $shopability['capability_level'] = $data['component_shop_ability']['capability_level'];
        $shopability['consumable_material'] = $data['component_shop_ability']['consumable_material'];
        $shopability['test_condition'] = $data['component_shop_ability']['test_condition'];
        $shopability['storage_condition'] = $data['component_shop_ability']['storage_condition'];

        $ekstrak->ComponentShopAbility()->create($shopability) ;

        return ['status' => 1, 'message' => 'success', 'id' => $ekstrak->id , 'type' => $request->component_type] ;
    }

    public function request_number(){
        $request = ComponentRequest::orderBy('id','desc')->first();

        if($request){
            $cek = str_replace('CP','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 9){
            $number = 'CP00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = 'CP0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = 'CP000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = 'CP00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = 'CP0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = 'CP'.($cek+1) ;
        }

        return $number ;
    }

}
