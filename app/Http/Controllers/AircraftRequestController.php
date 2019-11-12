<?php

namespace App\Http\Controllers;
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;
use Illuminate\Http\Request;
use Auth ;
use App\RequestSubmittion ;
use App\AdditionalAttachment ;
use App\AircraftRequest ;
use App\AircraftAuthorizedPersonel ;
use App\AircraftDocument ;
use App\AircraftMaterial ;
use App\AircraftToolEquipment;
use App\AircraftFacility;
use App\RequestHistory ;
use App\MasterConfig ;
use App\Hangar ;
use App\MaintenanceArea ;
use App\User ;
use PDF ;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmitRequest ;
use App\Mail\ChekedRequest ;
use App\Mail\NotificationUser ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;

class AircraftRequestController extends Controller
{
    public function index(Request $request) {
      return RequestSubmittion::selectRaw('request_submittions.*,
                                            aircraft_requests.aircraft_type AS aircraft_type ,
                                            aircraft_requests.aircraft_manufacturer  as aircraft_manufacturer,
                                            aircraft_requests.customer  as customer,
                                            aircraft_requests.authority  as authority,
                                            aircraft_requests.maintenance_area_value  as maintenance_area_value,
                                            aircraft_requests.number as number')
            ->join('aircraft_requests', 'aircraft_requests.request_submittion_id','=', 'request_submittions.id')
            ->when($request->search, function($q) use ($request) {
                return $q->where(function($qq) use ($request) {
                  return $qq->where('aircraft_requests.aircraft_type', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('aircraft_requests.aircraft_manufacturer', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_number', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('request_submittions.request_type', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('aircraft_requests.customer', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('aircraft_requests.maintenance_area_value', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('aircraft_requests.authority', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('aircraft_requests.number', 'LIKE', '%'.$request->search.'%');
                });
            })
            ->where('master_request_id', 1)
            ->when($request->status, function($q) use ($request) {
                return $q->whereIn('request_submittions.status', $request->status);
            })
            ->when($request->customer, function($q) use ($request) {
                return $q->where('aircraft_requests.customer', 'LIKE', '%'.$request->customer.'%');
            })
            ->when($request->rating, function($q) use ($request) {
                return $q->where('aircraft_requests.authority','LIKE', '%'. $request->rating.'%');
            })
            ->when($request->aircraft_type, function($q) use ($request) {
                return $q->where('aircraft_requests.aircraft_type', 'LIKE', '%'.$request->aircraft_type.'%');
            })
            ->when($request->maintenance_area, function($q) use ($request) {
                return $q->where('aircraft_requests.maintenance_area_value', 'LIKE', '%'.$request->maintenance_area.'%');
            })
            ->when(in_array(auth()->user()->role, ['1','4']), function($q) {
                return $q->where('status', '!=', 0);
            })
            ->when(auth()->user()->role == 3, function($q) {
                return $q->where('user_id', auth()->user()->id)->orWhere('status', '>=', 1);
            })
            ->when(auth()->user()->role == 2, function($q) {
                return $q->where('user_id', auth()->user()->id);
            })
            ->when(auth()->user()->role == 5, function($q) use ($request) {
                if ($request->type) {
                  return $q->whereIn('status',[3,8]);
                }
                return $q->whereIn('status',[4,5,6]);
            })->when(auth()->user()->role == 6, function($q) use ($request) {
              if ($request->type) {
                return $q->whereIn('status',[4]);
              }
              return $q->whereIn('status',[4,5,6]);
            })->orderBy($request->sort ? $request->sort : 'request_number', $request->order == 'ascending' ? 'asc' : 'desc')->paginate($request->pageSize) ;
    }

    public function show($id){
        return  RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                         'AircraftAuthorizedPersonel','AircraftMaterial',
                                         'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                ->where('id', $id)->get();
    }

    public function store(Request $request){

        $request->validate([
            'number' => 'required',
            'aircraft_type' => 'required',
            'aircraft_manufacturer' => 'required',
            'request_type' => 'required',
            'maintenance_area_value' => 'required',
            'maintenance_area' => 'required',
            'authority' => 'required',
            'ability' => 'required',
            'manager_statement' => 'required',
        ]);

        $input = $request->all() ;

        $cek = MasterConfig::where('maintenance_area', $request->maintenance_area )
                            ->where('maintenance_area_value', $request->maintenance_area_value )
                            ->where('aircraft_type', $request->aircraft_type)
                            ->where('aircraft_rating', $request->authority)
                            ->where('customer', $request->customer)
                            ->count();
        if($cek > 0 && $request->type == 'Add'){
            return ['status' => 2, 'message' => 'Already on Config'] ;
        }

        if($request->maintenance_area_value == 'Other Base'){
            $input['maintenance_area_value'] = $request->other_base ;
            $addnew['hangar_name'] =  $request->other_base;
            Hangar::create($addnew) ;
        }
        if($request->maintenance_area_value == 'Other line'){
            $input['maintenance_area_value'] = $request->other_line_code ;
            $addnew['code'] = $request->other_line_code;
            $addnew['description'] = $request->other_line_description;
            MaintenanceArea::create($addnew) ;
        }

        $input['user_id'] = auth::user()->id;

        if($request->request_id){
             RequestSubmittion::find($request->request_id)->update($input) ;
             AircraftRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;

            foreach ($request->personel as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftAuthorizedPersonel::create($data) ;
                }else{
                    AircraftAuthorizedPersonel::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->doc as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftDocument::create($data) ;
                }else{
                    AircraftDocument::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->material as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftMaterial::create($data) ;
                } else {
                    AircraftMaterial::find($data['id'])->update($data);
                }
            }

            foreach ($request->tools as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftToolEquipment::create($data) ;
                }else{
                    AircraftToolEquipment::find($data['id'])->update($data) ;
                }
            }

            foreach ($request->list_facilities as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftFacility::create($data) ;
                }else{
                    AircraftFacility::find($data['id'])->update($data) ;
                }
            }
            foreach ($request->list_additional_attachment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AdditionalAttachment::create($data) ;
                }else{
                    AdditionalAttachment::find($data['id'])->update($data) ;
                }
            }

            $request_submittion = RequestSubmittion::find($request->request_id);
        }else{
            $input['request_number'] = $this->request_number() ;
            $input['status'] = 0;
            $request_submittion = RequestSubmittion::create($input) ;
            $request_submittion->AircraftRequest()->create($input) ;
            $request_submittion->AircraftAuthorizedPersonel()->createMany($request->personel) ;
            $request_submittion->AircraftDocument()->createMany($request->doc) ;
            $request_submittion->AircraftMaterial()->createMany($request->material) ;
            $request_submittion->AircraftToolEquipment()->createMany($request->tools) ;
            $request_submittion->AircraftFacility()->createMany($request->list_facilities) ;
            $request_submittion->AdditionalAttachment()->createMany($request->list_additional_attachment) ;
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
          'number' => 'required',
          'aircraft_type' => 'required',
          'aircraft_manufacturer' => 'required',
          'request_type' => 'required',
          'authority' => 'required',
          'maintenance_area' => 'required',
          'maintenance_area_value' => 'required',
          'ability' => 'required',
      ]);


        $input = $request->all() ;

        if($request->status == 6){
            $input['step_request_type'] ='re-Submit' ;
        }else{
            $input['step_request_type'] = 'New' ;
        }

        $input['submit_date'] = date('Y-m-d') ;

        if($request->request_id){
            $input['status'] = 1;
            $input['request_submittion_id'] = $request->request_id ;
            $input['aproval'] = auth::user()->name ;
            $input['user_id'] = auth::user()->id ;

            AircraftRequest::where('request_submittion_id',$request->request_id)->first()->update($input) ;
            RequestSubmittion::find($request->request_id)->update($input) ;

            foreach ($request->personel as $data) {
               $data['request_submittion_id'] = $request->request_id ;
               if(empty($data['id'])){
                   AircraftAuthorizedPersonel::create($data) ;
               }else{
                   AircraftAuthorizedPersonel::find($data['id'])->update($data) ;
               }
            }
            foreach ($request->doc as $data) {
               $data['request_submittion_id'] = $request->request_id ;
               if(empty($data['id'])){
                   AircraftDocument::create($data) ;
               }else{
                   AircraftDocument::find($data['id'])->update($data) ;
               }
            }
            foreach ($request->material as $data) {
               $data['request_submittion_id'] = $request->request_id ;
               if(empty($data['id'])){
                   AircraftMaterial::create($data) ;
               } else {
                   AircraftMaterial::find($data['id'])->update($data);
               }
            }

            foreach ($request->tools as $data) {
               $data['request_submittion_id'] = $request->request_id ;
               if(empty($data['id'])){
                   AircraftToolEquipment::create($data) ;
               }else{
                   AircraftToolEquipment::find($data['id'])->update($data) ;
               }
            }

            foreach ($request->list_facilities as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AircraftFacility::create($data) ;
                }else{
                    AircraftFacility::find($data['id'])->update($data) ;
                }
            }

            foreach ($request->list_additional_attachment as $data) {
                $data['request_submittion_id'] = $request->request_id ;
                if(empty($data['id'])){
                    AdditionalAttachment::create($data) ;
                }else{
                    AdditionalAttachment::find($data['id'])->update($data) ;
                }
            }
            RequestHistory::create($input);
            $submit = RequestSubmittion::find($request->request_id) ;
            $submit->update($input) ;

        }else{
            $input['status'] = 1;
            $input['user_id'] = auth::user()->id;
            $input['request_number'] = $this->request_number() ;

            $submit = RequestSubmittion::create($input) ;
            if($request->cek_lm == false){
                $input['line_maintenance'] = null ;
            }

            if($request->other_area == false){
                $input['other'] = null ;
            }

            $input['request_submittion_id'] = $submit->id ;
            $input['aproval'] = auth::user()->name ;
            RequestHistory::create($input);

            $submit->AircraftRequest()->create($input) ;
            $submit->AircraftAuthorizedPersonel()->createMany($request->personel) ;
            $submit->AircraftDocument()->createMany($request->doc) ;
            $submit->AircraftMaterial()->createMany($request->material) ;
            $submit->AircraftToolEquipment()->createMany($request->tools) ;
            $submit->AircraftFacility()->createMany($request->list_facilities) ;
            $submit->AdditionalAttachment()->createMany($request->list_additional_attachment) ;
        }

        if($submit){
            $res = ['status' => 1, 'message' => 'success'] ;
        }else{
            $res = ['status' => 0, 'message' => 'failed'] ;
        }

        $data = RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                         'AircraftAuthorizedPersonel','AircraftMaterial',
                                         'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                         ->find($submit->id) ;

        $manager = \App\User::where('role', 3)->where('role_request', 1)->get() ;
        $email = array_map(
                 function($mail) { return $mail['email']; },
                    $manager->toArray()
                 );

        Mail::to($email)->queue(new SubmitRequest($data));

        return $res ;
    }

    public function checked($id)
    {
        if(auth::user()->role == 3){
            $input['status'] = 2 ;
            $user = \App\User::where('role', 4)->where('role_request', 1)->get() ;
            $email = array_map(
                     function($mail) { return $mail['email']; },
                        $user->toArray()
                     );
        }
        if(auth::user()->role == 4){
            $input['status'] = 3 ;
            $email = \App\User::where('role', 5)->first()->email ;
        }

        $input['checked_name'] = auth::user()->id ;
        $update = RequestSubmittion::find($id)->update($input) ;
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;

        $data = RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                         'AircraftAuthorizedPersonel','AircraftMaterial',
                                         'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                         ->find($id) ;

        $input['user_id'] = auth::user()->id ;
        RequestHistory::create($input);

        Mail::to($email)->queue(new ChekedRequest($data));
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
        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;

        $input['user_id'] = auth::user()->id ;
        $reject = RequestHistory::create($input);

        $data = RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                         'AircraftAuthorizedPersonel','AircraftMaterial',
                                         'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                         ->find($id) ;
        RequestHistory::find($reject->id)->update(['data' => $data]) ;

        if(auth::user()->role == 6){
          $qsa = User::find($update->qsa_part_approve );
          Mail::to($qsa->email)->queue(new ChekedRequest($data));
          Mail::to($data->User->email)->queue(new NotificationUser($data));
        }else{
          Mail::to($data->User->email)->queue(new NotificationUser($data));
        }

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
        $input['date_approve'] = date('Y-m-d') ;
        if(auth::user()->role == 5){
            $input['status'] = 4 ;
            $role = 6 ;
        }
        if(auth::user()->role == 6){
            $input['status'] = 5 ;
            $role = 5;
        }

        $qsa = \App\User::where('role', $role )->first() ;

        $input['request_submittion_id'] = $id ;
        $input['aproval'] = auth::user()->name ;
        $update = RequestSubmittion::with(['AircraftRequest'])->find($id) ;

        $config['ability'] = $update->AircraftRequest->ability ;
        $config['maintenance_area'] = $update->AircraftRequest->maintenance_area ;
        $config['maintenance_area_value'] = $update->AircraftRequest->maintenance_area_value ;
        $config['request_type'] = $update->request_type ;
        $config['aircraft_type'] = $update->AircraftRequest->aircraft_type ;
        $config['customer'] = $update->AircraftRequest->customer ;
        $config['aircraft_rating'] = $update->AircraftRequest->authority ;
        $config['request_number'] = $update->request_number ;
        $config['request_submittion_id'] = $update->id ;

        if(auth::user()->role == 5){
            $update->update($input) ;
            $data =   RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                             'AircraftAuthorizedPersonel','AircraftMaterial',
                                             'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                             ->find($id) ;

            Mail::to($qsa->email)->queue(new ChekedRequest($data));
            $input['data'] = $data ;
            $input['user_id'] = auth::user()->id ;
            RequestHistory::create($input);
        }else{
            if($update->request_type == 'Add'){
                $cek = MasterConfig::where('maintenance_area', $config['maintenance_area'] )
                                    ->where('maintenance_area_value', $config['maintenance_area_value'] )
                                    ->where('aircraft_type', $config['aircraft_type'])
                                    ->where('aircraft_rating', $config['aircraft_rating'])
                                    ->where('customer', $config['customer'])
                                    ->count();
                                    // where('ability', $config['ability'] )
                                    //                     ->

                if($cek >= 1){
                    $note = MasterConfig::where('ability', $config['ability'] )
                                        ->where('maintenance_area', $config['maintenance_area'] )
                                        ->where('maintenance_area_value', $config['maintenance_area_value'] )
                                        ->where('aircraft_type', $config['aircraft_type'])
                                        ->where('aircraft_rating', $config['aircraft_rating'])
                                        ->where('customer', $config['customer'])
                                        ->first();
                    return ['status' => 2, 'message' => 'failed' , 'note' =>  $note ] ;
                }else{
                    $update->update($input) ;
                    $data =   RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                                     'AircraftAuthorizedPersonel','AircraftMaterial',
                                                     'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                                     ->find($id) ;
                    $input['data'] = $data ;
                    $input['user_id'] = auth::user()->id ;
                    RequestHistory::create($input);

                    $config['request_submittion_id'] = $data->id ;
                    $config['master_request_id'] = 1 ;
                    $config['data'] = $data ;
                    \App\MasterConfig::create($config) ;

                    Mail::to($data->User->email)->queue(new NotificationUser($data));
                }
            }elseif($update->request_type == 'Delete'){
                $update->update($input) ;
                $master = MasterConfig::where('ability', $config['ability'] )
                                    ->where('maintenance_area', $config['maintenance_area'] )
                                    ->where('maintenance_area_value', $config['maintenance_area_value'] )
                                    ->where('aircraft_type', $config['aircraft_type'])
                                    ->where('aircraft_rating', $config['aircraft_rating'])
                                    ->where('customer', $config['customer'])
                                    ->first() ;
                $master->delete();
                $data =   RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                                 'AircraftAuthorizedPersonel','AircraftMaterial',
                                                 'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                                 ->find($id) ;

                $input['data'] = $data ;
                $input['request_submittion_id'] = $data->id ;

                $input['user_id'] = auth::user()->id ;
                RequestHistory::create($input);
                Mail::to($data->User->email)->queue(new NotificationUser($data));
            }else{
                $update->update($input) ;
                $data =  RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                                 'AircraftAuthorizedPersonel','AircraftMaterial',
                                                 'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])
                                                 ->find($id) ;

                $input['data'] = $data ;
                $input['request_submittion_id'] = $data->id ;

                $input['user_id'] = auth::user()->id ;
                RequestHistory::create($input);
                $cek = MasterConfig::where('ability', $config['ability'] )
                                    ->where('maintenance_area', $config['maintenance_area'] )
                                    ->where('maintenance_area_value', $config['maintenance_area_value'] )
                                    ->where('aircraft_type', $config['aircraft_type'])
                                    ->where('aircraft_rating', $config['aircraft_rating'])
                                    ->where('customer', $config['customer'])
                                    ->count();

                if($cek >= 1){
                  return ['status' => 2, 'message' => 'failed' , 'note' =>  $config ] ;
                }else{
                  $master = MasterConfig::where('maintenance_area', $config['maintenance_area'] )
                                        ->where('maintenance_area_value', $config['maintenance_area_value'] )
                                        ->where('aircraft_type', $config['aircraft_type'])
                                        ->where('aircraft_rating', $config['aircraft_rating'])
                                        ->where('customer', $config['customer'])
                                        ->first() ;
                }


                $master->update($input) ;

                Mail::to($data->User->email)->queue(new NotificationUser($data));
            }

        }
        $res = ['status' => 1, 'message' => 'success'] ;
        return $res;
    }

    public function detail($id)
    {

        $m = new Merger();
        $request = RequestSubmittion::with(['RequestHistory','AircraftRequest', 'AircraftDocument',
                                         'AircraftAuthorizedPersonel','AircraftMaterial',
                                         'AircraftToolEquipment','AttachmentResubmit','AircraftFacility','AdditionalAttachment'])->find($id) ;

        $pdf = PDF::loadView('detail.request_aircraft', ['request' => $request, 'type' => 'cover'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft', ['request' => $request, 'type' => 'potrait'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft',  ['request' => $request, 'type' => 'landscape'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft', ['request' => $request, 'type' => 'content'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft',  ['request' => $request, 'type' => 'amel'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft', ['request' => $request, 'type' => 'apendixcs'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft',  ['request' => $request, 'type' => 'cs'])->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
        $m->addRaw($pdf->output());

        $pdf = PDF::loadView('detail.request_aircraft',  ['request' => $request, 'type' => 'potrait2'])->setPaper('a4', 'potrait');
        $m->addRaw($pdf->output());

        foreach ($request->AircraftDocument as $d) {
            if($d->attachment != null){
                if(file_exists('uploads/aircraft/document/'.$d->attachment)){
                    $m->addFile('uploads/aircraft/document/'.$d->attachment);
                }
            }
        }
        foreach ($request->AdditionalAttachment as $value) {
            if(file_exists('uploads/aircraft/additionalAttachment/'.$value->name_attachment)){
                $m->addFile('uploads/aircraft/additionalAttachment/'.$value->name_attachment);
            }
        }

        if(auth::user()->role == 5 || auth::user()->role == 6){
          file_put_contents('document_n_import/aircraft/AircraftRequest.pdf', $m->merge());
          $data = array('documents' => 'document_n_import/aircraft/AircraftRequest.pdf' , 'id' => $id, 'master_request_id' => $request->master_request_id );
          return view('decision.Decision', compact('data'));
        }else{
          file_put_contents('document_n_import/aircraft/AircraftRequest.pdf', $m->merge());
          return response()->file('document_n_import/aircraft/AircraftRequest.pdf');
          return $pdf->stream();
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

    public function destroy(Request $request, $id){
        if($request->type == 'auth_personel'){
            AircraftAuthorizedPersonel::find($id)->delete() ;
        }

        if($request->type == 'document'){
            AircraftDocument::find($id)->delete() ;
        }

        if($request->type == 'material'){
            AircraftMaterial::find($id)->delete() ;
        }

        if($request->type == 'tools'){
            AircraftToolEquipment::find($id)->delete() ;
        }

        if($request->type == 'delete_request'){
            RequestSubmittion::find($id)->delete() ;
        }

        if($request->type == 'note_resubmit'){
            \App\AttachmentResubmit::find($id)->delete();
        }

        if($request->type == 'facilities'){
            \App\AircraftFacility::find($id)->delete();
        }


        if($request->type == 'allMaterial'){
            return AircraftMaterial::destroy($request->all()) ;
        }
        if($request->type == 'allPersonel'){
            return AircraftAuthorizedPersonel::destroy($request->all()) ;
        }
        if($request->type == 'allDocument'){
            return AircraftDocument::destroy($request->all()) ;
        }
        if($request->type == 'allTestEquipment'){
            return AircraftToolEquipment::destroy($request->all()) ;
        }
        if($request->type == 'allFacility'){
            return  \App\AircraftFacility::destroy($request->all()) ;
        }
        return 'success' ;
    }

    public function upload(Request $request)
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
                if(!empty($request->type)){
                  $file->move('uploads/aircraft/additionalAttachment/', $fileName);
                  $converter->convert('uploads/aircraft/additionalAttachment/'.$fileName, '1.4');
                }else{
                  $file->move('uploads/aircraft/document/', $fileName);
                  $converter->convert('uploads/aircraft/document/'.$fileName, '1.4');
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

    public function importExcel(Request $request){
        if($request->hasFile('excelfile')){
            $path = $request->file('excelfile')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        if($request->type == 'personel' && $v['name'] != ''){
                            $insert[] = array(
                                'name' => $v['name'],
                                'personal_number' => $v['id_number'],
                                'sta' => $v['unit'],
                                'stamp_no' => $v['stamp_no'],
                                'skill' => $v['skill'],
                                'amel_no' => $v['amel_no'],
                                'license_type' => $v['license_type'],
                                'ex_date_ame' => date('Y-m-d', strtotime($v['ex_date_ame'])),
                                'gmf_auth_number' => $v['gmf_auth_number'],
                                'ex_date_company' =>  date('Y-m-d', strtotime($v['ex_date_company'])),
                            );
                        }
                        if($request->type == 'document' && $v['document_code'] != ''){
                            $insert[] = array(
                                'document_code' => $v['document_code'],
                                'type' => $v['type'],
                                'description_document' => $v['description'],
                                'manufacture' => $v['manufacture'],
                                'ac_type' => $v['ac_type'],
                                'rev' => $v['rev'],
                                'effective_code' => $v['effective_code'] ,
                                'rev_date' => date('Y-m-d', strtotime($v['rev_date'])),
                            );
                        }
                        if($request->type == 'material' && $v['part_number'] != ''){
                            $insert[] = array(
                                'description_material' => $v['description_material'],
                                'pn' => $v['part_number'],
                                'availability' => $v['availability'],
                                'camp_number' => $v['camp_number'],
                                'jobcard_number' => $v['jobcard_number'],
                                'title' => $v['title'],
                                'mpd_number' => $v['mpd_number'],
                                'references' => $v['references'],
                                'interval' =>  $v['interval'],
                                'qty' =>  $v['qty'],
                            );
                        }
                        if($request->type == 'tools'){
                          if($v['description'] != null || $v['description'] != ''){
                            $insert[] = array(
                              'description_tools' => $v['description'],
                              'part_no' => $v['part_number'],
                              'qty' => $v['qty'],
                              // 'unit' => $v['unit'],
                              // 'remark' => $v['remark'],
                              'camp_number' => $v['camp_number'],
                              'jobcard_number' => $v['jobcard_number'],
                              'title' => $v['title'],
                              'mpd_number' =>  $v['mpd_no'],
                              'references' =>  $v['references'],
                              'interval' =>  $v['interval'],
                              'location' =>  $v['location'],
                            );
                          }
                        }
                        if($request->type == 'facilities'){
                            $insert[] = array(
                                'description_main' => $v['description'],
                                'description' => $v['sub_description'],
                                'quantity' => $v['qty'],
                                'unit' => $v['unit'],
                                'status' => $v['status'],
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

    public function action_file(Request $request){
        $file_path = public_path().'/uploads/aircraft/document'.$request->file;
        if(file_exists($file_path)){
            unlink($file_path);
        }

        return 'ok';
    }

    public function ekstracData(Request $request){
        $data = MasterConfig::find($request->master_config_id)->data ;
        $input = $data['aircraft_request'] ;
        $input['status'] = 0 ;
        $input['request_type'] = $request->request_type ;
        $input['status_read'] = null ;
        $input['decision'] = null ;
        $input['score'] = null ;
        $input['master_request_id'] = 1 ;
        $input['step_request_type'] = 'New' ;
        $input['user_id'] = auth::user()->id ;
        $input['request_number'] = $this->request_number() ;

        $ekstrak = RequestSubmittion::create($input);
        $ekstrak->AircraftRequest()->create($input) ;
        if(!empty($data['aircraft_authorized_personel'])){
          $ekstrak->AircraftAuthorizedPersonel()->createMany($data['aircraft_authorized_personel']) ;
        }
        if(!empty($data['aircraft_material'])){
          $ekstrak->AircraftMaterial()->createMany($data['aircraft_material']) ;
        }
        if(!empty($data['aircraft_tool_equipment'])){
          $ekstrak->AircraftToolEquipment()->createMany($data['aircraft_tool_equipment']) ;
        }
        if(!empty($data['aircraft_document'])){
          $ekstrak->AircraftDocument()->createMany($data['aircraft_document']) ;
        }
        if(!empty($data['aircraft_facility'])){
          $ekstrak->AircraftFacility()->createMany($data['aircraft_facility']) ;
        }

        return ['status' => 1, 'message' => 'success', 'id' => $ekstrak->id , 'type' => 'form_aircraft'] ;
    }

    public function request_number(){
        $request = AircraftRequest::orderBy('request_number','desc')->first();

        if($request){
            $cek = str_replace('AR','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }

        if($cek < 9){
            $number = 'AR00000'.($cek+1) ;
        }
        elseif($cek < 99){
            $number = 'AR0000'.($cek+1) ;
        }
        elseif($cek < 999){
            $number = 'AR000'.($cek+1) ;
        }
        elseif($cek < 9999){
            $number = 'AR00'.($cek+1) ;
        }
        elseif($cek < 99999){
            $number = 'AR0'.($cek+1) ;
        }
        elseif($cek < 999999){
            $number = 'AR'.($cek+1) ;
        }

        return $number ;
    }

    public function facilities(Request $request){
        $cek = \App\MasterFacility::where('description',$request->description_main)->count() ;
        if($cek == 0){
            $input['description'] = $request->description_main ;
            $save =  \App\MasterFacility::create($input) ;
            return 'ok' ;
        }
    }
}
