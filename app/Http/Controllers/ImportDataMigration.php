<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\RequestSubmittion ;
use App\ComponentRequest ;
use App\ComponentShopAbility ;
use App\RequestHistory ;
use App\ComponentEquivalent ;
use App\ComponentTestEquipment ;
use App\EngineRequest ;
use App\EngineShopAbility ;
use App\MasterConfig ;
use App\VendorManagement ;
use App\User ;

class ImportDataMigration extends Controller
{
    public function index(Request $request){
      if($request->type == 'aircraft'){
        return view('importMigration/aircraft') ;
      }

      if($request->type == 'component'){
        return view('importMigration/component') ;
      }

      if($request->type == 'engine'){
        return view('importMigration/engine') ;
      }

      if($request->type == 'special'){
        return view('importMigration/special') ;
      }

      if($request->type == 'vendor'){
        return view('importMigration/vendor') ;
      }

    }

    public function update(Request $request, $id){
        return "ok";
    }

    public function show(Request $request, $id){
      return MasterConfig::get() ;
      return \App\User::get();

      // Import migrasi aircraft


      // Import Component
      if($request->type == 'component'){
        foreach (RequestSubmittion::where('master_request_id', 2)->get() as $data) {
          $request = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility','ComponentPersonel','RequestHistory',
          'ComponentDocument','ComponentAttachment','ComponentTestEquipment','ComponentSpecialTool',
          'ComponentMaterialPlanning','ComponentManhoursPlanning','ComponentEquivalent'])
          ->find($data->id) ;
          // asdasda
          $part_number = explode('|', $request->ComponentRequest->part_number) ;
          $authority =  json_decode($request->ComponentRequest->for_rating, true) ;
          foreach ($part_number as $value) {
            $inputMasterCOnfig['part_number'] = $value ;
            $inputMasterCOnfig['request_number'] = $request->request_number ;
            $inputMasterCOnfig['request_submittion_id'] = $data->id ;
            $inputMasterCOnfig['data'] = $request;
            $inputMasterCOnfig['component_type'] = $request->ComponentRequest->component_type;
            $inputMasterCOnfig['master_request_id'] = 2;
            $inputMasterCOnfig['authority'] = $request->ComponentRequest->for_rating ;
            $inputMasterCOnfig['request_type'] = $request->request_type ;

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

            if(\App\MasterConfig::where('part_number', $value )->where('master_request_id', 2)->count() >= 1){
              $master = \App\MasterConfig::where('part_number', $value )->where('master_request_id', 2)->first() ;
              $master->update($inputMasterCOnfig) ;
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
              $masterConfig = \App\MasterConfig::create($inputMasterCOnfig);
              $masterConfig->MasterConfigAuthority()->createMany($for_rating) ;
            }
          }
        };
      }

      return "ok";
    }

    public function store(Request $request){
      // start import data aircraft
      if($request->type == 'aircraft'){
        if($request->hasFile('mainfile')){
          $path = $request->file('mainfile')->getRealPath();
          $datamain = Excel::load($path, function($reader) {})->get();
            if(!empty($datamain) && $datamain->count()){
                foreach ($datamain as $value) {
                  $input = array(
                    'user_id' => 1 ,
                    'master_request_id' => 1 ,
                    'status' => 5 ,
                    'request_type' => 'Add' ,
                    'request_number' => $value->request_number ,
                    'number' => $value->no_maintenance_ability ,
                    'authority' => $value->rating ,
                    'aircraft_type' => $value->aircraft_type ,
                    'aircraft_manufacturer' => $value->aircraft_manufacture ,
                    'engine' => $value->engine ,
                    'maintenance_area' => $value->maintenance_area ,
                    'maintenance_area_value' => $value->area ,
                    'ability' => $value->ability ,
                    'special_work	' => $value->special_work_to_be_order ,
                    'facilities' => $value->facilities ,
                    'special_tools' => $value->special_tools ,
                    'certifying_staff' => $value->certifyng_staff ,
                    'approved_data' => $value->approved_data ,
                    'qualified_personel' => $value->qualified_personel ,
                    'consumable' => $value->consumable ,
                    'limitation' => $value->limitation ,
                    'customer' => $value->customer ,
                    'date_approve' => $value->date_approve ,
                  );
                  $ekstrak = RequestSubmittion::create($input);
                  $ekstrak->AircraftRequest()->create($input) ;
                }
            }

            // start masuk table master config aircraft
            $data = RequestSubmittion::with('AircraftRequest')->get() ;
            foreach ($data as $value) {
              $config['ability'] = $value->AircraftRequest->ability ;
              $config['maintenance_area'] = $value->AircraftRequest->maintenance_area ;
              $config['maintenance_area_value'] = $value->AircraftRequest->maintenance_area_value ;
              $config['request_type'] = $value->request_type ;
              $config['aircraft_type'] = $value->AircraftRequest->aircraft_type ;
              $config['customer'] = $value->AircraftRequest->customer ;
              $config['aircraft_rating'] = $value->AircraftRequest->authority ;
              $config['request_number'] = $value->request_number ;
              $config['request_submittion_id'] = $value->id ;
              $config['master_request_id'] = 1 ;
              $config['date_approve'] = $value->date_approve ;
              $config['data'] = $value ;
              MasterConfig::create($config) ;
            }
            // end table master config aircraft

            // truncate data awal
            RequestSubmittion::query()->truncate();
            \App\AircraftRequest::query()->truncate();
            return 'Berhasil Masuk Config' ;
        }else{
          return 'gak ada data' ;
        }
      }
      // end import data aircraft

      // start import data component
      if($request->type == 'component'){
        if($request->hasFile('mainfile')){
          $path = $request->file('mainfile')->getRealPath();
          $datamain = Excel::load($path, function($reader) {})->get();
          if(!empty($datamain) && $datamain->count()){
              foreach ($datamain as $value) {
                if(!empty($value)){
                  $input = $value->toArray() ;
                  $aproval_cary_out = ['inspection' => $value->inspection , 'testing' => $value->testing,
                                        'repair' => $value->repair,	'modification' => $value->modification,
                                        'overhauled' => $value->overhauled ];
                  $manager_statement = ['facilities' => $value->facilities ,
                                      'special_tools' => $value->special_tools ,
                                      'qualified_personel' => $value->qualified_personel ,
                                      'approved_data' => $value->approved_data ,
                                      'appropriate_rating' => $value->appropriate_rating ,
                                      'special_equipment' => $value->special_equipment ];
                  $summary_of_maintenance = ['OWNER CODE' => $value->owner_code,
                                            'ENGINE' => $value->engine,
                                            'APU' => $value->apu,
                                            'TYPE MODEL' => $value->type_model,
                                            'CHECK PERIOD' => $value->check_period,
                                            'TBO' => $value->tbo,
                                            'SYSTEM' => $value->system ];
                  $test_condition = ['temp_min' => $value->test_condition_temp_min,
                                            'temp_max' => $value->test_condition_temp_max,
                                            'humidity_min' => $value->test_condition_humidity_min,
                                            'humidity_max' => $value->test_condition_humidity_max,
                                            'pres_min' => $value->test_condition_pres_min,
                                            'pres_max' => $value->test_condition_pres_max,
                                            'other' => $value->test_condition_other,] ;
                  $storage_condition = ['temp_min' => $value->storage_condition_temp_min,
                                            'temp_max' => $value->storage_condition_temp_max,
                                            'humidity_min' => $value->storage_condition_humidity_min,
                                            'humidity_max' => $value->storage_condition_humidity_max,
                                            'pres_min' => $value->storage_condition_pres_min,
                                            'pres_max' => $value->storage_condition_pres_max,
                                            'other' => $value->storage_condition_other,] ;

                  $input['aproval_request_carry_out'] = json_encode($aproval_cary_out) ;
                  $input['capability_level'] = json_encode($aproval_cary_out) ;
                  $input['summary_of_maintenance'] = json_encode($summary_of_maintenance) ;
                  $input['manager_statement'] = json_encode($manager_statement);
                  $input['test_condition'] = json_encode($test_condition) ;
                  $input['storage_condition'] = json_encode($storage_condition) ;
                  $input['consumable_material'] = "[]" ;

                  $value_rating = '{';
                  if($request->hasFile('ratingfile')){
                      $path2 = $request->file('ratingfile')->getRealPath();
                      $data = Excel::load($path2, function($reader) {})->get();
                      $i = 0 ;
                      $totRating = array_filter($data->toArray(), function($el) use($value) {
                          return $el['request_number'] == $value->request_number ;
                      });

                      foreach (\App\ForRating::get() as $rating) {
                          $cek = array_filter($data->toArray(), function($el) use($value, $rating) {
                              return $el['request_number'] == $value->request_number && $el['name_of_rating'] == $rating->name_of_rating;
                          });

                          if(count($cek) > 0){
                              $d = end($cek);
                              if($i == (count($totRating)-1) ){
                                $koma = '' ;
                              }else{
                                $koma = ', ' ;
                              }
                              $value_rating .= '"'.$i.'":"'. $d['value_of_rating'].'", "'.
                                                $i.'_name":"'.$d['name_of_rating'].'", "'.
                                                $d['name_of_rating'].'":true'.
                                                $koma ;
                              $i++ ;
                          }
                      }
                  }
                  $value_rating .= "}" ;

                  $input['for_rating'] = $value_rating;
                  // if($request->hasFile('documentfile')){
                  //     $path2 = $request->file('documentfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $document = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('ConsumableMaterialfile')){
                  //     $path2 = $request->file('ConsumableMaterialfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $ConsumableMaterialfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  //
                  // if($request->hasFile('personelfile')){
                  //     $path2 = $request->file('personelfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $personelfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('testequipmentfile')){
                  //     $path2 = $request->file('testequipmentfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $testequipmentfile= array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('specialtoolfile')){
                  //     $path2 = $request->file('specialtoolfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $specialtoolfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('materialplanningfile')){
                  //     $path2 = $request->file('materialplanningfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $materialplanningfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('manhourplanningfile')){
                  //     $path2 = $request->file('manhourplanningfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $manhourplanningfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // if($request->hasFile('attachmentfile')){
                  //     $path2 = $request->file('attachmentfile')->getRealPath();
                  //     $data = Excel::load($path2, function($reader) {})->get();
                  //     $attachmentfile = array_filter($data->toArray(), function($el) use($value) {
                  //           return $el['request_number'] == $value->request_number;
                  //     });
                  // }
                  // $input['consumable_material'] = "[]" ;
                  $input['status'] = 0 ;
                  $input['submit_date'] = '2019-10-10' ;

                  $input['master_request_id'] = 2 ;
                  $input['shop_maintenance_no'] = $value->number_ability ;
                  $input['qualified_personel'] = null ;
                  $input['step_request_type'] = 'New' ;
                  $input['request_type'] = 'Add' ;
                  $input['user_id'] = 15;
                  $input['request_number'] = $this->request_number();
                  $input['part_number'] = str_replace(',','|', $value->part_number);
                  $input['aircraft_type'] = str_replace(',','|', $value->aircraft_type);

                  $ekstrak = RequestSubmittion::create($input);
                  $ekstrak->ComponentRequest()->create($input) ;
                  $ekstrak->ComponentShopAbility()->create($input) ;
                  // $ekstrak->ComponentDocument()->createMany($document) ;
                  // $ekstrak->ComponentPersonel()->createMany($personelfile) ;
                  // $ekstrak->ComponentTestEquipment()->createMany($testequipmentfile) ;
                  // $ekstrak->ComponentSpecialTool()->createMany($specialtoolfile) ;
                  // $ekstrak->ComponentMaterialPlanning()->createMany($materialplanningfile) ;
                  // $ekstrak->ComponentManhoursPlanning()->createMany($manhourplanningfile) ;
                  // $ekstrak->ComponentAttachment()->createMany($attachmentfile) ;

                  foreach (explode(',', $value->part_number) as $pn) {
                    if(\App\PartNumber::where('part_number', $pn)->count() == 0){
                        $inputPn['part_number'] = $pn ;
                        $inputPn['part_description'] = $value->component_name;
                        $inputPn['ata_chapter'] = $value->ata_chapter;
                        \App\PartNumber::create($inputPn) ;
                    }
                  }
                }

              }

              // masuk ke master config
                foreach (RequestSubmittion::where('master_request_id', 2)->get() as $data) {
                  $request = RequestSubmittion::with(['ComponentRequest','ComponentShopAbility'])
                  ->find($data->id) ;
                  // asdasda
                  $part_number = explode('|', $request->ComponentRequest->part_number) ;
                  $authority =  json_decode($request->ComponentRequest->for_rating, true) ;
                  foreach ($part_number as $value) {
                    $inputMasterCOnfig['part_number'] = $value ;
                    $inputMasterCOnfig['request_number'] = $request->request_number ;
                    $inputMasterCOnfig['request_submittion_id'] = $data->id ;
                    $inputMasterCOnfig['data'] = $request;
                    $inputMasterCOnfig['component_type'] = $request->ComponentRequest->component_type;
                    $inputMasterCOnfig['master_request_id'] = 2;
                    $inputMasterCOnfig['authority'] = $request->ComponentRequest->for_rating ;
                    $inputMasterCOnfig['request_type'] = $request->request_type ;

                    $i = 0 ;
                    foreach (\App\ForRating::get() as $key => $vrating) {
                      if(!empty($authority[$i])){
                        $ratingAuth['rating'] = $authority[$i.'_name'] ;
                        $ratingAuth['status'] = $authority[$vrating->name_of_rating] ;
                        $ratingAuth['value'] = $authority[$i] ;
                        $ratingAuth['status'] =1 ;
                        $ratingAuth['status_of_application'] = 1;

                        $forRating[] = $ratingAuth ;
                      }
                      $i++ ;
                    }
                    $masterConfig = \App\MasterConfig::create($inputMasterCOnfig);
                    $masterConfig->MasterConfigAuthority()->createMany($forRating) ;
                    $forRating = [] ;
                  }
                }
                // end masuk masterconfig
                RequestSubmittion::query()->truncate();
                \App\ComponentRequest::query()->truncate();
                return 'Berhasil Masuk Config' ;
          }else{
            echo"gak ada data" ;
          }
        }
      }
      // end import data component

      // start import data engine
      if($request->type == 'engine'){
        // import
        if($request->hasFile('mainfile')){
          $path = $request->file('mainfile')->getRealPath();
          $datamain = Excel::load($path, function($reader) {})->get();
          if(!empty($datamain) && $datamain->count()){
            // import
              foreach ($datamain as $value) {
                $value_rating = '{';
                  if($request->hasFile('ratingfile')){
                    $path2 = $request->file('ratingfile')->getRealPath();
                    $data = Excel::load($path2, function($reader) {})->get();
                      $i = 0 ;
                      $totRating = array_filter($data->toArray(), function($el) use($value) {
                        return $el['request_number'] == $value->request_number ;
                      });

                      foreach (\App\ForRating::get() as $rating) {
                        $cek = array_filter($data->toArray(), function($el) use($value, $rating) {
                          return $el['request_number'] == $value->request_number && $el['name_of_rating'] == $rating->name_of_rating;
                        });

                        if(count($cek) > 0){
                          $d = end($cek);
                          if($i == (count($totRating)-1) ){
                            $koma = '' ;
                          }else{
                            $koma = ', ' ;
                          }
                          $value_rating .= '"'.$i.'":"'. $d['value_of_rating'].'", "'.
                          $i.'_name":"'.$d['name_of_rating'].'", "'.
                          $d['name_of_rating'].'":true'.
                          $koma ;
                          $i++ ;
                        }
                      }
                    }

                    $summary_of_maintenance = ['OWNER CODE' => $value->owner_code,
                                              'ENGINE' => $value->engine,
                                              'APU' => $value->apu,
                                              'TYPE MODEL' => $value->type_model,
                                              'CHECK PERIOD' => $value->check_period,
                                              'TBO' => $value->tbo,
                                              'SYSTEM' => $value->system ];

                    $value_rating .= "}" ;
                    $input = $value->toArray() ;
                    $input['consumable_material'] = "[]" ;
                    $input['special_work'] = $value->special_work_to_be_order;
                    $input['inspection'] = $value->inspection_schema ;
                    $input['user_id'] = 1 ;
                    $input['master_request_id'] = 3 ;
                    $input['status'] = 5 ;
                    $input['summary_of_maintenance']   = json_encode($summary_of_maintenance) ;
                    $input['for_rating'] = $value_rating ;

                    $ekstrak = RequestSubmittion::create($input);
                    $ekstrak->EngineRequest()->create($input) ;
                    $ekstrak->EngineShopAbility()->create($input) ;

                    foreach (explode(',', $value->part_number) as $pn) {
                      if(\App\PartNumber::where('part_number', $pn)->count() == 0){
                          $inputPn['part_number'] = $pn ;
                          $inputPn['part_description'] = $value->component_name;
                          $inputPn['ata_chapter'] = $value->ata_chapter;
                          \App\PartNumber::create($inputPn) ;
                      }
                    }
              }
          }
          // end imports

          // start master config engine
          foreach (RequestSubmittion::where('master_request_id', 3)->get() as $data) {
            $request = RequestSubmittion::with(['EngineRequest','EngineShopAbility'])
            ->find($data->id) ;
            $part_number = explode('|', $request->EngineRequest->part_number) ;
            $authority =  json_decode($request->EngineRequest->for_rating, true) ;
            foreach ($part_number as $value) {
              $inputMasterCOnfig['part_number'] = $value ;
              $inputMasterCOnfig['request_number'] = $request->request_number ;
              $inputMasterCOnfig['request_submittion_id'] = $data->id ;
              $inputMasterCOnfig['data'] = $request;
              $inputMasterCOnfig['master_request_id'] = 3;
              $inputMasterCOnfig['authority'] = $request->EngineRequest->for_rating ;
              $inputMasterCOnfig['request_type'] = $request->request_type ;

              $i = 0 ;
              foreach (\App\ForRating::get() as $key => $vrating) {
                if(!empty($authority[$i])){
                  $ratingAuth['rating'] = $authority[$i.'_name'] ;
                  $ratingAuth['status'] = $authority[$vrating->name_of_rating] ;
                  $ratingAuth['value'] = $authority[$i] ;
                  $ratingAuth['status'] =1 ;
                  $ratingAuth['status_of_application'] = 1;

                  $forRating[] = $ratingAuth ;
                }
                $i++ ;
              }
              $masterConfig = \App\MasterConfig::create($inputMasterCOnfig);
              $masterConfig->MasterConfigAuthority()->createMany($forRating) ;
              $forRating = [] ;
            }
          }
          RequestSubmittion::query()->truncate();
          \App\EngineRequest::query()->truncate();
          return 'Berhasil Masuk Config' ;
          // end masuk masterconfig
        }else{
          return "tidak ada data" ;
        }

      }
      // end inmport engine

      // start import special
      if($request->type == 'special'){
        if($request->hasFile('mainfile')){
          $path = $request->file('mainfile')->getRealPath();
          $datamain = Excel::load($path, function($reader) {})->get();
          if(!empty($datamain) && $datamain->count()){
            // import
              foreach ($datamain as $value) {
                $value_rating = '{';
                  if($request->hasFile('ratingfile')){
                    $path2 = $request->file('ratingfile')->getRealPath();
                    $data = Excel::load($path2, function($reader) {})->get();
                      $i = 0 ;
                      $totRating = array_filter($data->toArray(), function($el) use($value) {
                        return $el['request_number'] == $value->request_number ;
                      });

                      foreach (\App\ForRating::get() as $rating) {
                        $cek = array_filter($data->toArray(), function($el) use($value, $rating) {
                          return $el['request_number'] == $value->request_number && $el['name_of_rating'] == $rating->name_of_rating;
                        });

                        if(count($cek) > 0){
                          $d = end($cek);
                          if($i == (count($totRating)-1) ){
                            $koma = '' ;
                          }else{
                            $koma = ', ' ;
                          }
                          $value_rating .= '"'.$i.'":"'. $d['value_of_rating'].'", "'.
                          $i.'_name":"'.$d['name_of_rating'].'", "'.
                          $d['name_of_rating'].'":true'.
                          $koma ;
                          $i++ ;
                        }
                      }
                  }

                  $ability = ['ability_on_Wing' => $value->owner_code, 'ability_remove' => $value->engine ] ;
                  $requirement = ['dark_room' => $value->requirement_dark_room,  'exposure_room' => $value->requirement_exposure, 'not_required' => $value->note_required ] ;
                  $aproval_cary_out = ['inspection' => $value->inspection , 'testing' => $value->testing,
                                        'repair' => $value->repair,	'modification' => $value->modification,
                                        'overhauled' => $value->overhauled ];

                  $value_rating .= '}';

                  $input = $value->toArray() ;
                  $input['for_rating'] = $value_rating ;
                  $input['part_number'] = $value->ndt_method ;
                  $input['engine_name'] = $value->engine_component_name ;
                  $input['user_id'] = 1 ;
                  $input['master_request_id'] = 4 ;
                  $input['status'] = 5 ;
                  $input['ability'] = json_encode($ability) ;
                  $input['special_facility'] = json_encode($requirement) ;
                  $input['aproval_request_carry_out'] = json_encode($aproval_cary_out) ;


                  $ekstrak = RequestSubmittion::create($input);
                  $ekstrak->SpecialRequest()->create($input) ;
                  $ekstrak->SpecialShopAbility()->create($input) ;

              }
            }

            foreach (RequestSubmittion::where('master_request_id', 4)->get() as $data) {
              $request = RequestSubmittion::with(['SpecialRequest','SpecialShopAbility'])
              ->find($data->id) ;
              $authority =  json_decode($request->SpecialRequest->for_rating, true) ;
              $inputMasterCOnfig['part_number'] = $request->SpecialRequest->part_number ;
              $inputMasterCOnfig['request_number'] = $request->request_number ;
              $inputMasterCOnfig['request_submittion_id'] = $data->id ;
              $inputMasterCOnfig['data'] = $request;
              $inputMasterCOnfig['master_request_id'] = 4;
              $inputMasterCOnfig['authority'] = $request->SpecialRequest->for_rating ;
              $inputMasterCOnfig['request_type'] = $request->request_type ;

              $i = 0 ;
              foreach (\App\ForRating::get() as $key => $vrating) {
                if(!empty($authority[$i])){
                  $ratingAuth['rating'] = $authority[$i.'_name'] ;
                  $ratingAuth['status'] = $authority[$vrating->name_of_rating] ;
                  $ratingAuth['value'] = $authority[$i] ;
                  $ratingAuth['status'] =1 ;
                  $ratingAuth['status_of_application'] = 1;

                  $ForRatingSP[] = $ratingAuth ;
                }
                $i++ ;
              }

              $masterConfig = \App\MasterConfig::create($inputMasterCOnfig);
              $masterConfig->MasterConfigAuthority()->createMany($ForRatingSP) ;
              $ForRatingSP = [] ;
            }
            RequestSubmittion::query()->truncate();
            \App\SpecialRequest::query()->truncate();
            return 'Berhasil Masuk Config' ;
            // end masuk masterconfig
          }else{
            return 'tidak ada data' ;
          }
      }
      // end import data engine

      // start import data vendor
      if($request->type == 'vendor'){
        if($request->hasFile('mainfile')){
          $path = $request->file('mainfile')->getRealPath();
          $datamain = Excel::load($path, function($reader) {})->get();
          if(!empty($datamain) && $datamain->count()){
            // import
              foreach ($datamain as $value) {
                $input =  $value->toArray() ;
                $input['user_id'] = 1 ;
                $input['status'] = 5 ;
                for ($i=0; $i < 5 ; $i++) {
                    $history[] = ['vendor_management_id' => 1, 'status' => $i+1 , 'user_id' => 1, 'created_at' => $value->submit_date ] ;
                }

                $import = VendorManagement::create($input) ;
                $import->VendorManagementHistory()->createMany($history) ;
                $history = [] ;
              }
            return "berhasil import" ;
          }
        }else{
            return "tidak ada data" ;
        }
      }

    }

    public function request_number(){
        $request = ComponentRequest::orderBy('id','desc')->first();

        if($request){
            $cek = str_replace('CP','', $request->request_number) ;
        }else{
            $cek = 0 ;
        }


        if($cek < 10){
            $number = 'CP00000'.($cek+1) ;
        }
        elseif($cek < 100){
            $number = 'CP0000'.($cek+1) ;
        }
        elseif($cek < 1000){
            $number = 'CP000'.($cek+1) ;
        }
        elseif($cek < 10000){
            $number = 'CP00'.($cek+1) ;
        }
        elseif($cek < 100000){
            $number = 'CP0'.($cek+1) ;
        }
        elseif($cek < 1000000){
            $number = 'CP'.($cek+1) ;
        }

        return $number ;
    }
}
