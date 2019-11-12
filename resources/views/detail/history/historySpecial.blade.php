<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Detail Special Request</title>
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
        body, table  {
            font-size: 8pt;
        }
        </style>
    </head>
    <body>
        <?php
        $shopability = json_decode(json_encode($request['special_shop_ability'])) ;
        $specialrequest = json_decode(json_encode($request['special_request'])) ;
        $user = json_decode(json_encode($request['user'])) ;
        $personel = json_decode(json_encode($request['special_personel'])) ;
        $sheetlist = json_decode(json_encode($request['special_sheet_list'])) ;
        $specialtool = json_decode(json_encode($request['special_tools'])) ;
        $spcialpartlist = json_decode(json_encode($request['special_part_list'])) ;

        $doc_required = explode('|', $shopability->document_required) ;
        $te_partnumber = explode('|', $shopability->test_equipment_part_number) ;
        $te_partname = explode('|', $shopability->test_equipment_part_name) ;
        $st_partnumber = explode('|', $shopability->special_tool_part_number) ;
        $st_partname = explode('|', $shopability->special_tool_part_name) ;
        $remark = explode('|', $shopability->remark) ;


        $request = json_decode(json_encode($request)) ;

        for ($i=0; $i < count($doc_required); $i++) {
            $shopdocument[] = array(
                               'doc_required' => $doc_required[$i],
                               'te_partnumber' => $te_partnumber[$i],
                               'te_partname' => $te_partname[$i],
                               'st_partnumber' => $st_partnumber[$i],
                               'st_partname' => $st_partname[$i],
                               'remark' => $remark[$i],
                               );
        }

        $som = json_decode($shopability->summary_of_maintenance , true) ;
        $rating = json_decode($specialrequest->for_rating, true) ;
        $manual = json_decode($specialrequest->manual_revision, true) ;

       ?>
       @if($type == 'potrait')
               <table style="width:100%">
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
                                                   P/N to {{ $request->request_type }} (*) : {{ str_replace('|',', ',$specialrequest->part_number ) }}<br>
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
                                                               : {{ strtoupper($specialrequest->engine_name) }}
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                               Vendor of Manufacture Code
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($specialrequest->vendor_manufacturer) }}
                                                           </td>
                                                       </tr>
                                                   </table>
                                                   <table style="width:100%">
                                                       <tr>
                                                           <td>Aircraft Type : {{ strtoupper($specialrequest->aircraft_type) }}</td>
                                                           <td>ATA Chapter : {{ strtoupper($specialrequest->ata_chapter) }} </td>
                                                           <td>Workshop : {{ strtoupper($specialrequest->workshop) }} </td>
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
                                                                       $loop = count(json_decode($specialrequest->for_rating, true)) - (count(json_decode($specialrequest->for_rating, true))/3 + count(json_decode($specialrequest->for_rating, true))/3) ;
                                                                       $rating = json_decode($specialrequest->for_rating, true) ;
                                                                   @endphp
                                                                   @for($i = 0; $i < $test; $i++ )
                                                                   @if(!empty($rating[$i]))
                                                                       <tr>
                                                                           <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                           <td style="width:20px"> {{ $rating[$i.'_name'] }} </td>
                                                                           <td style="width:20px"> : {{ strtoupper($rating[$i]) }} </td>
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
                                                       <span @if($shopability->ability_inspection != 1) style="text-decoration: line-through" @endif>Inspection</span> /
                                                       <span @if($shopability->ability_testing  != 1) style="text-decoration: line-through" @endif> Testing</span>  /
                                                       <span @if($shopability->ability_repair  != 1) style="text-decoration: line-through" @endif>Repair</span> /
                                                       <span @if($shopability->ability_modification  != 1) style="text-decoration: line-through" @endif>Modification</span> /
                                                       <span @if($shopability->ability_overhauled  != 1) style="text-decoration: line-through" @endif>Overhauled</span> (*) <br>
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
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->facilities)) @if($specialrequest->facilities == 1) checked @endif @endif> </td>
                                                           <td>Qualified Personel</td>
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->qualified_personel) == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Tool</td>
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->special_tools) == 1) checked @endif > </td>
                                                           <td>Approved Data</td>
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->approved_data) == 1) checked @endif > </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Equipment/Test Equipment</td>
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->special_equipment)) @if($specialrequest->special_equipment == 1) checked @endif @endif> </td>
                                                           <td>Appropriate Rating</td>
                                                           <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->appropriate_rating) ==1 ) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <table>
                                                               <tr>
                                                                   <td class="text-center">
                                                                       Workshop General Manager <br>
                                                                       Date :
                                                                       @if($request->checked_name != null)
                                                                           {{  date('d F Y', strtotime(\App\User::find($request->checked_name)->created_at)) }}
                                                                           @if(\App\User::find($request->checked_name)->signature != null)
                                                                           <img src="uploads/users/signature/{{ \App\User::find($request->checked_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                                                           @endif
                                                                           ({{ \App\User::find($request->checked_name)->name }})
                                                                       @endif
                                                                   </td>
                                                               </tr>
                                                           </table>
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
                                                   @if($request->approve_name)
                                                       @if(\App\User::find($request->approve_name)->signature != null)
                                                       <img src="uploads/users/signature/{{ \App\User::find($request->approve_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -5px;">
                                                       @endif
                                                       <br>
                                                       ({{ App\User::find($request->approve_name)->name }})
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
                                                           <td style="width:20px"><input type="checkbox" @if($request->status == 3) checked @endif></td>
                                                           <td>Aproved</td>
                                                           <td style="width:20px"></td>
                                                           <td style="width:20px"><input type="checkbox" @if($request->status == 4) checked @endif ></td>
                                                           <td>Disapproved</td>
                                                       </tr>
                                                   </table>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>Reason of Disapproval:<br>
                                                   @if($request->status == 4)
                                                   @php $note = \App\RequestHistory::where('request_submittion_id', $request->id )->orderBy('id','desc')->first()  @endphp
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

               @if(!empty($rating['EASA RATING']))
                   <div class="page_break"></div>
                   <table style="width:100%">
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
                                                       P/N to {{ $request->request_type }} (*) : {{ str_replace('|',', ',$specialrequest->part_number ) }}<br>
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
                                                                   : {{ strtoupper($specialrequest->engine_name) }}
                                                               </td>
                                                           </tr>
                                                           <tr>
                                                               <td>
                                                                   Vendor of Manufacture Code
                                                               </td>
                                                               <td>
                                                                   : {{ strtoupper($specialrequest->vendor_manufacturer) }}
                                                               </td>
                                                           </tr>
                                                       </table>
                                                       <table style="width:100%">
                                                           <tr>
                                                               <td>Aircraft Type : {{ strtoupper($specialrequest->aircraft_type) }}</td>
                                                               <td>ATA Chapter : {{ strtoupper($specialrequest->ata_chapter) }} </td>
                                                               <td>Workshop : {{ strtoupper($specialrequest->workshop) }} </td>
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
                                                                           $loop = count(json_decode($specialrequest->for_rating, true)) - (count(json_decode($specialrequest->for_rating, true))/3 + count(json_decode($specialrequest->for_rating, true))/3) ;
                                                                           $rating = json_decode($specialrequest->for_rating, true) ;
                                                                       @endphp
                                                                       @for($i = 0; $i < $test; $i++ )
                                                                       @if(!empty($rating[$i]))
                                                                           <tr>
                                                                               <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                               <td style="width:20px"> {{ $rating[$i.'_name'] }} </td>
                                                                               <td style="width:20px"> : {{ strtoupper($rating[$i]) }} </td>
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
                                                           <span @if($shopability->ability_inspection != 1) style="text-decoration: line-through" @endif>Inspection</span> /
                                                           <span @if($shopability->ability_testing  != 1) style="text-decoration: line-through" @endif> Testing</span>  /
                                                           <span @if($shopability->ability_repair  != 1) style="text-decoration: line-through" @endif>Repair</span> /
                                                           <span @if($shopability->ability_modification  != 1) style="text-decoration: line-through" @endif>Modification</span> /
                                                           <span @if($shopability->ability_overhauled  != 1) style="text-decoration: line-through" @endif>Overhauled</span> (*) <br>
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
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->facilities) == 1) checked @endif> </td>
                                                               <td>Qualified Personel</td>
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->qualified_personel) == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <td>Special Tool</td>
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->special_tools) == 1) checked @endif> </td>
                                                               <td>Approved Data</td>
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->approved_data) == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <td>Special Equipment/Test Equipment</td>
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->special_equipment))@if($specialrequest->special_equipment == 1) checked @endif @endif> </td>
                                                               <td>Appropriate Rating</td>
                                                               <td style="width:30px"><input type="checkbox" @if(!empty($specialrequest->appropriate_rating) == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <table>
                                                                   <tr>
                                                                       <td class="text-center">
                                                                           Workshop General Manager <br>
                                                                           Date :
                                                                           @if($request->checked_name != null)
                                                                               {{  date('d F Y', strtotime(\App\User::find($request->checked_name)->created_at)) }}
                                                                               @if(\App\User::find($request->checked_name)->signature != null)
                                                                               <img src="uploads/users/signature/{{ \App\User::find($request->checked_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                                                               @endif
                                                                               ({{ \App\User::find($request->checked_name)->name }})
                                                                           @endif
                                                                       </td>
                                                                   </tr>
                                                               </table>
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
                                                       @if($request->approve_name)
                                                           @if(\App\User::find($request->approve_name)->signature != null)
                                                           <img src="uploads/users/signature/{{ \App\User::find($request->approve_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -5px;">
                                                           @endif
                                                           <br>
                                                           ({{ App\User::find($request->approve_name)->name }})
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
                                                               <td style="width:20px"><input type="checkbox" @if($request->status == 3) checked @endif></td>
                                                               <td>Aproved</td>
                                                               <td style="width:20px"></td>
                                                               <td style="width:20px"><input type="checkbox" @if($request->status == 4) checked @endif ></td>
                                                               <td>Disapproved</td>
                                                           </tr>
                                                       </table>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td>Reason of Disapproval:<br>
                                                       @if($request->status == 4)
                                                       @php $note = \App\RequestHistory::where('request_submittion_id', $request->id )->orderBy('id','desc')->first()  @endphp
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
        @endif

        @if($type == 'lanscape')
        <!-- <div class="page_break"></div> -->
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">

                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ strtoupper($shopability->shop_maintenance)}}</td>
                            <td colspan="3" style="width:33.3%" class="text-center">SHOP ABILITY</td>
                            <td style="width:33.3%">  2. No. : {{ strtoupper($shopability->shop_ability_number)}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                3. SUMMARY OF MAINTENANCE RESOURCES : <br>
                                <table style="width:100%">
                                    <tr>
                                        <td>OWNER CODE</td>
                                        <td>: {{ strtoupper($som['OWNER CODE']) }}</td>
                                        <td>AIRCRAFT TYPE </td>
                                        <td>: {{ $specialrequest->aircraft_type }}</td>
                                        <td>TBO </td>
                                        <td>: {{ strtoupper($som['TBO']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>NOMENCLATURE</td>
                                        <td>: {{ strtoupper($som['NOMENCLATURE']) }}</td>
                                        <td>ATA CHAPTER </td>
                                        <td>: {{ $specialrequest->ata_chapter }}</td>
                                        <td>CHECK PERIOD </td>
                                        <td>: {{ strtoupper($som['CHECK PERIOD']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>PART NUMBER</td>
                                        <td>: {{ $specialrequest->part_number }}</td>
                                        <td>SYSTEM </td>
                                        <td>: {{ strtoupper($som['SYSTEM']) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><br> </td>
                                    </tr>
                                    <tr>
                                        <td>TYPE MODEL</td>
                                        <td>: {{ strtoupper($som['TYPE MODEL']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>MANUFACTURER</td>
                                        <td>: {{ strtoupper($specialrequest->vendor_manufacturer) }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" valign="middle" class="text-center" style="width:20%">4. DOCUMENTATION REQUIRED</td>
                            <td colspan="2" class="text-center" style="width:30%">5. TEST EQUIPMENT REQUIRED</td>
                            <td colspan="2" class="text-center" style="width:30%">6. SPECIAL TOOL REQUIRED</td>
                            <td rowspan="2" valign="middle" class="text-center" style="width:20%">7. REMARKS</td>
                        </tr>
                        <tr>
                            <td class="text-center">PART NUMBER</td>
                            <td class="text-center">PART NAME</td>
                            <td class="text-center">PART NUMBER</td>
                            <td class="text-center">PART NAME</td>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach($shopdocument as $sd )
                        @php $no++ @endphp
                        <tr>
                            <td class="text-center" style="min-height:200px; border-bottom : 1px solid white ;  ">{{ $sd['doc_required'] }}</td>
                            <td class="text-center" style="border-bottom : 1px solid white ;">{{ $sd['te_partname'] }}</td>
                            <td class="text-center" style="border-bottom : 1px solid white ;">{{ $sd['te_partnumber']}}</td>
                            <td class="text-center" style="border-bottom : 1px solid white ;">{{ $sd['st_partname'] }}</td>
                            <td class="text-center" style="border-bottom : 1px solid white ;">{{ $sd['st_partnumber'] }}</td>
                            <td class="text-center" style="border-bottom : 1px solid white ;">{{ $sd['remark'] }}</td>
                        </tr>
                        @endforeach
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
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width:33.3%">1. SHOP MAINTENANCE : {{ strtoupper($shopability->shop_maintenance)}}</td>
                            <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                            <td style="width:33.3%">  2. No. : {{ strtoupper($shopability->shop_ability_number)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">8. AVAILBILE MANUFACTURERS DOCUMENTATION DRAWING : {{ strtoupper($shopability->manufacture_documentation_drawing) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">9. AVAILBILE INSPECTION SCHEMA, TEST INTRUCTION, CHECK LIST ETC : {{ strtoupper($shopability->inspection)}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">10. AVAILBILE TOOLS/EQUIPMENT : {{ strtoupper($shopability->tool_equipment) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">11. SPECIAL WORK TO BE ORDER OUTSIDE : {{ strtoupper($shopability->special_work) }} </td>
                        </tr>
                        <tr>
                            <td colspan="3">12. PARTICULARS : {{ strtoupper($shopability->particular) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">13. AVAILBILE QUALIFIED PERSONNEL : {{ strtoupper($shopability->available_qualified) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                14.   ABILITY
                                <table style="width:100%">
                                    <td class="text-center">
                                        <input type="checkbox" @if($shopability->ability_inspection == 1) checked @endif > YES <br>
                                        INSPECTION : <br>
                                        <input type="checkbox" @if($shopability->ability_inspection == 0 ) checked @endif > NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if($shopability->ability_testing == 1) checked @endif> YES <br>
                                        TESTING : <br>
                                        <input type="checkbox" @if($shopability->ability_testing == 0) checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if($shopability->ability_repair == 1) checked @endif> YES <br>
                                        REPAIR : <br>
                                        <input type="checkbox" @if($shopability->ability_repair == 0) checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if($shopability->ability_modification == 1) checked @endif> YES <br>
                                        MODIFICATION : <br>
                                        <input type="checkbox" @if($shopability->ability_modification == 0) checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if($shopability->ability_overhauled == 1) checked @endif > YES <br>
                                        OVERHAULED : <br>
                                        <input type="checkbox" @if($shopability->ability_overhauled == 0) checked @endif> NO
                                    </td>
                                </table>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="page_break"></div>

        <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ strtoupper($shopability->shop_maintenance)}}</td>
                <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                <td colspan="2" style="width:33.3%">  2. No. : {{ strtoupper($shopability->shop_ability_number)}}</td>
            </tr>
        </table>
        <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
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
        </table>
        <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
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
                                DATE : @if($request->status != 0) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 1)->orderBy('id', 'desc')->first()->created_at)) }} @endif
                            </td>
                            <td style="width:33.3%"></td>
                            <td class="text-center" style="width:33.3%">
                                CHECKED BY <br>
                                PRODUCTION ENGINER <br>

                                @if($request->checked_name != null)
                                @if(\App\User::find($request->checked_name)->signature != null)
                                <img src="uploads/users/signature/{{ \App\User::find($request->checked_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                @endif
                                @endif
                                <br>
                                NAME : @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->name  }} @endif <br>
                                DATE : @if($request->checked_name != null) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 2)->orderBy('id', 'desc')->first()->created_at)) }} @endif
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>


        <!-- end lanscape -->
        @endif

        @if($type == 'potrait2')
        <br>
        <br>
        <br>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <strong>
                        MANUAL STATUS CONFIRMATION <br>
                        Form No.: GMF/Q-324
                    </strong>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <br>
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                TO
                            </td>
                            <td>
                                : TECHNICAL PUBLICATION SERVICE DEPARTEMENT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SUBJECT
                            </td>
                            <td>
                                : MANUAL REVISION STATUS
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>

                    <table class="table table-bordered">
                        <tr>
                            <td  colspan="2" class="text-center">MANUAL STATUS CONFIRMATION</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                PLEASE VERIFY REVISION STATUS OF THE FOLLOWING DOCUMENT :
                                <table style="width:100%">
                                    <tr>
                                        <td>PART NUMBER</td>
                                        <td>: {{ str_replace('|',', ',$specialrequest->part_number )}}</td>
                                    </tr>
                                    <tr>
                                        <td>DESCRIPTION</td>
                                        <td>: Maintenance Manual</td>
                                    </tr>
                                    <tr>
                                        <td>ATA</td>
                                        <td>: {{ $manual['maintenance_manual_ata'] }}  ({{ strtoupper($manual['maintenance_manual_doc_no']) }})</td>
                                    </tr>
                                    <tr>
                                        <td>MANUFACTURE</td>
                                        <td>: {{ strtoupper($specialrequest->vendor_manufacturer) }}</td>
                                    </tr>
                                    <tr>
                                        <td>CAPABILITY</td>
                                        <td>:
                                            @php
                                                $test = count(\App\ForRating::get());
                                                $rating = json_decode($specialrequest->for_rating, true) ;
                                                $cek = 1 ;
                                                $no = 1;
                                            @endphp
                                            @for($i = 0; $i < $test; $i++ )
                                            @if(!empty($rating[$i]))
                                                 @php $cek++ @endphp
                                            @endif
                                            @endFor

                                            @for($i = 0; $i < $test; $i++ )
                                            @if(!empty($rating[$i]))
                                                {{ str_replace('RATING','',$rating[$i.'_name'] ) }}
                                                @if($no++ != ($cek-1)) / @endif
                                            @endif
                                            @endFor
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                TECHNICAL PUBLICATION SERVICE RESPONSE : <br>
                                Document number : {{ strtoupper($manual['maintenance_manual_doc_no']) }} <br>
                                This manual is update with revision number #54.0, {{ date('d M Y', strtotime( $manual['maintenance_manual_update'])) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                REQUESTED BY :
                                <br>
                                <table style="width:100%">
                                    <tr>
                                        <td  style="width:150px">NAME</td>
                                        <td valign='top' style="width:10px">:</td>
                                        <td> {{ $user->name  }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID NUMBER</td>
                                        <td valign='top'>:</td>
                                        <td> {{ $user->id_number  }}</td>
                                    </tr>
                                    <tr>
                                        <td>UNIT</td>
                                        <td valign='top'>:</td>
                                        <td> {{ $user->unit_code  }}</td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->status != 0) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 1)->orderBy('id', 'desc')->first()->created_at)) }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>SIGN</td>
                                        <td valign='top'>:</td>
                                        <td>
                                            @if($user->signature != null)
                                                <img src="uploads/users/signature/{{ $user->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px; padding-left:-30px;  padding-right:-30px" >
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 50%">
                                MANUAL CHECKED BY :
                                <table style="width:100%">
                                    <tr>
                                        <td>NAME</td>
                                        <td valign='top' style="width:10px; ">:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->name }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>ID NUMBER</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->id_number }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>UNIT</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->unit_code }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ date('d F Y', strtotime(\App\User::find($request->checked_name)->created_at)) }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>SIGN</td>
                                        <td valign='top'>:</td>
                                        <td>
                                            @if($request->checked_name != null)
                                                <img src="uploads/users/signature/{{ \App\User::find($request->checked_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
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

        <div class="page_break"></div>
        <br>
        <br>
        <br>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <strong>
                        MANUAL STATUS CONFIRMATION <br>
                        Form No.: GMF/Q-324
                    </strong>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <br>
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                TO
                            </td>
                            <td>
                                : TECHNICAL PUBLICATION SERVICE DEPARTEMENT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SUBJECT
                            </td>
                            <td>
                                : MANUAL REVISION STATUS
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td  colspan="2" class="text-center">MANUAL STATUS CONFIRMATION</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                PLEASE VERIFY REVISION STATUS OF THE FOLLOWING DOCUMENT :
                                <table style="width:100%">
                                    <tr>
                                        <td>PART NUMBER</td>
                                        <td>: {{str_replace('|',', ',$specialrequest->part_number )}}</td>
                                    </tr>
                                    <tr>
                                        <td>DESCRIPTION</td>
                                        <td>: Illustrated Parts Catalog</td>
                                    </tr>
                                    <tr>
                                        <td>ATA</td>
                                        <td>: {{ $manual['catalog_ata'] }}  ({{ strtoupper($manual['catalog_doc_no']) }})</td>
                                    </tr>
                                    <tr>
                                        <td>MANUFACTURE</td>
                                        <td>: {{ strtoupper($specialrequest->vendor_manufacturer) }}</td>
                                    </tr>
                                    <tr>
                                        <td>CAPABILITY</td>
                                        <td>:
                                            @php
                                                $test = count(\App\ForRating::get());
                                                $rating = json_decode($specialrequest->for_rating, true) ;
                                                $cek = 1 ;
                                                $no = 1;
                                            @endphp
                                            @for($i = 0; $i < $test; $i++ )
                                            @if(!empty($rating[$i]))
                                                 @php $cek++ @endphp
                                            @endif
                                            @endFor

                                            @for($i = 0; $i < $test; $i++ )
                                            @if(!empty($rating[$i]))
                                                {{ str_replace('RATING','',$rating[$i.'_name'] ) }}
                                                @if($no++ != ($cek-1)) / @endif
                                            @endif
                                            @endFor
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                TECHNICAL PUBLICATION SERVICE RESPONSE : <br>
                                Document number : {{ strtoupper($manual['catalog_doc_no']) }} <br>
                                This manual is update with revision number #54.0, {{ date('d M Y', strtotime($manual['catalog_update'])) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                REQUESTED BY :
                                <br>
                                <table style="width:100%">
                                    <tr>
                                        <td  style="width:150px">NAME</td>
                                        <td valign='top' style="width:10px">:</td>
                                        <td> {{ $user->name  }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID NUMBER</td>
                                        <td valign='top'>:</td>
                                        <td> {{ $user->id_number  }}</td>
                                    </tr>
                                    <tr>
                                        <td>UNIT</td>
                                        <td valign='top'>:</td>
                                        <td> {{ $user->unit_code  }}</td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->status != 0) {{  date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 1)->orderBy('id', 'desc')->first()->created_at)) }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>SIGN</td>
                                        <td valign='top'>:</td>
                                        <td>
                                            @if($user->signature != null)
                                                <img src="uploads/users/signature/{{ $user->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px; padding-left:-30px;  padding-right:-30px" >
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 50%">
                                MANUAL CHECKED BY :
                                <table style="width:100%">
                                    <tr>
                                        <td>NAME</td>
                                        <td valign='top' style="width:10px; ">:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->name }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>ID NUMBER</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->name }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>UNIT</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ \App\User::find($request->checked_name)->unit_code }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td valign='top'>:</td>
                                        <td> @if($request->checked_name != null) {{ date('d F Y', strtotime(\App\User::find($request->checked_name)->created_at)) }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td valign='top'>SIGN</td>
                                        <td valign='top'>:</td>
                                        <td>
                                            @if($request->checked_name != null)
                                                <img src="uploads/users/signature/{{ \App\User::find($request->checked_name)->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
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

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>{{ strtoupper($specialrequest->engine_name) }} PERSONEL</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>ID NUMBER</th>
                            <th>JOB TITLE </th>
                            <th>AUTHORIZED NO OR STAMP HOLDER</th>
                            <th>UNIT</th>
                            <th>SCOPE COMPETENCY</th>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach($personel as $ep)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ep->name }}</td>
                            <td>{{ $ep->id_number }}</td>
                            <td>{{ $ep->job_title }}</td>
                            <td>{{ $ep->auth_no_stamp_holder }}</td>
                            <td>{{ $ep->unit }}</td>
                            <td>{{ $ep->scope_competency }}</td>
                        </tr>
                        @endForeach
                    </table>
                </td>
            </tr>
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>{{ strtoupper($specialrequest->engine_name) }} SHEET LIST</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>Category</th>
                            <th>PD Sheet No</th>
                            <th>Description </th>
                        @php $no = 1 @endphp
                        @foreach($sheetlist as $ep)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ep->category }}</td>
                            <td>{{ $ep->pd_sheet_number }}</td>
                            <td>{{ $ep->description }}</td>
                        </tr>
                        @endForeach
                    </table>
                </td>
            </tr>
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>{{ strtoupper($specialrequest->engine_name) }} Tools</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>Part Number</th>
                            <th>Tool Name</th>
                            <th>Qty </th>
                            <th>Availability</th>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach($specialtool as $ep)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ep->part_name }}</td>
                            <td>{{ $ep->tool_name }}</td>
                            <td>{{ $ep->qty }}</td>
                            <td>{{ $ep->availability }}</td>
                        </tr>
                        @endForeach
                    </table>
                </td>
            </tr>
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>{{ strtoupper($specialrequest->engine_name) }} Part List</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>Part Name</th>
                            <th>Example of Part No.</th>
                            <th>Vendor Name</th>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach($spcialpartlist as $ep)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $ep->part_name }}</td>
                            <td>{{ $ep->example_part_number }}</td>
                            <td>{{ $ep->vendor_name }}</td>
                        </tr>
                        @endForeach
                    </table>
                </td>
            </tr>
        </table>
        @endif

    </body>
</html>
