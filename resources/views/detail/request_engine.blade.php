<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Detail Engine Request {{ $request->request_number }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">

    </head>
    <body>

        <?php
         $doc_required = explode('|', $request->EngineShopAbility->document_requirement) ;
         $te_partnumber = explode('|', $request->EngineShopAbility->test_equipment_part_number) ;
         $te_partname = explode('|', $request->EngineShopAbility->test_equipment_part_name) ;
         $st_partnumber = explode('|', $request->EngineShopAbility->special_tool_part_number) ;
         $st_partname = explode('|', $request->EngineShopAbility->special_tool_part_name) ;
         $remark = explode('|', $request->EngineShopAbility->remark) ;

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

         $som = json_decode($request->EngineShopAbility->summary_of_maintenance, true) ;
         $rating = json_decode($request->EngineRequest->for_rating, true) ;
       ?>
        @if($type == 'potrait')
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                $size = 7;
                $font = $fontMetrics->getFont("Myriad");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text(20, $y, "Form No. :  GMF/Q-230 R6." , $font, $size );
            }
        </script>
               <table style="width:100%" >
                   <tr>
                       <td class="text-center">
                           <img src="{{ public_path('images/gmf.png') }}" width="200">
                       </td>
                   </tr>
                </table>
                <table class="firstPage fullwidth">
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
                                                   <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span> (*) :
                                                   @if( count(explode('|',$request->EngineRequest->part_number)) > 4 )
                                                        SEE LIST NO : PN/{{ $request->EngineShopAbility->number_ability }}
                                                   @else
                                                        {{ str_replace("|",", ",$request->EngineRequest->part_number)  }}
                                                   @endif
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
                                                               <span style="text-decoration: line-through">Compnonent</span> / Engine (*) Name
                                                               <br>
                                                               <br>
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($request->EngineRequest->engine_name) }}
                                                               <br>
                                                               <br>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                               Vendor of Manufacture Code
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($request->EngineRequest->vendor_manufacturer) }}
                                                           </td>
                                                       </tr>
                                                   </table>
                                                   <br>
                                                   <table style="width:100%">
                                                       <tr>
                                                           <td valign="top" style="width:47.5%"  >
                                                             <table>
                                                               <tr>
                                                                 <td valign="top" style="width:32%">Aircraft Type :</td>
                                                                 <td style="text-align:justify">
                                                                   <p style="margin-right:10px;">
                                                                     {{ strtoupper(str_replace("|",",", $request->EngineRequest->aircraft_type)) }}</td>
                                                                   </p>
                                                                 </td>
                                                               </tr>
                                                             </table>
                                                           <td valign="top" style="width:25%">ATA Chapter : {{ strtoupper($request->EngineRequest->ata_chapter) }} </td>
                                                           <td valign="top" style="width:27.5%">Workshop : {{ strtoupper($request->EngineRequest->workshop) }} </td>
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
                                                                     $rating = json_decode($request->EngineRequest->for_rating, true) ;
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
                                                       <span @if($request->EngineShopAbility->ability_inspection != 1) style="text-decoration: line-through" @endif>Inspection</span> /
                                                       <span @if($request->EngineShopAbility->ability_testing  != 1) style="text-decoration: line-through" @endif> Testing</span>  /
                                                       <span @if($request->EngineShopAbility->ability_repair  != 1) style="text-decoration: line-through" @endif>Repair</span> /
                                                       <span @if($request->EngineShopAbility->ability_modification  != 1) style="text-decoration: line-through" @endif>Modification</span> /
                                                       <span @if($request->EngineShopAbility->ability_overhauled  != 1) style="text-decoration: line-through" @endif>Overhauled</span> (*) <br>
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
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->facilities == 1) checked @endif> </td>
                                                           <td>Qualified Personel</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->qualified_personel == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Tool</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->special_tools == 1) checked @endif> </td>
                                                           <td>Approved Data</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->approved_data == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Equipment/Test Equipment</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->special_equipment == 1) checked @endif> </td>
                                                           <td>Appropriate Rating</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->appropriate_rating == 1) checked @endif> </td>
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
                                                                 @if($gm['user']['signature'] != null)
                                                                 <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -10px;">
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
                                                   <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -5px;">
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
                   <table style="width:100%">
                   <tr>
                       <td class="text-center">
                           <img src="{{ public_path('images/gmf.png') }}" width="200">
                       </td>
                   </tr>
                  </table>
                  <table class="firstPage fullwidth">
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
                                                 <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span> (*) :
                                                 @if( count(explode('|',$request->EngineRequest->part_number)) > 4 )
                                                      SEE LIST NO : PN/{{ $request->EngineShopAbility->number_ability }}
                                                 @else
                                                      {{ str_replace("|",", ",$request->EngineRequest->part_number)  }}
                                                 @endif
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
                                                               <span style="text-decoration: line-through">Compnonent</span> / Engine (*) Name
                                                               <br>
                                                               <br>
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($request->EngineRequest->engine_name) }}
                                                               <br>
                                                               <br>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                               Vendor of Manufacture Code
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($request->EngineRequest->vendor_manufacturer) }}
                                                           </td>
                                                       </tr>
                                                   </table>
                                                   <br>
                                                   <table style="width:100%">
                                                     <tr>
                                                         <td valign="top" style="width:47.5%"  >
                                                           <table>
                                                             <tr>
                                                               <td valign="top" style="width:32%">Aircraft Type :</td>
                                                               <td style="text-align:justify">
                                                                 <p style="margin-right:10px;">
                                                                   {{ strtoupper(str_replace("|",",", $request->EngineRequest->aircraft_type)) }}</td>
                                                                 </p>
                                                               </td>
                                                             </tr>
                                                           </table>
                                                         <td valign="top" style="width:25%">ATA Chapter : {{ strtoupper($request->EngineRequest->ata_chapter) }} </td>
                                                         <td valign="top" style="width:27.5%">Workshop : {{ strtoupper($request->EngineRequest->workshop) }} </td>
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
                                                                       $loop = count(json_decode($request->EngineRequest->for_rating, true)) - (count(json_decode($request->EngineRequest->for_rating, true))/3 + count(json_decode($request->EngineRequest->for_rating, true))/3) ;
                                                                       $rating = json_decode($request->EngineRequest->for_rating, true) ;
                                                                   @endphp
                                                                   @for($i = 0; $i < $test; $i++ )
                                                                   @if(!empty($rating[$i]))
                                                                        @if($rating[$i.'_name'] == 'EASA RATING')
                                                                       <tr>
                                                                           <td style="width:20px"> <input type="checkbox" Checked> </td>
                                                                           <td style="width:20px"> {{ $rating[$i.'_name'] }} </td>
                                                                           <td style="width:20px"> : {{ strtoupper($rating[$i]) }} </td>
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
                                                       <span @if($request->EngineShopAbility->ability_inspection != 1) style="text-decoration: line-through" @endif>Inspection</span> /
                                                       <span @if($request->EngineShopAbility->ability_testing  != 1) style="text-decoration: line-through" @endif> Testing</span>  /
                                                       <span @if($request->EngineShopAbility->ability_repair  != 1) style="text-decoration: line-through" @endif>Repair</span> /
                                                       <span @if($request->EngineShopAbility->ability_modification  != 1) style="text-decoration: line-through" @endif>Modification</span> /
                                                       <span @if($request->EngineShopAbility->ability_overhauled  != 1) style="text-decoration: line-through" @endif>Overhauled</span> (*) <br>
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
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->facilities == 1) checked @endif> </td>
                                                           <td>Qualified Personel</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->qualified_personel == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Tool</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->special_tools == 1) checked @endif> </td>
                                                           <td>Approved Data</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->approved_data == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Equipment/Test Equipment</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->special_equipment == 1) checked @endif> </td>
                                                           <td>Appropriate Rating</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->EngineRequest->appropriate_rating == 1) checked @endif> </td>
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
                                                                 @if($gm['user']['signature'] != null)
                                                                 <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -10px;">
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
                                                   <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -5px;">
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
                $pdf->page_text(20, $y, "Form No. :  GMF/Q-299 R4" , $font, $size );
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
                <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->EngineShopAbility->shop_maintenance}}</td>
                <td colspan="3" style="width:33.3%" class="text-center">SHOP ABILITY</td>
                <td style="width:33.3%">  2. No. : {{ $request->EngineShopAbility->number_ability}}</td>
              </tr>
              <tr>
                <td colspan="6">
                  3. SUMMARY OF MAINTENANCE RESOURCES : <br>
                  <table style="width:100%">
                    <tr>
                      <td>OWNER CODE</td>
                      <td>: @if(!empty($som['OWNER CODE']))  {{ strtoupper($som['OWNER CODE']) }} @endif</td>
                      <td valign="top">AIRCRAFT TYPE </td>
                      <td>: {{ str_replace("|",", ", $request->EngineRequest->aircraft_type) }}</td>
                      <td>TBO </td>
                      <td>: @if(!empty($som['TBO']))  {{ strtoupper($som['TBO']) }} @endif</td>
                    </tr>
                    <tr>
                      <td>NOMENCLATURE</td>
                      <td>: @if(!empty($som['NOMENCLATURE']))  {{ strtoupper($som['NOMENCLATURE']) }} @endif</td>
                      <td>ATA CHAPTER </td>
                      <td>: {{ $request->EngineRequest->ata_chapter }}</td>
                      <td>CHECK PERIOD </td>
                      <td>: @if(!empty($som['CHECK PERIOD']))  {{ strtoupper($som['CHECK PERIOD']) }} @endif</td>
                    </tr>
                    <tr>
                      <td>PART NUMBER</td>
                      <td>:
                        @if( count(explode('|',$request->EngineRequest->part_number)) > 4 )
                        SEE LIST NO : PN/{{ $request->EngineShopAbility->number_ability }}
                        @else
                        {{ str_replace("|",",",$request->EngineRequest->part_number)  }}
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
                      <td>: {{ strtoupper($request->EngineRequest->vendor_manufacturer) }}</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table class="table table-sm table-bordered" style="margin-top: -2px; margin-bottom:0px;">
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
              @php
              $no = 1 ;
              $filterDocument = array_values(array_filter($request->EngineDocument->toArray(), function($el) {
                  return $el['document_type'] == 'Maintenance Manual';
              }));

              $tot_doc = count($filterDocument) ;

              $tot_te = count($request->EngineTestEquipment) ;
              $tot_st = count($request->EngineSpecialTools) ;

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
                <td class="text-center" style="border-bottom : 1px solid white ;">
                  @if(!empty($filterDocument[$i]['no_document'] ))
                  Doc No. {{ $filterDocument[$i]['no_document'] }}<br>
                  Rev. {{ $filterDocument[$i]['rev'] }} , Rev Date {{ $filterDocument[$i]['rev_date'] }}
                  @endif
                </td>
                <td class="text-center" style="border-bottom : 1px solid white ;">
                  @if($tot_te == 0 && $i == 0)
                    N/A
                  @elseif($tot_te > 5 && $i == 0)
                    See List
                  @elseif($tot_te <= 5)
                    @if(!empty($request->EngineTestEquipment[$i]))
                    {{ $request->EngineTestEquipment[$i]->part_number }}
                    @endif
                  @endif

                </td>
                <td class="text-center" style="border-bottom : 1px solid white ;">
                    @if($tot_te == 0 && $i == 0)
                      N/A
                    @elseif($tot_te > 5 && $i == 0)
                      See List
                    @elseif($tot_te <= 5)
                      @if(!empty($request->EngineTestEquipment[$i]))
                      {{ $request->EngineTestEquipment[$i]->part_name }}
                      @endif
                    @endif

                </td>
                <td class="text-center" style="border-bottom : 1px solid white ;">
                  @if($tot_st == 0 && $i == 0)
                    N/A
                  @elseif($tot_st > 5 && $i == 0)
                    See List
                  @elseif($tot_st <= 5)
                    @if(!empty($request->EngineSpecialTools[$i]))
                    {{ $request->EngineSpecialTools[$i]->part_number }}
                    @endif
                  @endif

                </td>
                <td class="text-center" style="border-bottom : 1px solid white ;">
                  @if($tot_st == 0 && $i == 0)
                    N/A
                  @elseif($tot_st > 5 && $i == 0)
                    See List
                  @elseif($tot_st <= 5)
                    @if(!empty($request->EngineSpecialTools[$i]))
                    {{ $request->EngineSpecialTools[$i]->part_name }}
                    @endif
                  @endif

                </td>
                <td class="text-center" style="border-bottom : 1px solid white ;" >
                  @if($tot_st == 0 && $i == 0)
                    N/A
                  @elseif($tot_st > 5 && $i == 0)
                    See List
                  @elseif($tot_st <= 5)
                    @if(!empty($request->EngineSpecialTools[$i]))
                    {{ $request->EngineSpecialTools[$i]->remark }}
                    @endif
                  @endif

                </td>
              </tr>
              @endFor
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
            </table>

            <div class="page_break"></div>
            <table style="width:100%">
                <tr>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->EngineShopAbility->shop_maintenance}}</td>
                                <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                                <td style="width:33.3%">  2. No. : {{ $request->EngineShopAbility->number_ability}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">8. AVAILBILE MANUFACTURERS DOCUMENTATION DRAWING :{{ strtoupper($request->EngineShopAbility->manufacture_documentation_drawing) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                  <table>
                                    <tr>
                                      <td valign="top">9. AVAILBILE INSPECTION SCHEMA, TEST INTRUCTION, CHECK LIST ETC :  </td>
                                      <td>
                                        <pre>{{ $request->EngineShopAbility->inspection }}
                                        </pre>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">10. AVAILBILE TOOLS/EQUIPMENT : {{ strtoupper($request->EngineShopAbility->tool_equipment) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">11. SPECIAL WORK TO BE ORDER OUTSIDE : {{ strtoupper($request->EngineShopAbility->special_work) }} </td>
                            </tr>
                            <tr>
                                <td colspan="3">12. PARTICULARS : {{ strtoupper($request->EngineShopAbility->particular)    }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">13. AVAILBILE QUALIFIED PERSONNEL :
                                  <?php
                                  $cek_personel = count($request->EnginePersonel) ;
                                   ?>
                                   @if($cek_personel <= 3)
                                     @foreach($request->EnginePersonel as $per)
                                        {{ $per->name }} {{ $per->id_number }} {{ $per->unit }},
                                     @endForeach
                                   @else
                                      See Personnel table list
                                   @endif
                                    <!-- {{ strtoupper($request->EngineShopAbility->available_qualified) }} -->

                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    14.   ABILITY
                                    <table style="width:100%">
                                        <td class="text-center">
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_inspection == 1) checked @endif > YES <br>
                                            INSPECTION : <br>
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_inspection == 0 ) checked @endif > NO
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_testing == 1) checked @endif> YES <br>
                                            TESTING : <br>
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_testing == 0) checked @endif> NO
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_repair == 1) checked @endif> YES <br>
                                            REPAIR : <br>
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_repair == 0) checked @endif> NO
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_modification == 1) checked @endif> YES <br>
                                            MODIFICATION : <br>
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_modification == 0) checked @endif> NO
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_overhauled == 1) checked @endif > YES <br>
                                            OVERHAULED : <br>
                                            <input type="checkbox" @if($request->EngineShopAbility->ability_overhauled == 0) checked @endif> NO
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
                    <td colspan="2" style="width:33.3%">1. SHOP MAINTENANCE : {{ $request->EngineShopAbility->shop_maintenance}}</td>
                    <td style="width:33.3%" class="text-center">SHOP ABILITY</td>
                    <td colspan="2" style="width:33.3%">  2. No. : {{ $request->EngineShopAbility->number_ability}}</td>
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
                @if(count($request->EngineConsumableMaterial) == 0)
                <tr>
                    <td class="text-center" style="width:5% ; border-bottom : 1px solid white ;">N/A</td>
                    <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                    <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                    <td class="text-center" style="width:5% ;border-bottom : 1px solid white ;">N/A</td>
                    <td class="text-center" style="border-bottom : 1px solid white ;">N/A</td>
                </tr>
                @endif
                @foreach($request->EngineConsumableMaterial as $cm )
                <tr>
                    <td style="width:5% ; border-bottom : 1px solid white ;">{{ $no++ }}</td>
                    <td style="border-bottom : 1px solid white ;">{{ $cm->part_number }}</td>
                    <td style="border-bottom : 1px solid white ;">{{ $cm->description_material }}</td>
                    <td style="width:5% ;border-bottom : 1px solid white ;">{{ $cm->qty }}</td>
                    <td style="border-bottom : 1px solid white ;">{{ $cm->remark }}</td>
                </tr>
                @endForeach
                <tr>
                    <td
                    @if($no <= 1)
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
                                     <img src="uploads/users/signature/{{ $user['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -10px;">
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
                                     <img src="uploads/users/signature/{{ $manager['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -10px;">
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

            @if( count(explode('|',$request->EngineRequest->part_number)) > 4 )
                 SEE LIST NO : PN/{{ $request->EngineShopAbility->number_ability }}
                 <div class="page_break"></div>
                 <table style="width:100%">
                     <tr>
                         <td class="text-center">
                             <img src="{{ public_path('images/gmf.png') }}" width="200">
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <table class="table table-bordered text-center">
                                 <tr>
                                     <th>NO OF SHOP ABILITY</th>
                                     <th>PART NAME</th>
                                     <th>PART NUMBER</th>
                                 </tr>
                                 <tr>
                                     <td valign="middle">
                                         {{ $request->EngineShopAbility->shop_maintenance }}
                                     </td>
                                     <td valign="middle">
                                        PN/{{ $request->EngineShopAbility->number_ability }}
                                     </td>
                                     <td valign="middle">
                                        {{ str_replace('|','  ',$request->EngineRequest->part_number)  }}
                                     </td>
                                 </tr>
                             </table>
                         </td>
                     </tr>
            @endif
        </table>
        @endif
        <!-- end lanscape -->

        @if($type == 'potrait2')
        <!-- <div class="page_break"></div> -->
        <?php
            $cek_personel = count($request->EnginePersonel) ;
         ?>
        @if($cek_personel > 3)
            <table style="width:100%">
              <tr>
                <td class="text-center">
                  <img src="{{ public_path('images/gmf.png') }}" width="200">
                  <br>
                  <strong>{{ strtoupper($request->EngineRequest->engine_name) }} PERSONEL</strong>
                </td>
              </tr>
            </table>
            <table class="table table-bordered">
              <tr>
                <th>NO</th>
                <th>NAME</th>
                <th>ID NUMBER</th>
                <th>Nominate</th>
                <th>FUNCTION </th>
                <th>AUTHORIZED NO OR STAMP HOLDER</th>
                <th>UNIT</th>
                <th>SCOPE COMPETENCY</th>
              </tr>
              @php $no = 1 @endphp
              @if(count($request->EnginePersonel) == 0)
              <tr>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
              </tr>
              @endif
              @foreach($request->EnginePersonel as $ep)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $ep->name }}</td>
                <td>{{ $ep->id_number }}</td>
                <td>{{ $ep->nominate }}</td>
                <td>{{ $ep->function }}</td>
                <td>{{ $ep->auth_no_stamp_holder }}</td>
                <td>{{ $ep->unit }}</td>
                <td>{{ $ep->scope_competency }}</td>
              </tr>
              @endForeach
            </table>

            <div class="page_break"></div>
            @endif
            @if(count($request->EngineTestEquipment) > 5)
              <table style="width:100%">
                <tr>
                  <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>LIST OF TEST EQUIPMENT</strong>
                  </td>
                </tr>
              </table>
              <table class="table table-bordered">
                <tr>
                  <th>NO</th>
                  <th>Part Name</th>
                  <th>Part Number</th>
                </tr>
                @php $no = 1 @endphp
                @if(count($request->EngineTestEquipment) == 0)
                  <tr>
                    <td class="text-center" style="width:20px">N/A</td>
                    <td class="text-center" >N/A</td>
                    <td class="text-center" >N/A</td>
                  </tr>
                @endif
                @foreach($request->EngineTestEquipment as $et)
                <tr>
                  <td style="width:20px">{{ $no++ }}</td>
                  <td>{{ $et->part_name }}</td>
                  <td>{{ $et->part_number }}</td>
                </tr>
                @endForeach
              </table>
              <div class="page_break"></div>
            @endif
            @if(count($request->EngineSpecialTools) > 5)
            <table style="width:100%">
              <tr>
                <td class="text-center">
                  <img src="{{ public_path('images/gmf.png') }}" width="200">
                  <br>
                  <strong>LIST OF SPECIAL TOOLS</strong>
                </td>
              </tr>
            </table>
            <table class="table table-bordered">
              <tr>
                <th>NO</th>
                <th>Part Name</th>
                <th>Part Number</th>
                <th>Remark</th>
              </tr>
              @php $no = 1 @endphp
              @if(count($request->EngineSpecialTools) == 0)
                <tr>
                  <td class="text-center" style="width:20px">N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                </tr>
              @endif
              @foreach($request->EngineSpecialTools as $st)
              <tr>
                <td style="width:20px">{{ $no++ }}</td>
                <td>{{ $st->part_name }}</td>
                <td>{{ $st->part_number }}</td>
                <td>{{ $st->remark }}</td>
              </tr>
              @endForeach
            </table>
            <div class="page_break"></div>
            @endif
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>LIST OF TASKLIST NUMBER</strong>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th>NO</th>
                <th>NO GROUP</th>
                <th>DESCRIPTION</th>
                <th>REMARK </th>
            </tr>
            @php $no = 1 @endphp
            @if(count($request->EngineTasklistNumber) == 0)
              <tr>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
              </tr>
            @endif
            @foreach($request->EngineTasklistNumber as $et)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $et->no_group }}</td>
                <td>{{ $et->description_tasklist }}</td>
                <td>{{ $et->remark_tasklist }}</td>
            </tr>
            @endForeach
        </table>

        <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>VENDOR LIST</strong>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th>ATA </th>
                <th>PART NAME</th>
                <th>VENDOR</th>
                <th>REMARK </th>
            </tr>
            @if(count($request->EngineVendorList) == 0)
            <tr>
              <td class="text-center" >N/A</td>
              <td class="text-center" >N/A</td>
              <td class="text-center" >N/A</td>
              <td class="text-center" >N/A</td>
            </tr>
            @endif
            @foreach($request->EngineVendorList as $ev)
            <tr>
                <td>{{ $ev->ata}}</td>
                <td>{{ $ev->part_name}}</td>
                <td>{{ $ev->vendor }}</td>
                <td>{{ $ev->remark_vendorlist}}</td>
            </tr>
            @endForeach
        </table>

        <!-- <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>LIST OF CONSUMABLE MATERIAL</strong>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th>CODE NO </th>
                <th>DESCRIPTION</th>
            </tr>
            @foreach($request->EngineConsumableMaterial as $ec)
            <tr>
                <td>{{ $ec->code_number }}</td>
                <td>{{ $ec->description_material }}</td>
            </tr>
            @endForeach
        </table> -->

        <!-- <div class="page_break"></div>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                    <br>
                    <strong>GMF FINAL LIST TOOLS</strong>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
                        <tr>
                            <th>NO </th>
                            <th>SPECIAL TOOL</th>
                            <th>BASE PN</th>
                            <th>TOOL DESCRIPTION</th>
                            <th>TASK </th>
                            <th>EST ARRIVAL AT GMF </th>
                        </tr>
                        @php $no = 1 @endphp
                        @foreach($request->EngineTool as $et)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $et->special_tool }}</td>
                            <td>{{ $et->base_pn }}</td>
                            <td>{{ $et->tool_desciption }}</td>
                            <td>{{ $et->task }}</td>
                            <td>{{ $et->est_arrival }}</td>
                        </tr>
                        @endForeach
                    </table> -->
<!--
            @if($request->EngineRequest->attachment != null)
            <div class="page_break"></div>
            <h1>Link of Attachment Document</h1>
            @php $attacment = explode('|',$request->EngineRequest->attachment);  @endphp
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name of Document</th>
                        <th>link Download </th>
                    </tr>
                    @forEach($attacment as $at)
                    <tr>
                        <td>{{ $at }}</td>
                        <td>{{ asset('uploads/engine/attachment/'.$at) }}</td>
                    </tr>
                    @endForeach
                </thead>
            </table>

            @endif -->
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

    .firstPage{
       font-size: 11pt !important ;
    }
</style>
