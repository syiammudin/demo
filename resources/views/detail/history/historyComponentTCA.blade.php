<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Detail ComponentRequest Request {{ $request['request_number'] }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">
        <style media="screen">
        #watermark {
            font-family: Myriad ;
            font-size : 36pt;
            position: fixed;
            top: 45%;
            width: 100%;
            text-align: center;
            opacity: .6;
            transform: rotate(-30deg);
            transform-origin: 50% 50%;
            z-index: -1000;
        }
        label{
            font-family: Myriad ;
            font-weight: normal !important ;
        }
        .fullwidth{
            width: 100% ;
        }
        .page_break{
            page-break-before: always;
        }

        .isi-table{
            width: 100% ;
            font-size : 8pt ;
        }

        .isi-table th{
            background: grey ;
            color:white ;
            text-align: center ;
            v-align : middle ;
        }
        .distribution {
            padding-left: 20px; padding-top:5px;
        }

        .distribution-border{
            border-left: 1px solid #ddd ; padding: 5px; height: 27px;
        }

        .mini-line-hight{
            line-height: 10px !important;
        }
        .mini-line-hight-2{
            line-height: 15px !important;
        }
        body, table  {
            font-size: 8pt;
        }
        </style>
    </head>
    <body>
        <?php
            $ComponentRequest = json_decode(json_encode($request['component_request'])) ;
            $shopability = json_decode(json_encode($request['component_shop_ability'])) ;
            $user = json_decode(json_encode($request['user'])) ;

            $ar_carry_out  =  json_decode($ComponentRequest->aproval_request_carry_out, true) ;
            $manager_statement  =  json_decode($ComponentRequest->manager_statement, true) ;

            $som = json_decode($shopability->summary_of_maintenance  , true);
            $test_equipment = json_decode($shopability->test_equipment, true) ;
            $special_tool = json_decode($shopability->special_tool, true) ;
            $capability_level = json_decode($shopability->capability_level, true) ;
            $qualified_personel = json_decode($shopability->qualified_personel, true) ;
            $material_planning = json_decode($shopability->material_planning, true) ;
            $manhours_planning = json_decode($shopability->manhours_planning, true) ;
            $consumable_material = json_decode($shopability->consumable_material, true) ;
            $test_condition = json_decode($shopability->test_condition, true) ;
            $storage_condition = json_decode($shopability->storage_condition, true) ;

         ?>
        @if($type == 'potrait')
            <table class="fullwidth">
                <tr>
                    <td class="text-center">
                        <img src="{{ public_path('images/gmf.png') }}" width="200">
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center"><strong>CAPABILITY LIST EVALUATION SHEET REQUEST</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width:100%">
                                        <tr>
                                            <td>
                                                <strong>COMPONENT DATA</strong> <br>
                                                P/N to {{ $request['request_type'] }} (*) : {{ $ComponentRequest->part_number }}<br>
                                                <strong>(*) Cross as required</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <br>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <span style="text-decoration: line-through">Compnonent</span> / Special (*) Name
                                                        </td>
                                                        <td>
                                                            : {{ $ComponentRequest->component_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Vendor of Manufacture Code
                                                        </td>
                                                        <td>
                                                            : {{ $ComponentRequest->vendor_manufacturer }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>Aircraft Type : {{ $ComponentRequest->aircraft_type }}</td>
                                                        <td>ATA Chapter : {{ $ComponentRequest->ata_chapter }} </td>
                                                        <td>Workshop : {{ $ComponentRequest->workshop }} </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <br>
                                                <table style="width:80%">
                                                    <tr>
                                                        <td valign="top"><strong>FOR RATTING : </strong></td>
                                                        <td>
                                                            <table>
                                                                @php
                                                                $test = count(\App\ForRating::get());

                                                                echo count(json_decode($ComponentRequest->for_rating, true));
                                                                $loop = count(json_decode($ComponentRequest->for_rating, true)) - (count(json_decode($ComponentRequest->for_rating, true))/6) ;
                                                                $rating = json_decode($ComponentRequest->for_rating, true) ;
                                                                @endphp
                                                                @for($i = 0; $i < $test; $i++ )
                                                                @if(!empty($rating[$i]))
                                                                <tr>
                                                                    <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                    <td style="width:20px"> {{ $rating[$i."_name"] }} </td>
                                                                    <td style="width:20px"> : {{ $rating[$i] }} </td>
                                                                </tr>
                                                                @endif
                                                                @endFor
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <br>
                                                Approval Request to carry out :
                                                <span @if(empty($ar_carry_out['inspection'])) style="text-decoration: line-through" @endif>Inspection</span> /
                                                <span @if(empty($ar_carry_out['testing'])) style="text-decoration: line-through" @endif> Testing</span>  /
                                                <span @if(empty($ar_carry_out['repair'])) style="text-decoration: line-through" @endif>Repair</span> /
                                                <span @if(empty($ar_carry_out['modification'])) style="text-decoration: line-through" @endif>Modification</span> /
                                                <span @if(empty($ar_carry_out['overhauled'])) style="text-decoration: line-through" @endif>Overhauled</span> (*) <br>
                                                <strong>(*) CROSS as Required</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <br>
                                                <strong>WORKSHOP GENERAL MANAGER STATEMENT</strong>
                                                <br>
                                                I certify that my department has the capability to maintain the above mentioned items, according to the AMO Manual 1.9.3 requirements :
                                                <br>
                                                <table style="width: 80%">
                                                    <tr>
                                                        <td>Facilities</td>
                                                        <td style="width:30px"><input type="checkbox" @if(!empty($manager_statement['facilities'])) checked @endif> </td>
                                                        <td>Qualified Personel</td>
                                                        <td style="width:30px"><input type="checkbox" @if(!empty($manager_statement['qualified_personel'])) checked @endif> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Special Tool</td>
                                                        <td style="width:30px"><input type="checkbox" @if(!empty($manager_statement['special_tools'])) checked @endif> </td>
                                                        <td>Approved Data</td>
                                                        <td style="width:30px"><input type="checkbox" @if(!empty($manager_statement['approved_data'])) checked @endif> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Special Equipment/Test Equipment</td>
                                                        <td style="width:30px"><input type="checkbox" @if(!empty($manager_statement['special_equipment'])) checked @endif> </td>
                                                        <td>Appropriate Rating</td>
                                                        <td style="width:30px"><input type="checkbox"@if(!empty($manager_statement['appropriate_rating'])) checked @endif> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <br>
                                                            <table>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        Workshop General Manager <br>
                                                                        Date :
                                                                        @if($request['checked_name'] != null)
                                                                        {{ date('d F Y', strtotime(\App\User::find($request['checked_name'])->created_at)) }}
                                                                        @if(\App\User::find($request['checked_name'])->signature != null)
                                                                        <img src="uploads/users/signature/{{ \App\User::find($request['checked_name'])->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -30px;">
                                                                        @endif
                                                                        <br>
                                                                        ({{ \App\User::find($request['checked_name'])->name }})
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td class="text-center">
                                                Riviewed & Disposed by Lead Auditor <br>
                                                @if($request['approve_name'])
                                                @if(\App\User::find($request['approve_name'])->signature != null)
                                                <img src="uploads/users/signature/{{ \App\User::find($request['approve_name'])->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -5px;">
                                                @endif
                                                <br>
                                                ({{ App\User::find($request['approve_name'])->name }})
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="fullwidth">
                                        <tr>
                                            <td >
                                                <table>
                                                    <tr>
                                                        <td style="width:20px"><input type="checkbox" @if($request['status'] == 3) checked @endif></td>
                                                        <td>Aproved</td>
                                                        <td style="width:20px"></td>
                                                        <td style="width:20px"><input type="checkbox" @if($request['status'] == 4) checked @endif ></td>
                                                        <td>Disapproved</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Reason of Disapproval:<br>
                                                @if($request['status'] == 4)
                                                @php $note = \App\RequestHistory::where('request_submittion_id', $request['id'] )->orderBy('id','desc')->first()  @endphp
                                                <p>
                                                    {{ $note->note }}
                                                </p>
                                                @else
                                                .............................................................................................. <br>
                                                @endif

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


        @endif

    @if($type == 'lanscape')
        <table class="table table-bordered mini-line-hight-2" style="margin:0px">
            <tr>
                <td style="width: 33.33%">SHOP MAINTENANCE : {{ $ComponentRequest->workshop }}</td>
                <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                <td style="width: 33.33%" >NO. {{ $shopability->shop_maintenance_no }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid white ;">
                    <div class="row">
                        <div class="col-xs-3">
                            Desciption
                        </div>
                        <div class="col-xs-6">
                            : @if(!empty($som['OWNER CODE']) ) {{ $som['OWNER CODE'] }} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            PART NUMBER
                        </div>
                        <div class="col-xs-6">
                            : {{ str_replace('|',', ', $ComponentRequest->part_number) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            TBO
                        </div>
                        <div class="col-xs-8">
                            : @if(!empty($som['TBO']) )  {{ $som['TBO'] }} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            CHECK PERIOD
                        </div>
                        <div class="col-xs-8">
                            : @if(!empty($som['CHECK PERIOD']) )  {{ $som['CHECK PERIOD'] }} @endif
                        </div>
                    </div>
                </td>
                <td style="border-right: 1px solid white ;">
                    <div class="row">
                        <div class="col-xs-3">
                            TYPE MODEL
                        </div>
                        <div class="col-xs-6">
                            : @if(!empty($som['TYPE MODEL']) ) {{ $som['TYPE MODEL'] }} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            NOMENCLATURE
                        </div>
                        <div class="col-xs-6">
                            : {{ $ComponentRequest->component_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            MANUFACTURER
                        </div>
                        <div class="col-xs-6">
                            : {{ $ComponentRequest->vendor_manufacturer }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            AIRCRAFT TYPE
                        </div>
                        <div class="col-xs-3">
                            : {{ $ComponentRequest->aircraft_type }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            ATA CHAPTER
                        </div>
                        <div class="col-xs-6">
                            : {{ $ComponentRequest->ata_chapter }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            SYSTEM
                        </div>
                        <div class="col-xs-6">
                            : @if(!empty($som['SYSTEM']) )  {{ $som['SYSTEM'] }} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            Document
                        </div>
                        <div class="col-xs-9"> :
                            @foreach( $request['component_document'] as $doc )
                                Doc No {{ $doc['no_document'] }},Rev. {{ $doc['rev'] }} Rev Date {{ $doc['rev_date'] }} <br>
                            @endForeach

                        </div>
                    </div>
                </td>
                <td>
                    CAPABILITY LEVEL <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="checkbox" @if(!empty($capability_level['inspection'])) checked @endif>
                            <label > INSPECTION </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['repair'])) checked @endif>
                            <label > Repair </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['testing'])) checked @endif>
                            <label > TESTING </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['modification'])) checked @endif>
                            <label > MODIFICATION </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['overhauled'])) checked @endif>
                            <label > OVERHAULED </label>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
        <?php
            $tot_equipment = count($request['component_test_equipment']) ;
            $tot_special = count($request['component_special_tool']) ;
            if($tot_equipment > $tot_special){
                $count = $tot_equipment ;
            }else{
                $count = $tot_special ;
            }

         ?>

         <table class="table table-bordered mini-line-height-2 fullwidth" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td colspan="4"  class="text-center"> TEST EQUIPMENT </td>
                 <td colspan="4"  class="text-center"> SPECIAL TOOLS </td>
             </tr>
             <tr>
                 <td style="width:100px;" Class="text-center">PART NUMBER</td>
                 <td style="width:100px;" Class="text-center">PART NAME</td>
                 <td style="width:50px;" Class="text-center">AVAILABLE</td>
                 <td style="width:50px;" Class="text-center">ALTERNATE PN</td>
                 <td style="width:50px;" Class="text-center">ALTERNATE NAME</td>
                 <td style="width:150px;" Class="text-center">REMARKS</td>
                 <td style="width:100px;" Class="text-center">PART NUMBER</td>
                 <td style="width:100px;" Class="text-center">PART NAME</td>
                 <td style="width:50px;" Class="text-center">AVAILABLE</td>
                 <td style="width:50px;" Class="text-center">ALTERNATE PN</td>
                 <td style="width:50px;" Class="text-center">ALTERNATE NAME</td>
                 <td style="width:150px;" Class="text-center">REMARKS</td>
             </tr>
             @for($i = 0; $i < $count ; $i ++)
                <tr>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentTestEquipment[$i]->part_number)){{$request->ComponentTestEquipment[$i]->part_number}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentTestEquipment[$i]->part_name)){{$request->ComponentTestEquipment[$i]->part_name}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentTestEquipment[$i]->available)){{$request->ComponentTestEquipment[$i]->available}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentTestEquipment[$i]->remark)){{$request->ComponentTestEquipment[$i]->remark}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentSpecialTool[$i]->part_number)){{$request->ComponentSpecialTool[$i]->part_number}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentSpecialTool[$i]->part_name)){{$request->ComponentSpecialTool[$i]->part_name}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentSpecialTool[$i]->available)){{$request->ComponentSpecialTool[$i]->available}}@endif</td>
                    <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentSpecialTool[$i]->remark)){{$request->ComponentSpecialTool[$i]->remark}}@endif</td>
                </tr>
             @endfor
             <tr>
                 <td
                     @if($i == 1)
                        style="height:250px"
                     @endif
                     @if($i == 2)
                        style="height:230px"
                     @endif
                     @if($i == 3)
                        style="height:210px"
                     @endif
                     @if($i == 4)
                        style="height:190px"
                     @endif
                     @if($i <= 5)
                        style="height:150px"
                     @endif
                     @if($i <= 10)
                        style="height:50px"
                     @endif
                    ></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
             </tr>
         </table>
         <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td style="width:30%">
                     Test Condition :
                     <table style="width:100% ; font-size:6pt;">
                         <tr>
                             <td style="width:20px;">Temp(min)</td>
                             <td>: @if(!empty($test_condition['temp_min'])) {{ $test_condition['temp_min'] }} @endif  </td>
                             <td style="width:20px;">Humidity(max)</td>
                             <td>: @if(!empty($test_condition['humidity_max'])) {{ $test_condition['humidity_max'] }} @endif </td>
                         </tr>
                         <tr>
                             <td>Temp(max)</td>
                             <td>: @if(!empty($test_condition['temp_max'])) {{ $test_condition['temp_max'] }} @endif </td>
                             <td>Press(min)</td>
                             <td>: @if(!empty($test_condition['pres_min'])) {{ $test_condition['pres_min'] }} @endif </td>
                         </tr>
                         <tr>
                             <td>Humidity(min)</td>
                             <td>: @if(!empty($test_condition['humidity_min'])) {{ $test_condition['humidity_min'] }} @endif </td>
                             <td>Press(max)</td>
                             <td>: @if(!empty($test_condition['pres_max'])) {{ $test_condition['pres_max'] }} @endif </td>
                         </tr>
                     </table>
                     Others :
                     @if(!empty($test_condition['others'])) {{ $test_condition['others'] }} @endif
                 </td>
                 <td style="width:30%">
                     Storage Condition :
                     <table style="width:100% ;font-size:6pt">
                         <tr>
                             <td style="width:20px;">Temp(min)</td>
                             <td>: @if(!empty($storage_condition['temp_min'])) {{ $storage_condition['temp_min'] }} @endif  </td>
                             <td style="width:20px;">Humidity(max)</td>
                             <td>: @if(!empty($storage_condition['humidity_max'])) {{ $storage_condition['humidity_max'] }} @endif </td>
                         </tr>
                         <tr>
                             <td>Temp(max)</td>
                             <td>: @if(!empty($storage_condition['temp_max'])) {{ $storage_condition['temp_max'] }} @endif </td>
                             <td>Press(min)</td>
                             <td>: @if(!empty($storage_condition['pres_min'])) {{ $storage_condition['pres_min'] }} @endif </td>
                         </tr>
                         <tr>
                             <td>Humidity(min)</td>
                             <td>: @if(!empty($storage_condition['humidity_min'])) {{ $storage_condition['humidity_min'] }} @endif </td>
                             <td>Press(max)</td>
                             <td>: @if(!empty($storage_condition['pres_max'])) {{ $storage_condition['pres_max'] }} @endif </td>
                         </tr>
                     </table>
                     Others :
                     @if(!empty($test_condition['others'])) {{ $test_condition['others'] }} @endif
                 </td>
                 <td style="width:40%">
                     <table class="fullwidth">
                         <tr>
                             <td class="text-center">
                                 PREPARED BY : <br>
                                 PRODUCTION MANAGER
                             </td>
                             <td class="text-center">
                                 CHECKED BY : <br>
                                 PRODUCTION MANAGER
                             </td>
                         </tr>
                         <tr>
                             <td>SIGNATURE :
                                 @if($user->signature != null)
                                 <img src="uploads/users/signature/{{ $request->User->signature  }}" height="50" style="margin-bottom : -30px; margin-left : -30px;">
                                 @endif
                                 <br>
                                 <br>
                             </td>
                             <td>SIGNATURE :
                                 @if($request['checked_name'] != null)
                                     @if(\App\User::find($request['checked_name'])->signature != null)
                                     <img src="uploads/users/signature/{{ \App\User::find($request['checked_name'])->signature  }}" height="50" style="margin-bottom : -30px; margin-left : -30px;">
                                     @endif
                                 @endif
                                 <br>
                                 <br>
                              </td>
                         </tr>
                         <tr>
                             <td>NAME : {{ $user->name  }}</td>
                             <td>NAME : @if($request['checked_name'] != null) {{ \App\User::find($request['checked_name'])->name  }} @endif</td>
                         </tr>
                         <tr>
                             <td>DATE : @if($request->status != 0) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 1)->orderBy('id', 'desc')->first()->created_at)) }} @endif</td>
                             <td>DATE : @if($request['checked_name'] != null) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 2)->orderBy('id', 'desc')->first()->created_at)) }} @endif</td>
                         </tr>
                     </table>
                 </td>
             </tr>
         </table>

         <div class="page_break"></div>
         <table class="table table-bordered mini-line-hight-2" style="margin:0px">
             <tr>
                 <td style="width: 33.33%">SHOP MAINTENANCE : {{ $ComponentRequest->workshop }}</td>
                 <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                 <td style="width: 33.33%" >NO. {{ $shopability->shop_maintenance_no }}</td>
             </tr>
         </table>
         <table class="table table-bordered mini-line-height" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td colspan="2" style="width:175px;">
                     <input type="checkbox" @if(!empty($capability_level['inspection'])) checked @endif>
                     <label > INSPECTION </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['repair'])) checked @endif>
                     <label > Repair </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['testing'])) checked @endif>
                     <label > TESTING </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['modification'])) checked @endif>
                     <label > MODIFICATION </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['overhauled'])) checked @endif>
                     <label > OVERHAULED </label>
                 </td>
                 <td colspan="2" style="width:175px;">
                     AVAILBILE QUALIFIED PERSONEL : <br>
                     Nominate Certifying Staff : <br>
                     <ul style="list-style: none">
                         @foreach($request['component_personel'] as $certtify)
                         @if($certtify['nominate'] == 'Nominated Certifying Staff')
                             <li>
                                 {{ $certtify['name'] }} / {{ $certtify['id_number'] }}
                             </li>
                         @endif
                         @endForeach
                     </ul>
                     Nominate Technician : <br>
                    <ul style="list-style: none">
                     @foreach($request['component_personel'] as $tech)
                        @if($tech['nominate'] == 'Nominated Technician')
                            <li>
                                {{ $tech['name'] }} / {{ $tech['id_number'] }}
                            </li>
                        @endif
                     @endForeach
                     </ul>
                 </td>
                 <td colspan="4" style="width:350px;">
                     <table style="width:100%">
                         <tr>
                             <td>
                                 Test Condition :
                                 <table style="width:100% ;">
                                     <tr>
                                         <td style="width:20px;">Temp(min)</td>
                                         <td>: @if(!empty($test_condition['temp_min'])) {{ $test_condition['temp_min'] }} @endif  </td>
                                         <td style="width:20px;">Humidity(max)</td>
                                         <td>: @if(!empty($test_condition['humidity_max'])) {{ $test_condition['humidity_max'] }} @endif </td>
                                     </tr>
                                     <tr>
                                         <td>Temp(max)</td>
                                         <td>: @if(!empty($test_condition['temp_max'])) {{ $test_condition['temp_max'] }} @endif </td>
                                         <td>Press(min)</td>
                                         <td>: @if(!empty($test_condition['pres_min'])) {{ $test_condition['pres_min'] }} @endif </td>
                                     </tr>
                                     <tr>
                                         <td>Humidity(min)</td>
                                         <td>: @if(!empty($test_condition['humidity_min'])) {{ $test_condition['humidity_min'] }} @endif </td>
                                         <td>Press(max)</td>
                                         <td>: @if(!empty($test_condition['pres_max'])) {{ $test_condition['pres_max'] }} @endif </td>
                                     </tr>
                                 </table>
                                 Others :
                                 @if(!empty($test_condition['others'])) {{ $test_condition['others'] }} @endif
                             </td>
                             <td>
                                 Storage Condition :
                                 <table style="width:100% ;">
                                     <tr>
                                         <td style="width:20px;">Temp(min)</td>
                                         <td>: @if(!empty($storage_condition['temp_min'])) {{ $storage_condition['temp_min'] }} @endif  </td>
                                         <td style="width:20px;">Humidity(max)</td>
                                         <td>: @if(!empty($storage_condition['humidity_max'])) {{ $storage_condition['humidity_max'] }} @endif </td>
                                     </tr>
                                     <tr>
                                         <td>Temp(max)</td>
                                         <td>: @if(!empty($storage_condition['temp_max'])) {{ $storage_condition['temp_max'] }} @endif </td>
                                         <td>Press(min)</td>
                                         <td>: @if(!empty($storage_condition['pres_min'])) {{ $storage_condition['pres_min'] }} @endif </td>
                                     </tr>
                                     <tr>
                                         <td>Humidity(min)</td>
                                         <td>: @if(!empty($storage_condition['humidity_min'])) {{ $storage_condition['humidity_min'] }} @endif </td>
                                         <td>Press(max)</td>
                                         <td>: @if(!empty($storage_condition['pres_max'])) {{ $storage_condition['pres_max'] }} @endif </td>
                                     </tr>
                                 </table>
                                 Others :
                                 @if(!empty($test_condition['others'])) {{ $test_condition['others'] }} @endif
                             </td>

                         </tr>
                     </table>
                 </td>
             </tr>
             <tr>
                 <td colspan="4" class="text-center"> MATERIAL PLANNING</td>
                 <td colspan="4" class="text-center"> MANHOURS PLANNING</td>
             </tr>
             <tr>
                 <td style="width:50px;">No </td>
                 <td style="width:100px;">PART NUMBER</td>
                 <td style="width:150px;">DESCRIPTION</td>
                 <td style="width:50px;">QTY</td>
                 <td style="width:50px;">No </td>
                 <td style="width:150px;">TASK NAME</td>
                 <td style="width:75px;">MAN HOURS</td>
                 <td style="width:75px;">MAN POWER</td>
             </tr>

             <?php
                 $tot_material = count($request['component_material_planning']) ;
                 $tot_manhours = count($request['component_manhours_planning']) ;
                 if($tot_material >= $tot_manhours){
                     $loop = $tot_material ;
                 }else{
                     $loop = $tot_manhours ;
                 }
                 $no_material = 1;
                 $no_manhours = 1;

              ?>
              @for($i = 0; $i < $loop; $i++)
                  <tr>
                      <td style="border-bottom : 1px solid white ;">{{ $no_material++ }} </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->part_number)) {{ $request->ComponentMaterialPlanning[$i]->part_number }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->part_description)) {{ $request->ComponentMaterialPlanning[$i]->part_description }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->qty)) {{ $request->ComponentMaterialPlanning[$i]->qty }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">{{ $no_manhours++ }} </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->part_number)) {{ $request->ComponentManhoursPlanning[$i]->part_number }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->part_description)) {{ $request->ComponentManhoursPlanning[$i]->part_description }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->qty)) {{ $request->ComponentManhoursPlanning[$i]->qty }} @endif </td>
                  </tr>
              @endfor
              <tr>
                  <td
                      @if($i == 1)
                         style="height:350px"
                      @endif
                      @if($i == 2)
                         style="height:330px"
                      @endif
                      @if($i == 3)
                         style="height:310px"
                      @endif
                      @if($i == 4)
                         style="height:290px"
                      @endif
                      @if($i <= 5)
                         style="height:250px"
                      @endif
                      @if($i <= 10)
                         style="height:150px"
                      @endif
                      @if($i <= 15)
                         style="height:50px"
                      @endif
                     ></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
             </tr>
         </table>

         <div class="page_break"></div>
         <table style="width:100%">
             <tr>
                 <td>
                     <table class="table table-bordered">
                         <tr>
                             <td style="width: 33.33%" colspan="2">SHOP MAINTENANCE : {{ $ComponentRequest->workshop }}</td>
                             <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                             <td style="width: 33.33%" colspan="2">NO. {{ $shopability->shop_maintenance_no }}</td>
                         </tr>

                         <tr>
                             <td colspan="5" class="text-center"> 15. CONSUMABLE MATERIAL </td>
                         </tr>
                         <tr>
                             <td style="width:5%">NO</td>
                             <td>PART NUMBER</td>
                             <td>DESCRIPTION</td>
                             <td>QTY</td>
                             <td>REMARKS</td>
                         </tr>
                         @php $no = 1 ;@endphp
                         @foreach(json_decode($shopability->consumable_material) as $cm )
                         <tr>
                             <td style="width:5% ; border-bottom : 1px solid white ;">{{ $no++ }}</td>
                             <td style="border-bottom : 1px solid white ;">{{ $cm->part_number }}</td>
                             <td style="border-bottom : 1px solid white ;">{{ $cm->desciption }}</td>
                             <td style="width:5% ;border-bottom : 1px solid white ;">{{ $cm->qty }}</td>
                             <td style="border-bottom : 1px solid white ;">{{ $cm->remark }}</td>
                         </tr>
                         @endForeach
                         <tr>
                             <td
                             @if($no == 1)
                             style="height:350px"
                             @endif
                             @if($no <= 5)
                             style="height:250px"
                             @endif
                             @if($no <= 10)
                             style="height:150px"
                             @endif
                             @if($no <= 15)
                             style="height:50px"
                             @endif

                             ></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                         </tr>
                         <tr>
                             <td colspan="5">
                                 <table style="width:100%">
                                     <tr>
                                         <td class="text-center" style="width:33.3%">
                                             PREPARED BY <br>
                                             PRODUCTION ENGINER <br>
                                             @if($user->signature != null)
                                             <img src="uploads/users/signature/{{ $user->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                             @endif
                                             <br>
                                             NAME : {{ $user->name  }} <br>
                                             DATE : @if($request['status'] != 0) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request['id'])->where('status', 1)->orderBy('id', 'desc')->first()->created_at)) }} @endif
                                         </td>
                                         <td style="width:33.3%"></td>
                                         <td class="text-center" style="width:33.3%">
                                             CHECKED BY <br>
                                             PRODUCTION ENGINER <br>

                                             @if($request['checked_name'] != null)
                                                 @if(\App\User::find($request['checked_name'])->signature != null)
                                                 <img src="uploads/users/signature/{{ \App\User::find($request['checked_name'])->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                                 @endif
                                             @endif
                                             <br>
                                             NAME : @if($request['checked_name'] != null) {{ \App\User::find($request['checked_name'])->name  }} @endif <br>
                                             DATE : @if($request['checked_name'] != null) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request['id'])->where('status', 2)->orderBy('id', 'desc')->first()->created_at)) }} @endif
                                         </td>
                                     </tr>
                                 </table>
                             </td>
                         </tr>
                     </table>
                 </td>
             </tr>
         </table>
    @endif


    </body>
</html>
