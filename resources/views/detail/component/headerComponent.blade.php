<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ storage_path('pdf.css') }}">
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
    @if($type == 'potrait')
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                $size = 7;
                $font = $fontMetrics->getFont("Myriad");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text(20, $y, "Form No. :  GMF/Q-230 R6" , $font, $size );
            }
        </script>
        <table class="fullwidth">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                </td>
            </tr>
        </table>
        <table class="fullwidth firstPage">
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
                                            P/N to
                                            <span @if($request->request_type == 'Delete') style="text-decoration: line-through" @endif> Add </span> /
                                            <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span>
                                            (*)
                                            {{  str_replace('|',';', $request->ComponentRequest->part_number) }}
                                              @if($request->ComponentRequest->part_number_new != null), {{ str_replace('|',', ', $request->ComponentRequest->part_number_new) }} @endif
                                            <br>
                                            <strong>(*) Cross as required</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Compnonent Name
                                                    </td>
                                                    <td>
                                                        : {{ strtoupper($request->ComponentRequest->component_name) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Vendor of Manufacture Code
                                                    </td>
                                                    <td>
                                                        : {{ strtoupper($request->ComponentRequest->vendor_manufacturer) }}
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width:100%">
                                                <tr>
                                                    <td valign="top" style="width:47.5%">
                                                      <table>
                                                        <tr>
                                                          <td valign="top" style="width:32%">Aircraft Type :</td>
                                                          <td style="text-align:justify">
                                                            <p style="margin-right:10px;">
                                                              {{ str_replace('|',', ',$request->ComponentRequest->aircraft_type) }}
                                                            </p>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                    <td valign="top" style="width:25%;">  ATA Chapter : {{ $request->ComponentRequest->ata_chapter }} </td>
                                                    <td valign="top" style="width:27.5%"> Workshop : {{ strtoupper($request->ComponentRequest->workshop) }} </td>
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
                                                              $rating = json_decode($request->ComponentRequest->for_rating, true) ;
                                                              $i = 0 ;
                                                            @endphp
                                                            @foreach(\App\ForRating::get() as $value)
                                                                @if(!empty($rating[$i]))
                                                                  @if($rating[$value->name_of_rating])
                                                                  <tr>
                                                                      <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                      <td style="width:20px"> {{ $rating[$i."_name"] }} </td>
                                                                      <td style="width:20px"> : {{ $rating[$i] }} </td>
                                                                  </tr>
                                                                  @endif
                                                                @endif
                                                                @php $i++ @endphp
                                                            @endForeach
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
                                                                    @php
                                                                        $filter_gm = array_filter($request->RequestHistory->toArray(), function($el) {
                                                                            return $el['status'] == 3;
                                                                        });
                                                                        $gm = end($filter_gm)
                                                                    @endphp
                                                                    Workshop General Manager <br>
                                                                    Date :
                                                                    @if($request->status >= 3)
                                                                    {{ date('d F Y', strtotime($gm['created_at'])) }}
                                                                    <br>
                                                                    @if($gm['user']['signature'] != null)
                                                                      <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="80" style="margin-top: -10px; margin-bottom:-10px">
                                                                    @endif
                                                                    <br>
                                                                    ({{ $gm['user']['name'] }})
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
                                            @php
                                                $filter_gmqsa = array_filter($request->RequestHistory->toArray(), function($el) {
                                                    return $el['status'] == 5;
                                                });
                                                $gmqsa = end($filter_gmqsa)
                                            @endphp
                                            Riviewed & Disposed by Lead Auditor <br>
                                            @if($request->status >= 5)
                                            @if($gmqsa['user']['signature'] != null)
                                            <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="80" style="margin-bottom : -10px; margin-top: -10px;">
                                            @endif
                                            <br>
                                            ({{ $gmqsa['user']['name'] }})
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
                                                    <td style="width:20px"><input type="checkbox" @if($request->status == 5) checked @endif></td>
                                                    <td>Aproved</td>
                                                    <td style="width:20px"></td>
                                                    <td style="width:20px"><input type="checkbox" @if($request->status == 6 || $request->status == 8) checked @endif ></td>
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
        <table class="fullwidth">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                </td>
            </tr>
        </table>
        <table class="fullwidth firstPage">
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
                                            P/N to
                                            <span @if($request->request_type == 'Delete') style="text-decoration: line-through" @endif> Add </span> /
                                            <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span>
                                            (*)
                                            {{  str_replace('|',';', $request->ComponentRequest->part_number) }}
                                              @if($request->ComponentRequest->part_number_new != null), {{ str_replace('|',', ', $request->ComponentRequest->part_number_new) }} @endif
                                            <br>
                                            <strong>(*) Cross as required</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Compnonent Name
                                                    </td>
                                                    <td>
                                                        : {{ strtoupper($request->ComponentRequest->component_name) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Vendor of Manufacture Code
                                                    </td>
                                                    <td>
                                                        : {{ strtoupper($request->ComponentRequest->vendor_manufacturer) }}
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width:100%">
                                                <tr>
                                                    <td valign="top"style="width:47.5%">
                                                      <table>
                                                        <tr>
                                                          <td valign="top" style="width:32%">Aircraft Type :</td>
                                                          <td style="text-align:justify">
                                                            <p style="margin-right:10px;">
                                                              {{ str_replace('|',', ',$request->ComponentRequest->aircraft_type) }}
                                                            </p>
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                    <td valign="top"style="width:25%;"> ATA Chapter : {{ $request->ComponentRequest->ata_chapter }} </td>
                                                    <td valign="top"style="width:27.5%"> Workshop : {{ strtoupper($request->ComponentRequest->workshop) }} </td>
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

                                                            $loop = count(json_decode($request->ComponentRequest->for_rating, true)) - (count(json_decode($request->ComponentRequest->for_rating, true))/6) ;
                                                            $rating = json_decode($request->ComponentRequest->for_rating, true) ;
                                                            @endphp
                                                            @for($i = 0; $i < $test; $i++ )
                                                            @if(!empty($rating[$i]))
                                                                @if($rating[$i."_name"] == 'EASA RATING')
                                                                <tr>
                                                                    <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                    <td style="width:20px"> {{ $rating[$i."_name"] }} </td>
                                                                    <td style="width:20px"> : {{ $rating[$i] }} </td>
                                                                </tr>
                                                                @endif
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
                                                                  @php
                                                                      $filter_gm = array_filter($request->RequestHistory->toArray(), function($el) {
                                                                          return $el['status'] == 3;
                                                                      });
                                                                      $gm = end($filter_gm)
                                                                  @endphp
                                                                  Workshop General Manager <br>
                                                                  Date :
                                                                  @if($request->status >= 3)
                                                                  {{ date('d F Y', strtotime($gm['created_at'])) }}
                                                                  <br>
                                                                  @if($gm['user']['signature'] != null)
                                                                    <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="90" style="margin-top: -10px;margin-bottom: -10px">
                                                                  @endif
                                                                  <br>
                                                                  ({{ $gm['user']['name'] }})
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
                                            @php
                                                $filter_gmqsa = array_filter($request->RequestHistory->toArray(), function($el) {
                                                    return $el['status'] == 5;
                                                });
                                                $gmqsa = end($filter_gmqsa)
                                            @endphp
                                            Riviewed & Disposed by Lead Auditor <br>
                                            @if($request->status >= 5)
                                            @if($gmqsa['user']['signature'] != null)
                                            <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-top: -5px;">
                                            @endif
                                            <br>
                                            ({{ $gmqsa['user']['name'] }})
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
                                                    <td style="width:20px"><input type="checkbox" @if($request->status == 5) checked @endif></td>
                                                    <td>Aproved</td>
                                                    <td style="width:20px"></td>
                                                    <td style="width:20px"><input type="checkbox" @if($request->status == 6 || $request->status == 8) checked @endif ></td>
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

  </body>
</html>

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

.firstPage{
   font-size: 11pt !important ;
}
</style>
