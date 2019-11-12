<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CapabilityList ;
use App\VendorCapablityListDetail ;
use App\ComponentCapabilityList ;
use App\VendorManagement ;
use auth ;
use PDF ;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Excel;
use DB;

class CapabilityListController extends Controller
{
    public function index(Request $request){
        if($request->type == 'component'){
            return CapabilityList::with(['ComponentCapabilityList'])->where('type_capability_list','component')
                    ->when($request->authority, function($q) use ($request) {
                        return $q->whereIn('authority', $request->authority);
                    })
                    ->when($request->issue, function($q) use ($request) {
                        return $q->whereIn('issue', $request->issue);
                    })
                    ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')
                    ->paginate($request->pageSize) ;
        }else{
            return CapabilityList::with(['VendorCapablityListDetail'])->where('type_capability_list','vendor')
                    ->when($request->issue, function($q) use ($request) {
                        return $q->whereIn('issue', $request->issue);
                    })
                    ->orderBy($request->sort ? $request->sort : 'id', $request->order == 'ascending' ? 'asc' : 'desc')
                    ->paginate($request->pageSize);
        }
    }

    public function store(Request $request){
        // untuk capability list vendor
        if($request->type == 'vendor'){
            $request->validate([
              'option' => 'required',
            ]);
            $cek = CapabilityList::where('type_capability_list', 'vendor')->count() ;

            if($cek == 0){
                $input['issue'] = 1 ;
                $input['revision'] = 0 ;
            }else{
                $data = CapabilityList::where('type_capability_list', 'vendor')
                                        ->orderBy('issue','desc')
                                        ->orderBy('revision','desc')
                                        ->first() ;
                if($request->option == 'issue'){
                  $input['issue'] = $data->issue + 1;
                  $input['revision'] = 0 ;
                }else{
                  $input['issue'] = $data->issue;
                  $input['revision'] = $data->revision + 1 ;
                }
            }

            $input['type_capability_list'] = 'vendor' ;
            $input['user_id'] = auth::user()->id ;

            if(VendorManagement::where('status','5')->count() != 0){
                $insert = CapabilityList::create($input);
                foreach( VendorManagement::where('status','5')->where('submit_date','>=', date('Y-m-d', strtotime('- 2 year', strtotime(date('Y-m-d')))) )->get() as $vendor){

                    $doc = json_decode($vendor->document_evidence, true) ;
                    if(!empty($doc['Other'])){ $other = $doc['Other']; }else{ $other = null; }
                    if(!empty($doc['DGCA'])){ $dgca = $doc['DGCA']; }else{ $dgca = null; }
                    if(!empty($doc['FAA'])){ $faa = $doc['FAA']; }else{ $faa = null; }
                    if(!empty($doc['EASA'])){ $easa = $doc['EASA']; }else{ $easa = null; }
                    if(!empty($doc['ASA'])){ $asa = $doc['ASA']; }else{ $asa = null; }
                    if($easa != null &&  $dgca != null && $faa != null){ $nc = 1; }else{ $nc = null; }
                    if(!empty($doc['ISO'])){ $iso = $doc['ISO']; }else{ $iso = null; }
                    if(!empty($doc['KAN'])){ $kan = $doc['KAN']; }else{ $kan = null; }

                    $insertData[] = array(
                        'supplier_name' => $vendor->vendor_name  ,
                        'type_supplier' => $vendor->type_supplier  ,
                        'vendor_code' => $vendor->supplier_code  ,
                        'address' => $vendor->vendor_address ." ".$vendor->vendor_city." ".$vendor->vendor_state." ".$vendor->vendor_zip_code  ,
                        'email' => $vendor->contact_email ,
                        'product_service' => $vendor->product_service ,
                        'last_update' => $vendor->updated_at ,
                        'dgca' => $dgca ,
                        'faa' => $faa,
                        'easa' => $easa ,
                        'asa' => $asa ,
                        'iso' => $iso ,
                        'nc' => $nc ,
                        'kan' => $kan ,
                        'other' => $other ,
                        'maint_fn' => $vendor->maint_fn ,
                        'questionnaire_exp_date' => $vendor->questionnaire_exp_date ,
                        'document_evidence' => $vendor->document_evidence ,
                    );
                }
                $insert->VendorCapablityListDetail()->createMany($insertData) ;
                return ['status' => 1, 'message' => 'Success'] ;
            }else{
                return ['status' => 0, 'message' => 'Failed'] ;
            }
        }

        // untuk capability list component
        if($request->type == 'component'){
          $request->validate([
            'authority'  => 'required',
            'option' => 'required',
          ]);

            $cek = CapabilityList::where('type_capability_list', 'component')->where('authority', $request->authority)->count() ;
            if($cek == 0){
                $input['issue'] = 1 ;
                $input['revision'] = 0 ;
            }else{
                $data = CapabilityList::where('type_capability_list', 'component')
                                        ->where('authority', $request->authority)
                                        ->orderBy('issue','desc')
                                        ->orderBy('revision','desc')
                                        ->first() ;
                // return $data ;
                if($request->option == 'issue'){
                  $input['issue'] = $data->issue + 1;
                  $input['revision'] = 0 ;
                }else{
                  $input['issue'] = $data->issue;
                  $input['revision'] = $data->revision + 1 ;
                }
            }

            if(\App\MasterConfig::where('master_request_id',2)
                                  ->join('master_config_authorities','master_config_authorities.master_config_id','=','master_configs.id')
                                  ->where('master_config_authorities.rating' , $request->authority)
                                  ->where('master_config_authorities.status' , 1)
                                  ->count() != 0){
                $input['type_capability_list'] =  $request->type ;
                $input['user_id'] = auth::user()->id ;
                $input['authority'] = $request->authority ;
                $input['type_capability_list'] = $request->type ;
                $input['form_type'] = $request->form_type ;
                $insert = CapabilityList::create($input);

                $data = \App\MasterConfig::where('master_request_id',2)
                        ->join('master_config_authorities','master_config_authorities.master_config_id','=','master_configs.id')
                        ->where('master_config_authorities.rating' , $request->authority)
                        ->where('master_config_authorities.status' , 1)
                        ->get();
                $count = \App\ForRating::count();

                foreach ($data as $d) {
                    $forRatting = json_decode($d->data['component_request']['for_rating'], true) ;
                    $rating = [] ;
                    for ($i=0; $i < $count ; $i++) {
                        if(!empty($forRatting[$i])){
                            if($forRatting[$forRatting[$i.'_name']] == true){
                                $rating[$i] = array( 'name' => $forRatting[$i.'_name'], 'value' => $forRatting[$i], 'revision' => $insert->revision );
                            }
                        }
                    }

                    $input['capability_list_id'] = $insert->id;
                    $input['part_number'] = $d->part_number;
                    $input['component_name'] = $d->data['component_request']['component_name'];
                    $input['vendor_manufacture'] = $d->data['component_request']['vendor_manufacturer'];
                    $input['ata_chapter'] = $d->data['component_request']['ata_chapter'];
                    $input['capability_level'] = $d->data['component_request']['aproval_request_carry_out'];
                    $input['workshop'] = $d->data['component_request']['workshop'];
                    $input['aircraft_type'] = $d->data['component_request']['aircraft_type'];
                    $input['for_rating'] = json_encode($rating);
                    $input['date_approval'] = $d->date_approve;
                    $input['authority'] = $request->authority;
                    $input['authority_value'] = $d->value;
                    $input['status'] = '';
                    $input['request_number'] = $d->data['request_number'];
                    $input['no_shop_ability'] = $d->data['component_shop_ability']['shop_maintenance_no'];
                    $input['component_type'] = $d->data['component_request']['component_type'];
                    $input['request_type'] = $d->data['request_type'];
                    $input['document'] = json_encode($d->data['component_document']) ;
                    $input['manhours_planning'] = json_encode($d->data['component_manhours_planning']) ;
                    $input['personel'] = json_encode($d->data['component_personel']) ;
                    $input['status_of_application'] = $d->status_of_application ;
                    $cc = $insert->ComponentCapabilityList()->create($input) ;


                    $MasterConfigAuthority = \App\MasterConfigAuthority::where('rating', $request->authority) ;
                    $InsertMasterConfig['issue'] = $input['issue'] ;
                    $InsertMasterConfig['revision'] = $input['revision'] ;
                    $InsertMasterConfig['status_of_application'] = 0 ;

                    $MasterConfigAuthority->update($InsertMasterConfig) ;
                }
                return ['status' => 1, 'message' => 'Success'] ;
            }else{
                return ['status' => 0, 'message' => 'Failed'] ;
            }
        }
    }

    public function show(Request $request, $id){
        if($request->type == 'vendor'){

            set_time_limit(300);
            $m = new Merger();
            $issue = \App\Issue::get() ;

            foreach (\App\TypeSupplier::get() as $value) {

                $capability = CapabilityList::with(['VendorCapablityListDetail' => function($query) use ($value) {
                  $query->where('type_supplier', $value['type_supplier']);
                }])->find($id) ;
                $capability['type_supplier'] = $value['type_supplier'] ;

                $pdf = PDF::loadView('detail.vendor_capability_list', ['data' => $capability, 'type' => 'potrait', 'issue' => $issue ])
                ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());
            }

            // $capability = CapabilityList::with(['VendorCapablityListDetail'])->find($id) ;

            file_put_contents('document_n_import/Capability/vendor_capability_list.pdf', $m->merge());
            return response()->file('document_n_import/Capability/vendor_capability_list.pdf');
            return $pdf->stream();
        }else{
            $m = new Merger();
            $link = $this->link($request->form_type) ;
            $authority = CapabilityList::find($id)->authority ;
            $issue = \App\Issue::get() ;

            if($request->form_type == 1 || $request->form_type == 7 || $request->form_type == 2){
              foreach (ComponentCapabilityList::distinct('workshop')->select('workshop')->orderBy('workshop','desc')->get() as $value ) {
                  $data = ComponentCapabilityList::where('capability_list_id', $id)
                  ->where('authority', $authority )
                  ->where('workshop', $value->workshop )
                  ->orderBy('workshop','asc')->get() ;

                  $pdf = PDF::loadView('detail.capabilitydetail.capability'.$link, ['data' => $data, 'type' => 'test', 'issue' => $issue ])
                  ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
                  $m->addRaw($pdf->output());
              }

            }elseif($request->form_type == 3 || $request->form_type == 4 || $request->form_type == 6){
                $data = ComponentCapabilityList::where('capability_list_id', $id)
                                              ->where('authority',$authority)
                                              ->orderBy('authority_value','asc')->get() ;

                $pdf = PDF::loadView('detail.capabilitydetail.capability'.$link, ['data' => $data, 'type' => 'test', 'issue' => $issue ])
                ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());

            }else{
                $data = ComponentCapabilityList::where('capability_list_id', $id)
                                                ->where('authority',$authority )
                                                ->orderBy('ata_chapter','asc')->get() ;

                $pdf = PDF::loadView('detail.capabilitydetail.capability'.$link, ['data' => $data, 'type' => 'test', 'issue' => $issue ])
                ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');
                $m->addRaw($pdf->output());

            }

            file_put_contents('document_n_import/Capability/capabilitycomponent'.$link.'.pdf', $m->merge());
            return response()->file('document_n_import/Capability/capabilitycomponent'.$link.'.pdf');

        }
    }

    public function update(Request $request, $id){
        foreach ($request->all() as $value) {
            $update = ComponentCapabilityList::find($value['id'])->update($value) ;
        }

        if($update){
          $res = ['status' => 1, 'message' => 'success'] ;
        }else{
          $res = ['status' => 0, 'message' => 'failed'] ;
        }

        $res ;
    }

    public function exportexcel(Request $request, $id){
      $data = CapabilityList::selectRaw('capability_lists .*, component_capability_lists .*')
                              ->join('component_capability_lists','component_capability_lists.capability_list_id', 'capability_lists.id')
                              ->where('capability_lists.id', $id)
                              ->get() ;

      // return view('detail.component_capability_list', compact('data')) ;
      return Excel::create("Capability list of ".$request->rating."".date('y-m-d'), function($excel) use($data){
        $excel->sheet('1', function($sheet) use($data){
          $sheet->loadView('detail.component_capability_list', array('pageTitle' => 'Capability List', 'data' => $data));
        });
      })->export('xlsx');

        // $authority = CapabilityList::find($id)->authority ;
        // $link = $this->link($request->form_type) ;
        // $data = ComponentCapabilityList::join('capability_ratings','capability_ratings.component_capability_list_id', 'component_capability_lists.id')
        //         ->where('component_capability_lists.capability_list_id', $id)->where('capability_ratings.name',$authority )->orderBy('capability_ratings.value','asc')->get() ;

        // return view('detail.capabilityexportExcel.capability'.$link, compact('data')) ;

        // return Excel::create("Capability list of ".$request->rating."".date('y-m-d'), function($excel) use($data, $link){
        //             $excel->sheet('1', function($sheet) use($data, $link){
        //                  $sheet->loadView('detail.capabilityexportExcel.capability'.$link, array('pageTitle' => 'Capability List', 'data' => $data));
        //             });
        //         })->export('xlsx');
    }

    public function temporaryComponent(Request $request, $id){
          if(\App\MasterConfig::selectRaw('master_configs .*, master_config_authorities .*')
                  ->join('master_config_authorities', 'master_config_authorities.master_config_id', 'master_configs.id')
                  ->where('master_config_authorities.rating', $request->authority)
                  ->where('master_config_authorities.status_of_application','>', 0 )
                  ->where('master_config_authorities.status', 1 )
                  ->count() != 0){
              if($request->type == 'cek'){
                  return ['status' => 1 , 'message' => 'success'] ;
              }
              $input['type_capability_list'] =  $request->type ;
              $input['authority'] = $request->authority ;
              $input['form_type'] = $request->form_type ;

              $data = \App\MasterConfig::where('master_request_id',2)
                      ->join('master_config_authorities','master_config_authorities.master_config_id','=','master_configs.id')
                      ->where('master_config_authorities.rating' , $request->authority)
                      ->where('master_config_authorities.status_of_application','>', 0 )
                      ->get();
              $count = \App\ForRating::count();
              $link = $this->link($request->authority) ;
              foreach ($data as $d) {
                  $forRatting = json_decode($d->data['component_request']['for_rating'], true) ;
                  $rating = [] ;
                  for ($i=0; $i < $count ; $i++) {
                      if(!empty($forRatting[$i])){
                          if($forRatting[$forRatting[$i.'_name']] == true){
                              $rating[$i] = array( 'name' => $forRatting[$i.'_name'], 'value' => $forRatting[$i] );
                          }
                      }
                  }

                  $input['part_number'] = $d->part_number;
                  $input['component_name'] = $d->data['component_request']['component_name'];
                  $input['vendor_manufacture'] = $d->data['component_request']['vendor_manufacturer'];
                  $input['ata_chapter'] = $d->data['component_request']['ata_chapter'];
                  $input['capability_level'] = $d->data['component_request']['aproval_request_carry_out'];
                  $input['workshop'] = $d->data['component_request']['workshop'];
                  $input['aircraft_type'] = $d->data['component_request']['aircraft_type'];
                  $input['for_rating'] = json_encode($rating);
                  $input['date_approval'] = $d->date_approve;
                  $input['authority'] = $request->authority;
                  $input['authority_value'] = $d->value;
                  $input['status'] = '';
                  $input['request_number'] = $d->data['request_number'];
                  $input['no_shop_ability'] = $d->data['component_shop_ability']['shop_maintenance_no'];
                  $input['component_type'] = $d->data['component_request']['component_type'];
                  $input['request_type'] = $d->data['request_type'];
                  $input['document'] = json_encode($d->data['component_document']) ;
                  $input['manhours_planning'] = json_encode($d->data['component_manhours_planning']) ;
                  $input['personel'] = json_encode($d->data['component_personel']) ;
                  $input['status_of_application'] = $d->status_of_application ;
                  $input['customer'] = '' ;
                  $input['technical_data'] = '' ;
                  $input['major_equipment'] = '' ;

                  $dataAll[] = $input ;
              }

              $pdf = PDF::loadView('detail.capabilitydetail.capability'.$link, ['data' => json_decode(json_encode($dataAll)), 'type' => 'temporary', 'issue' => 'temporary', 'authority' => $request->authority ])
              ->setOptions(['isPhpEnabled' => true])->setPaper('a4', 'landscape');

              return $pdf->stream() ;
          }else{
              return ['status' => 0, 'message' => 'Belum ada data baru'] ;
          }
    }

    public function ekstractExcel(Request $request, $id){
          if(\App\MasterConfig::selectRaw('master_configs .*, master_config_authorities .*')
                  ->join('master_config_authorities', 'master_config_authorities.master_config_id', 'master_configs.id')
                  ->where('master_config_authorities.rating', $request->authority)
                  ->where('master_config_authorities.status', 1 )
                  ->count() != 0){
              if($request->type == 'cek'){
                  return ['status' => 1 , 'message' => 'success'] ;
              }
              $input['type_capability_list'] =  $request->type ;
              $input['authority'] = $request->authority ;
              $input['form_type'] = $request->form_type ;

              $data = \App\MasterConfig::where('master_request_id',2)
                      ->join('master_config_authorities','master_config_authorities.master_config_id','=','master_configs.id')
                      ->where('master_config_authorities.rating' , $request->authority)
                      ->get();
              $count = \App\ForRating::count();
              $link = $this->link($request->authority) ;
              foreach ($data as $d) {
                  $forRatting = json_decode($d->data['component_request']['for_rating'], true) ;
                  $rating = [] ;
                  for ($i=0; $i < $count ; $i++) {
                      if(!empty($forRatting[$i])){
                          if($forRatting[$forRatting[$i.'_name']] == true){
                              $rating[$i] = array( 'name' => $forRatting[$i.'_name'], 'value' => $forRatting[$i] );
                          }
                      }
                  }

                  $input['part_number'] = $d->part_number;
                  $input['part_name'] = $d->data['component_request']['component_name'];
                  $input['vendor_manufacture'] = $d->data['component_request']['vendor_manufacturer'];
                  $input['ata_chapter'] = $d->data['component_request']['ata_chapter'];
                  $input['level_of_maintenance'] = $d->data['component_request']['aproval_request_carry_out'];
                  $input['workshop'] = $d->data['component_request']['workshop'];
                  $input['aircraft_type'] = $d->data['component_request']['aircraft_type'];
                  $input['rating'] = $request->authority;
                  $input['date_approval'] = $d->date_approve;
                  $input['authority_value'] = $d->value;
                  $input['request_type'] = $d->request_type;
                  $input['issue'] = $d->issue;
                  $input['revision'] = $d->revision;

                  $dataAll[] = $input ;
              }
              return Excel::create("Ekstract to Excel ".$request->authority." ".date('y-m-d H-i-s'), function($excel) use($dataAll){
                $excel->sheet('1', function($sheet) use($dataAll){
                  $sheet->loadView('detail/capabilityexcel/ekstractexcel', ['data' => json_decode(json_encode($dataAll)) ]);
                });
              })->export('xlsx');
          }else{
              return ['status' => 0, 'message' => 'Belum ada data baru'] ;
          }
    }

    public function link($param){
        if($param == 1 || $param = 'DGCA RATING'){
            $link = 'dgca' ;
        }
        if($param == 2 || $param = 'FAA RATING'){
            $link = 'faa' ;
        }
        if($param == 3 || $param = 'EASA RATING'){
            $link = 'easa' ;
        }
        if($param == 4 || $param = 'CAAM RATING'){
            $link = 'caam' ;
        }
        if($param == 5 || $param = 'CAAC RATING'){
            $link = 'caac' ;
        }
        if($param == 6 || $param = 'CAAS RATING'){
            $link = 'caas' ;
        }
        if($param == 7 || $param = 'CAAP RATING'){
            $link = 'caap' ;
        }

        return $link ;
    }
}
