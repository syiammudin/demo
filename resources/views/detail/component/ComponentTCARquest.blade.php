<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Detail ComponentRequest Request {{ $request->request_number }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ storage_path('pdf.css') }}">
        <style media="screen">
        #watermark {
            font-size : 36pt;
            position: fixed;
            top: 30%;
            left: 30%;
            width: 100%;
            text-align: center;
            transform-origin: 50% 50%;
            z-index: 100;
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
        .firstPage{
          font-size: 11pt!important;
        }
        </style>
    </head>
    <body>

        @php
            $ar_carry_out  =  json_decode($request->ComponentRequest->aproval_request_carry_out, true) ;
            $manager_statement  =  json_decode($request->ComponentRequest->manager_statement, true) ;

            $som = json_decode($request->ComponentShopAbility->summary_of_maintenance  , true);
            $test_equipment = json_decode($request->ComponentShopAbility->test_equipment, true) ;
            $special_tool = json_decode($request->ComponentShopAbility->special_tool, true) ;
            $capability_level = json_decode($request->ComponentShopAbility->capability_level, true) ;
            $qualified_personel = json_decode($request->ComponentShopAbility->qualified_personel, true) ;
            $material_planning = json_decode($request->ComponentShopAbility->material_planning, true) ;
            $manhours_planning = json_decode($request->ComponentShopAbility->manhours_planning, true) ;
            $consumable_material = json_decode($request->ComponentShopAbility->consumable_material, true) ;
            $test_condition = json_decode($request->ComponentShopAbility->test_condition, true) ;
            $storage_condition = json_decode($request->ComponentShopAbility->storage_condition, true) ;
        @endphp
        @if($request->request_type == 'Delete')
        <div id="watermark">
          <center>
            <h1 style="border:1px solid; padding : 5px; background:white; width: 60%">{{ ucwords($request->remark_deletion) }}</h1>
          </center>
        </div>
        @endif
    @if($type == 'lanscape')
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                $size = 7;
                $font = $fontMetrics->getFont("Myriad");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size );
                $pdf->page_text(20, $y, "Form No. :  GMF/Q-183 R6" , $font, $size );
            }
        </script>
        <table class="table table-bordered mini-line-hight-2" style="margin-bottom: -2px">
            <tr>
                <td style="width: 33.33%">SHOP MAINTENANCE : {{ strtoupper($request->ComponentRequest->workshop) }}</td>
                <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                <td style="width: 33.33%" >NO. {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
            </tr>
        </table>
        <table class="table table-bordered mini-line-hight-2" style="margin:0px">
            <tr>
                <td style="width: 40%; border-right: 1px solid white ;">
                    <div class="row">
                        <div class="col-xs-3">
                            DESCRIPTION
                        </div>
                        <div class="col-xs-6">
                            : {{ strtoupper($request->ComponentRequest->component_name) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            PART NUMBER
                        </div>
                        <div class="col-xs-6">
                            : {{ str_replace('|',', ', $request->ComponentRequest->part_number) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            TBO
                        </div>
                        <div class="col-xs-8">
                            : @if(!empty($som['TBO']) )  {{ strtoupper($som['TBO']) }} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            CHECK PERIOD
                        </div>
                        <div class="col-xs-8">
                            : @if(!empty($som['CHECK PERIOD']) )  {{ strtoupper($som['CHECK PERIOD']) }} @endif
                        </div>
                    </div>
                </td>
                <td style="width: 40%;  border-right: 1px solid white ;">
                    <table class="fullwidth">
                        <tr>
                            <td style="width:120px">TYPE MODEL</td>
                            <td style="width:10px">:</td>
                            <td>@if(!empty($som['TYPE MODEL']) ) {{ strtoupper($som['TYPE MODEL']) }} @endif</td>
                        </tr>
                        <tr>
                            <td style="width:120px">MANUFACTURER</td>
                            <td>:</td>
                            <td>{{ strtoupper($request->ComponentRequest->vendor_manufacturer) }}</td>
                        </tr>
                        <tr>
                            <td style="width:120px" valign="top">AIRCRAFT TYPE</td>
                            <td valign="top">:</td>
                            <td>{{ str_replace('|',';',$request->ComponentRequest->aircraft_type) }}</td>
                        </tr>
                        <tr>
                            <td style="width:120px">ATA CHAPTER</td>
                            <td>:</td>
                            <td>{{ $request->ComponentRequest->ata_chapter }}</td>
                        </tr>
                        <tr>
                            <td style="width:120px">SYSTEM</td>
                            <td>:</td>
                            <td>@if(!empty($som['SYSTEM']) )  {{ strtoupper($som['SYSTEM']) }} @endif</td>
                        </tr>
                        <tr>
                            <td style="width:120px" valign="top">DOCUMENT</td>
                            <td valign="top">:</td>
                            <td>
                                @foreach( $request->ComponentDocument as $doc )
                                  @if($doc->document_type == 'Maintenance Manual')
                                    Doc No {{ strtoupper($doc->no_document) }},Rev. {{ strtoupper($doc->rev) }} Rev Date {{ $doc->rev_date }} <br>
                                  @endif
                                @endForeach
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    CAPABILITY LEVEL <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="checkbox" @if(!empty($capability_level['inspection'])) checked @endif>
                            <label style="margin-left: 5px"> INSPECTION </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['repair'])) checked @endif>
                            <label style="margin-left: 5px"> Repair </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['testing'])) checked @endif>
                            <label style="margin-left: 5px"> TESTING </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['modification'])) checked @endif>
                            <label style="margin-left: 5px"> MODIFICATION </label>
                            <br>
                            <input type="checkbox" @if(!empty($capability_level['overhauled'])) checked @endif>
                            <label style="margin-left: 5px"> OVERHAULED </label>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
        <?php
            $tot_equipment = count($request->ComponentTestEquipment) ;
            $tot_special = count($request->ComponentSpecialTool) ;
            if($tot_equipment > $tot_special){
                $count = $tot_equipment ;
            }else{
                $count = $tot_special ;
            }

            $no = 1;

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
                 <td style="width:150px;" Class="text-center">REMARKS</td>
                 <td style="width:100px;" Class="text-center">PART NUMBER</td>
                 <td style="width:100px;" Class="text-center">PART NAME</td>
                 <td style="width:50px;" Class="text-center">AVAILABLE</td>
                 <td style="width:150px;" Class="text-center">REMARKS</td>
             </tr>
             @if($count == 0)
             <tr>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;" >N/A</td>
             </tr>
             @endif
             @for($i = 0; $i < $count ; $i ++)
                <tr>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentTestEquipment[$i]->part_number)){{$request->ComponentTestEquipment[$i]->part_number}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentTestEquipment[$i]->part_name)){{$request->ComponentTestEquipment[$i]->part_name}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentTestEquipment[$i]->available)){{$request->ComponentTestEquipment[$i]->available}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentTestEquipment[$i]->remark)){{$request->ComponentTestEquipment[$i]->remark}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentSpecialTool[$i]->part_number)){{$request->ComponentSpecialTool[$i]->part_number}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentSpecialTool[$i]->part_name)){{$request->ComponentSpecialTool[$i]->part_name}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentSpecialTool[$i]->available)){{$request->ComponentSpecialTool[$i]->available}}@endif</td>
                    <td @if(($i < $count && $i < 13) || $i > 13) style="border-bottom : 1px solid white ;" @endif>@if(!empty($request->ComponentSpecialTool[$i]->remark)){{$request->ComponentSpecialTool[$i]->remark}}@endif</td>
                </tr>
             @endfor
             @if($i < 14  || $i > 14)
             <tr >
                 <td
                 @if($i == 1)
                    style="height:250px"
                 @endif
                 @if($i == 2)
                    style="height:220px"
                 @endif
                 @if($i == 3)
                    style="height:180px"
                 @endif
                 @if($i == 4)
                    style="height:150px"
                 @endif
                 @if($i <= 5)
                    style="height:100px"
                 @endif
                 @if($i <= 10)
                    style="height:10px"
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
             @endif
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
                                 PRODUCTION ENGINER
                             </td>
                             <td class="text-center">
                                 CHECKED BY : <br>
                                 PRODUCTION ENGINER
                             </td>
                         </tr>
                         @php
                             $filterUser = array_filter($request->RequestHistory->toArray(), function($el) {
                                 return $el['status'] == 1;
                             });
                             $user = end($filterUser) ;

                             $filter_manager = array_filter($request->RequestHistory->toArray(), function($el) {
                                 return $el['status'] == 2;
                             });
                             $manager = end($filter_manager) ;
                         @endphp
                         <tr>
                             <td>SIGNATURE :
                                 @if($user['user']['signature'] != null)
                                     <img src="uploads/users/signature/{{ $user['user']['signature']  }}" height="50" style=" margin-bottom: -10px;">
                                 @endif
                                 <br>
                                 <br>
                             </td>
                             <td>SIGNATURE :
                                 @if($request->status >= 2)
                                     @if( $manager['user']['signature'] != null)
                                     <img src="uploads/users/signature/{{  $manager['user']['signature']  }}" height="50" style="margin-bottom : -10px; ">
                                     @endif
                                 @endif
                                 <br>
                                 <br>
                              </td>
                         </tr>
                         <tr>
                             <td>NAME : {{ $user['user']['name'] }}</td>
                             <td>NAME : @if($request->status >= 2) {{  $manager['user']['name']  }} @endif</td>
                         </tr>
                         <tr>
                             <td>DATE : @if($request->status != 0) {{  date('d F Y', strtotime($user['created_at'])) }} @endif</td>
                             <td>DATE : @if($request->status >= 2) {{  date('d F Y', strtotime($manager['created_at'])) }} @endif</td>
                         </tr>
                     </table>
                 </td>
             </tr>
         </table>

         <div class="page_break"></div>
         <table class="table table-bordered mini-line-hight-2" style="margin:0px">
             <tr>
                 <td style="width: 33.33%">SHOP MAINTENANCE : {{ $request->ComponentRequest->workshop }}</td>
                 <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                 <td style="width: 33.33%" >NO. {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
             </tr>
         </table>
         <table class="table table-bordered mini-line-height" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td colspan="2" style="width:200px;">
                     <input type="checkbox" @if(!empty($capability_level['inspection'])) checked @endif>
                     <label style="margin-left: 5px"> INSPECTION </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['repair'])) checked @endif>
                     <label style="margin-left: 5px"> REPAIR </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['testing'])) checked @endif>
                     <label style="margin-left: 5px"> TESTING </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['modification'])) checked @endif>
                     <label style="margin-left: 5px"> MODIFICATION </label>
                     <br>
                     <input type="checkbox" @if(!empty($capability_level['overhauled'])) checked @endif>
                     <label style="margin-left: 5px"> OVERHAULED </label>
                     <br>
                     <br>
                     @if($request->ComponentRequest->limitation  !=  null)
                     Remark : <br>
                     {{ $request->ComponentRequest->limitation }}
                     @endif
                 </td>
                 <td colspan="2" style="width:250px;">
                     AVAILBILE QUALIFIED PERSONEL : <br>
                     Nominate Certifying Staff : <br>
                     <ul style="list-style: none">
                         @foreach($request->ComponentPersonel as $certtify)
                         @if($certtify->nominate == 'Nominated Certifying Staff')
                             <li>
                                 {{ $certtify->name }} / {{ $certtify->id_number }}
                             </li>
                         @endif
                         @endForeach
                     </ul>
                     Nominate Technician : <br>
                    <ul style="list-style: none">
                     @foreach($request->ComponentPersonel as $tech)
                        @if($tech->nominate == 'Nominated Technician')
                            <li>
                                {{ $tech->name }} / {{ $tech->id_number }}
                            </li>
                        @endif
                     @endForeach
                     </ul>
                 </td>
                 <td colspan="4">
                     <table style="width:100%">
                         <tr>
                             <td>
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
                             <td>
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

                         </tr>
                     </table>
                 </td>
             </tr>
             <tr>
                 <td colspan="4" class="text-center"> MATERIAL PLANNING</td>
                 <td colspan="4" class="text-center"> MANHOURS PLANNING</td>
             </tr>
         </table>
         <table class="table table-bordered mini-line-height" style="margin-top: -2px; margin-bottom:0px;">
              <tr>
                  <td style="width:20px;">No </td>
                  <td style="width:100px;">PART NUMBER</td>
                  <td style="width:150px;">DESCRIPTION</td>
                  <td style="width:50px;">QTY</td>
                  <td style="width:20px;">No </td>
                  <td style="width:150px;">TASK NAME</td>
                  <td style="width:75px;">MAN HOURS</td>
                  <td style="width:75px;">MAN POWER</td>
              </tr>

             <?php
                 $tot_material = count($request->ComponentMaterialPlanning) ;
                 $tot_manhours = count($request->ComponentManhoursPlanning) ;
                 if($tot_material >= $tot_manhours){
                     $loop = $tot_material ;
                 }else{
                     $loop = $tot_manhours ;
                 }
                 $no_material = 1;
                 $no_manhours = 1;
                 $no = 1;

              ?>
              @if($loop == 0)
              <tr>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
              </tr>
              @endif
              @for($i = 0; $i < $loop; $i++)
                  <tr>
                      <td style="border-bottom : 1px solid white ;">@if($no_material <= $tot_material) {{ $no_material++ }} @endif</td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->part_number)) {{ $request->ComponentMaterialPlanning[$i]->part_number }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->part_description)) {{ $request->ComponentMaterialPlanning[$i]->part_description }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentMaterialPlanning[$i]->qty)) {{ $request->ComponentMaterialPlanning[$i]->qty }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if($no_manhours <= $tot_manhours) {{ $no_manhours++ }} @endif</td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->task_name)) {{ $request->ComponentManhoursPlanning[$i]->task_name }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->man_hour)) {{ $request->ComponentManhoursPlanning[$i]->man_hour }} @endif </td>
                      <td style="border-bottom : 1px solid white ;">@if(!empty($request->ComponentManhoursPlanning[$i]->man_power)) {{ $request->ComponentManhoursPlanning[$i]->man_power }} @endif </td>
                  </tr>
              @endfor
             <tr>
                 <td
                 @if($i == 1)
                    style="height:250px"
                 @endif
                 @if($i == 2)
                    style="height:220px"
                 @endif
                 @if($i == 3)
                    style="height:180px"
                 @endif
                 @if($i == 4)
                    style="height:150px"
                 @endif
                 @if($i <= 5)
                    style="height:100px"
                 @endif
                 @if($i <= 10)
                    style="height:10px"
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
         <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td style="width: 33.33%" colspan="2">SHOP MAINTENANCE : {{ $request->ComponentRequest->workshop }}</td>
                 <td style="width: 33.33%" class="text-center"> SHOP ABILITY </td>
                 <td style="width: 33.33%" colspan="2">NO. {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
             </tr>
         </table>
         <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
             <tr>
                 <td colspan="5" class="text-center"> 15. CONSUMABLE MATERIAL </td>
             </tr>
             <tr>
                 <td>NO</td>
                 <td>PART NUMBER</td>
                 <td>DESCRIPTION</td>
                 <td>QTY</td>
                 <td>REMARKS</td>
             </tr>
             @php $no = 1 ;@endphp
             @if(count(json_decode($request->ComponentShopAbility->consumable_material)) == 0)
             <tr>
               <td class="text-center" style="width:5% ; border-bottom : 1px solid white ;">N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
               <td class="text-center" style="width:5% ;border-bottom : 1px solid white ;">N/A</td>
               <td class="text-center" style="border-bottom : 1px solid white ;">{N/A</td>
             </tr>
             @endif
             @foreach(json_decode($request->ComponentShopAbility->consumable_material) as $cm )
             <tr>
                 <td style="width:5% ; border-bottom : 1px solid white ;">{{ $no++ }}</td>
                 <td style="border-bottom : 1px solid white ;">{{ $cm->part_number }}</td>
                 <td style="border-bottom : 1px solid white ;">{{ $cm->description }}</td>
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
                               @php
                                   $filterUser = array_filter($request->RequestHistory->toArray(), function($el) {
                                       return $el['status'] == 1;
                                   });
                                   $user = end($filterUser)
                               @endphp
                               PREPARED BY :<br>
                               PRODUCTION ENGINER :<br>
                               @if($user['user']['signature'] != null)
                                  <img src="uploads/users/signature/{{ $user['user']['signature']  }}" height="100" style=" margin-top: -10px;">
                               @endif
                               <br>

                               NAME :  @if($request->status >= 1){{ $user['user']['name']  }} @endif <br>
                               DATE :  @if($request->status >= 1) {{  date('d F Y', strtotime($user['created_at'])) }} @endif
                           </td>
                           <td style="width:33.3%"></td>
                           <td class="text-center" style="width:33.3%">
                             @php
                                 $filter_manager = array_filter($request->RequestHistory->toArray(), function($el) {
                                     return $el['status'] == 2;
                                 });
                                 $manager = end($filter_manager)
                             @endphp
                               CHECKED BY <br>
                               PRODUCTION ENGINER <br>

                               @if($manager['user']['signature'] != null)
                                  <img src="uploads/users/signature/{{ $manager['user']['signature']  }}" height="100" style=" margin-top: -10px;">
                               @endif
                               <br>

                               NAME :  @if($request->status >= 2){{ $manager['user']['name']  }} @endif <br>
                               DATE :  @if($request->status >= 2) {{  date('d F Y', strtotime($manager['created_at'])) }} @endif
                           </td>
                       </tr>
                     </table>
                 </td>
             </tr>
         </table>
    @endif


    </body>
</html>
