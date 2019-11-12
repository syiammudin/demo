<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Detail ComponentRequest Request {{ $request->request_number }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">
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
          font-size: 11pt!important ;
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
            $pdf->page_text(20, $y, "Form No. :  GMF/Q-229 R4" , $font, $size );
        }
    </script>
    <!-- <div class="page_break"></div> -->
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">

                </td>
            </tr>

        </table>
        <table class="table table-bordered" style="margin-bottom:0px;">
          <tr>
            <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->ComponentRequest->workshop}}<</td>
            <td colspan="3" style="width:33.3%" class="text-center">SHOP ABILITY</td>
            <td style="width:33.3%">  2. No. : {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
          </tr>
          <tr>
            <td colspan="6">
              3. SUMMARY OF MAINTENANCE RESOURCES : <br>
              <table style="width:100%">
                <tr>
                  <td>OWNER CODE</td>
                  <td>: @if(!empty($som['OWNER CODE']))  {{ strtoupper($som['OWNER CODE']) }} @endif</td>
                  <td valign="top">AIRCRAFT TYPE </td>
                  <td>: {{ $request->ComponentRequest->aircraft_type }}</td>
                  <td>TBO </td>
                  <td>: @if(!empty($som['TBO']))  {{ strtoupper($som['TBO']) }} @endif</td>
                </tr>
                <tr>
                  <td>NOMENCLATURE</td>
                  <td>: @if(!empty($som['NOMENCLATURE']))  {{ strtoupper($som['NOMENCLATURE']) }} @endif</td>
                  <td>ATA CHAPTER </td>
                  <td>: {{ $request->ComponentRequest->ata_chapter }}</td>
                  <td>CHECK PERIOD </td>
                  <td>: @if(!empty($som['CHECK PERIOD']))  {{ strtoupper($som['CHECK PERIOD']) }} @endif</td>
                </tr>
                <tr>
                  <td valign="top">PART NUMBER</td>
                  <td>:
                    @if( count(explode('|',$request->ComponentRequest->part_number)) > 4 )
                    SEE LIST NO : PN/{{ $request->ComponentRequest->number_ability }}
                    @else
                    {{ str_replace("|",",",$request->ComponentRequest->part_number)  }}
                    @endif
                  </td>
                  <td>SYSTEM </td>
                  <td>: @if(!empty($som['SYSTEM']))  {{ strtoupper($som['SYSTEM']) }} @endif</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="6"><br> </td>style="margin-top: -2px; margin-bottom:0px;
                </tr>
                <tr>
                  <td>TYPE MODEL</td>
                  <td>: @if(!empty($som['TYPE MODEL']))  {{ strtoupper($som['TYPE MODEL']) }} @endif</td>
                </tr>
                <tr>
                  <td>MANUFACTURER</td>
                  <td>: {{ strtoupper($request->ComponentRequest->vendor_manufacturer) }}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table class="table table-sm table-bordered" style="margin-top: -2px; margin-bottom:0px;">
          <tr>
            <td rowspan="2" valign="middle" class="text-center" style="width:20%">4. DOCUMENTATION REQUIRED</td>
            <td colspan="2" class="text-center" style="width:30%">5. TEST EQUI  PMENT REQUIRED</td>
            <td colspan="2" class="text-center" style="width:30%">6. SPECIAL TOOL REQUIRED</td>
            <td rowspan="2" valign="middle" class="text-center" style="width:20%">7. REMARKS</td>
          </tr>
          <tr>
            <td class="text-center">PART NUMBER</td>
            <td class="text-center">PART NAME</td>
            <td class="text-center">PART NUMBER</td>
            <td class="text-center">PART NAME</td>
          </tr>
          @php
          $no = 1 ;
          $filterDocument = array_values(array_filter($request->ComponentDocument->toArray(), function($el) {
              return $el['document_type'] == 'Maintenance Manual';
          }));

          $tot_doc = count($filterDocument) ;

          $tot_te = count($request->ComponentTestEquipment) ;
          $tot_st = count($request->ComponentSpecialTool) ;
          if($tot_doc >= $tot_te && $tot_doc >= $tot_st){
            $count = $tot_doc ;
          }
          elseif($tot_te >= $tot_doc && $tot_te >= $tot_st){
            $count = $tot_te ;
          }
          elseif($tot_st >= $tot_doc && $tot_st >= $tot_te){
            $count = $tot_st ;
          }else{
            $count = $tot_doc ;
          }
          @endphp
          @if($count == 0)
          <tr>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
            <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
          </tr>
          @endif
          @for($i = 0; $i < $count; $i++)
          <tr>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="min-height:200px; border-bottom : 1px solid white ;  " @endif>
              @if(!empty($filterDocument[$i]))
              Doc No. {{ $filterDocument[$i]['no_document'] }}<br>
              Rev. {{ $filterDocument[$i]['rev'] }} , Rev Date {{ $filterDocument[$i]['rev_date'] }}
              @endif
            </td>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="border-bottom : 1px solid white ;" @endif>
              @if($tot_te == 0 && $i == 0) N/A @endif
              @if(!empty($request->ComponentTestEquipment[$i]))
              {{ $request->ComponentTestEquipment[$i]->part_number }}
              @endif
            </td>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="border-bottom : 1px solid white ;" @endif>
              @if($tot_te == 0 && $i == 0) N/A @endif
              @if(!empty($request->ComponentTestEquipment[$i]))
              {{ $request->ComponentTestEquipment[$i]->part_name }}
              @endif

            </td>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="border-bottom : 1px solid white ;" @endif>
              @if($tot_te == 0 && $i == 0) N/A @endif
              @if(!empty($request->ComponentSpecialTool[$i]))
              {{ $request->ComponentSpecialTool[$i]->part_number }}
              @endif

            </td>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="border-bottom : 1px solid white ;" @endif>
              @if($tot_te == 0 && $i == 0) N/A @endif
              @if(!empty($request->ComponentSpecialTool[$i]))
              {{ $request->ComponentSpecialTool[$i]->part_name }}
              @endif

            </td>
            <td class="text-center"  @if(($i < $count && $i < 8 || $tot_doc == 8 ) || $i > 8) style="border-bottom : 1px solid white ;" @endif>
              @if($tot_te == 0 && $i == 0) N/A @endif
              @if(!empty($request->ComponentSpecialTool[$i]))
              {{ $request->ComponentSpecialTool[$i]->remark }}
              @endif

            </td>
          </tr>
          @endFor
          @if($i < 9 &&  $tot_doc <= 9  || $i > 9 &&  $tot_doc >= 9)
          <tr>
            <td
            @if($i == 1)
            style="height:250px"
            @endif
            @if($i <= 5)
            style="height:150px"
            @endif
            @if($i <= 6)
            style="height:100px"
            @endif
            @if($i <= 10)
            style="height:20px"
            @endif

            ></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          @endif
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->ComponentRequest->workshop}}</td>
                            <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                            <td style="width:33.3%">  2. No. : {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">8. AVAILBILE MANUFACTURERS DOCUMENTATION DRAWING : {{ strtoupper($request->ComponentShopAbility->manufacture_documentation_drawing) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                              <table>
                                <tr>
                                  <td valign="top">9. AVAILBILE INSPECTION SCHEMA, TEST INTRUCTION, CHECK LIST ETC :  </td>
                                  <td>
                                    <pre>{{ $request->ComponentShopAbility->inspection }}
                                    </pre>
                                  </td>
                                </tr>
                              </table>

                              <!-- {{ strtoupper($request->ComponentShopAbility->inspection) }}</td> -->
                        </tr>
                        <tr>
                            <td colspan="3">10. AVAILBILE TOOLS/EQUIPMENT : {{ strtoupper($request->ComponentShopAbility->tool_equipment) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">11. SPECIAL WORK TO BE ORDER OUTSIDE : {{ strtoupper($request->ComponentShopAbility->special_work) }} </td>
                        </tr>
                        <tr>
                            <td colspan="3">12. PARTICULARS : {{ strtoupper($request->ComponentShopAbility->particular)    }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">13. AVAILBILE QUALIFIED PERSONNEL :
                              <?php
                                  $cek_personel = count($request->ComponentPersonel) ;
                               ?>
                               @if($cek_personel <= 3)
                                 @foreach($request->ComponentPersonel as $per)
                                    {{ $per->name }} {{ $per->id_number }},
                                 @endForeach
                               @else
                                  See Personnel table list
                               @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                14.   ABILITY
                                <table style="width:100%">
                                    <td class="text-center">
                                        <input type="checkbox" @if(!empty($ar_carry_out['inspection'])) @if($ar_carry_out['inspection'] == true) checked  @endif @endif > YES <br>
                                        INSPECTION : <br>
                                        <input type="checkbox" @if(!empty($ar_carry_out['inspection'])) @if($ar_carry_out['inspection'] == false) checked @endif @else checked @endif > NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if(!empty($ar_carry_out['testing'])) @if($ar_carry_out['testing'] == true) checked @endif @endif> YES <br>
                                        TESTING : <br>
                                        <input type="checkbox" @if(!empty($ar_carry_out['testing'])) @if($ar_carry_out['testing'] == false) checked @endif @else checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if(!empty($ar_carry_out['repair'])) @if($ar_carry_out['repair'] == true) checked @endif @endif> YES <br>
                                        REPAIR : <br>
                                        <input type="checkbox" @if(!empty($ar_carry_out['repair'])) @if($ar_carry_out['repair'] == false) checked @endif @else checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if(!empty($ar_carry_out['modification'])) @if($ar_carry_out['modification'] == true) checked @endif @endif> YES <br>
                                        MODIFICATION : <br>
                                        <input type="checkbox" @if(!empty($ar_carry_out['modification'])) @if($ar_carry_out['modification'] == false)checked @endif @else checked @endif> NO
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" @if(!empty($ar_carry_out['overhauled'])) @if($ar_carry_out['overhauled'] == true) checked @endif  @endif> YES <br>
                                        OVERHAULED : <br>
                                        <input type="checkbox" @if(!empty($ar_carry_out['overhauled'])) @if($ar_carry_out['overhauled'] == false ) checked @else  @endif  @else checked @endif> NO
                                    </td>
                                </table>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="page_break"></div>

        <table  class="table table-bordered table-sm" style="margin-top: -2px; margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->ComponentRequest->workshop }}</td>
                <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                <td colspan="2" style="width:33.3%">  2. No. : {{ $request->ComponentShopAbility->shop_maintenance_no }}</td>
            </tr>
        </table>
        <table  class="table table-bordered table-sm" style="margin-top: -2px; margin-bottom:0px;">
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
            @if(count(json_decode($request->ComponentShopAbility->consumable_material)) == 0)
            <tr>
                <td class="N/A" style="width:5% ; border-bottom : 1px solid white ;">N/A</td>
                <td class="N/A" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="N/A" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="N/A" style="border-bottom : 1px solid white ;">N/A</td>
                <td class="N/A" style="border-bottom : 1px solid white ;">N/A</td>
            </tr>
            @endif
            @foreach(json_decode($request->ComponentShopAbility->consumable_material) as $cm )
            <tr>
                <td style="width:5% ; border-bottom : 1px solid white ;">{{ $no++ }}</td>
                <td style="border-bottom : 1px solid white ;">{{ $cm->part_number }}</td>
                <td style="border-bottom : 1px solid white ;">{{ $cm->description }}</td>
                <td style="border-bottom : 1px solid white ;">{{ $cm->qty }}</td>
                <td style="border-bottom : 1px solid white ;">{{ $cm->remark }}</td>
            </tr>
            @endForeach
            <tr>
                <td
                @if($no == 1)
                   style="height:250px"
                @endif
                @if($no <= 5)
                   style="height:200px"
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
        <table  class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
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
                              PREPARED BY <br>
                              PRODUCTION ENGINER <br>
                              @if($user['user']['signature'] != null)
                                 <img src="uploads/users/signature/{{ $user['user']['signature']  }}" height="100" style="margin-top: -20px;">
                              @endif
                              <br>

                              NAME :  @if($request->status >= 1){{ $user['user']['name']  }} @endif <br>
                              DATE : @if($request->status >= 1) {{  date('d F Y', strtotime($user['created_at'])) }} @endif
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
                                 <img src="uploads/users/signature/{{ $manager['user']['signature']  }}" height="100" style="margin-top: -20px;">
                              @endif
                              <br>

                              NAME :  @if($request->status >= 2){{ $manager['user']['name']  }} @endif <br>
                              DATE : @if($request->status >= 2) {{  date('d F Y', strtotime($manager['created_at'])) }} @endif
                          </td>
                      </tr>
                    </table>

                </td>
            </tr>
        </table>
    </table>
    @endif
    <!-- end lanscape -->

      @if($type == 'potrait2')

      <?php
          $cek_personel = count($request->ComponentPersonel) ;
       ?>
      @if($cek_personel > 3)
          <table style="width:100%">
            <tr>
              <td class="text-center">
                <img src="{{ public_path('images/gmf.png') }}" width="200">
                <br>
                <br>
                <br>
                <strong>{{ strtoupper($request->ComponentRequest->component_name) }} PERSONEL</strong>
                <br>
              </td>
            </tr>
          </table>
          <table class="table table-bordered">
            <tr>
              <th style="width:20px">NO</th>
              <th>NAME</th>
              <th>ID NUMBER</th>
              <th>NOMINATE</th>
            </tr>
            @php $no = 1 @endphp
            @if(count($request->ComponentPersonel) == 0)
            <tr>
              <td class="text-center">N/A</td>
              <td class="text-center">N/A</td>
              <td class="text-center">N/A</td>
              <td class="text-center">N/A</td>
            </tr>
            @endif
            @foreach($request->ComponentPersonel as $ep)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $ep->name }}</td>
              <td>{{ $ep->id_number }}</td>
              <td>{{ $ep->nominate }}</td>
            </tr>
            @endForeach
          </table>
          @endif

      @endif

    </body>
</html>
