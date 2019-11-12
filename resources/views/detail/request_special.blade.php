<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Detail Special Request {{ $request->request_number }}</title>
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
        .firstPage{
          width: 100% ;
          font-size: 10pt !important;
        }
        </style>
    </head>
    <body>

        <?php
         $ar_carry_out  =  json_decode($request->SpecialRequest->aproval_request_carry_out, true) ;
         $special_facility = json_decode($request->SpecialShopAbility->special_facility) ;
         $ability = json_decode($request->SpecialShopAbility->ability) ;

         $som = json_decode($request->SpecialShopAbility->summary_of_maintenance, true) ;
         $rating = json_decode($request->SpecialRequest->for_rating, true) ;
         $manual = json_decode($request->SpecialRequest->manual_revision, true) ;
       ?>
       @if($type == 'potrait')
               <script type="text/php">
                   if (isset($pdf)) {
                       $text = "";
                       $size = 7;
                       $font = $fontMetrics->getFont("Myriad");
                       $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                       $x = ($pdf->get_width() - $width);
                       $y = $pdf->get_height() - 35;
                       $pdf->page_text($x, $y, $text, $font, $size );
                       $pdf->page_text(35, $y, "Form No.: GMF/Q-230 R6" , $font, $size );
                   }
               </script>
               <table class="firstPage">
                   <tr>
                       <td class="text-center">
                           <img src="{{ public_path('images/gmf.png') }}" width="200">
                       </td>
                   </tr>
               </table>
               <table class="firstPage">
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
                                                   P/N to   <span @if($request->request_type == 'Delete') style="text-decoration: line-through" @endif> Add </span> /
                                                            <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span>
                                                      (*) : {{ str_replace('|',', ',$request->SpecialRequest->part_number ) }}<br>
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
                                                               : {{ strtoupper($request->SpecialRequest->engine_name) }}
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                               Vendor of Manufacture Code
                                                           </td>
                                                           <td>
                                                               : {{ strtoupper($request->SpecialRequest->vendor_manufacturer) }}
                                                           </td>
                                                       </tr>
                                                   </table>
                                                   <table style="width:100%">
                                                       <tr>
                                                           <td valign="top" style="width:47.5%"  >
                                                             <table>
                                                               <tr>
                                                                 <td valign="top" style="width:32%">Aircraft Type :</td>
                                                                 <td style="text-align:justify">
                                                                   <p style="margin-right:10px;">
                                                                     {{ strtoupper(str_replace('|',',', $request->SpecialRequest->aircraft_type)) }}</td>
                                                                   </p>
                                                                 </td>
                                                               </tr>
                                                             </table>
                                                           <td valign="top" style="width:25%">ATA Chapter : {{ strtoupper($request->SpecialRequest->ata_chapter)}} </td>
                                                           <td valign="top" style="width:27.5%">Workshop : {{ strtoupper($request->SpecialRequest->workshop) }} </td>
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
                                                                       $i = 0 ;
                                                                       $rating = json_decode($request->SpecialRequest->for_rating, true) ;
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
                                                   <br>
                                                   I certify that my department has the capability to maintain the above mentioned items, according to the AMO Manual 1.9.3 requirements :
                                                   <br>
                                                   <br>
                                                   <table style="width: 80%">
                                                       <tr>
                                                           <td>Facilities</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->facilities == 1) checked @endif> </td>
                                                           <td>Qualified Personel</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->qualified_personel == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Tool</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->special_tools == 1) checked @endif> </td>
                                                           <td>Approved Data</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->approved_data == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Special Equipment/Test Equipment</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->special_equipment == 1) checked @endif> </td>
                                                           <td>Appropriate Rating</td>
                                                           <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->appropriate_rating == 1) checked @endif> </td>
                                                       </tr>
                                                       <tr>
                                                           <table>
                                                               <tr>
                                                                   <td class="text-center">
                                                                       <br>
                                                                       <br>
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
                                                                       <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="100" style="margin-bottom : -50px; margin-top: -30px;">
                                                                       @endif
                                                                       <br>
                                                                       ({{ $gm['user']['name'] }})
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
                                                   @php
                                                       $filter_gmqsa = array_filter($request->RequestHistory->toArray(), function($el) {
                                                           return $el['status'] == 5;
                                                       });
                                                       $gmqsa = end($filter_gmqsa)
                                                   @endphp
                                                   Riviewed & Disposed by Lead Auditor <br>
                                                   @if($request->status >= 5)
                                                   @if($gmqsa['user']['signature'] != null)
                                                   <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-bottom : -30px; margin-top: -5px;">
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
                   <table class="firstPage">
                       <tr>
                           <td class="text-center">
                               <img src="{{ public_path('images/gmf.png') }}" width="200">
                           </td>
                       </tr>
                   </table>
                   <table class="firstPage">
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
                                                     P/N to   <span @if($request->request_type == 'Delete') style="text-decoration: line-through" @endif> Add </span> /
                                                              <span @if($request->request_type != 'Delete') style="text-decoration: line-through" @endif> Delete </span>
                                                        (*) : {{ str_replace('|',', ',$request->SpecialRequest->part_number ) }}<br>
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
                                                                   : {{ strtoupper($request->SpecialRequest->engine_name) }}
                                                               </td>
                                                           </tr>
                                                           <tr>
                                                               <td>
                                                                   Vendor of Manufacture Code
                                                               </td>
                                                               <td>
                                                                   : {{ strtoupper($request->SpecialRequest->vendor_manufacturer) }}
                                                               </td>
                                                           </tr>
                                                       </table>
                                                       <table style="width:100%">
                                                           <tr>
                                                               <td valign="top" style="width:47.5%"  >
                                                                 <table>
                                                                   <tr>
                                                                     <td valign="top" style="width:32%">Aircraft Type :</td>
                                                                     <td style="text-align:justify">
                                                                       <p style="margin-right:10px;">
                                                                         {{ strtoupper(str_replace('|',',', $request->SpecialRequest->aircraft_type)) }}</td>
                                                                       </p>
                                                                     </td>
                                                                   </tr>
                                                                 </table>
                                                               </td>
                                                               <td valign="top" style="width:25%">ATA Chapter : {{ strtoupper($request->SpecialRequest->ata_chapter) }} </td>
                                                               <td valign="top" style="width:27.5%">Workshop : {{ strtoupper($request->SpecialRequest->workshop) }} </td>
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
                                                                     $loop = count(json_decode($request->SpecialRequest->for_rating, true)) - (count(json_decode($request->SpecialRequest->for_rating, true))/6) ;
                                                                     $rating = json_decode($request->SpecialRequest->for_rating, true) ;
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
                                                       <br>
                                                       <strong>WORKSHOP GENERAL MANAGER STATEMENT</strong>
                                                       <br>
                                                       <br>
                                                       I certify that my department has the capability to maintain the above mentioned items, according to the AMO Manual 1.9.3 requirements :
                                                       <br>
                                                       <table style="width: 80%">
                                                           <tr>
                                                               <td>Facilities</td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->facilities == 1) checked @endif> </td>
                                                               <td>Qualified Personel</td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->qualified_personel == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <td>Special Tool</td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->special_tools == 1) checked @endif> </td>
                                                               <td>Approved Data</td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->approved_data == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <td>Special Equipment/Test Equipment </td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->special_equipment == 1) checked @endif> </td>
                                                               <td>Appropriate Rating</td>
                                                               <td style="width:30px"><input type="checkbox" @if($request->SpecialRequest->appropriate_rating == 1) checked @endif> </td>
                                                           </tr>
                                                           <tr>
                                                               <table>
                                                                   <tr>
                                                                       <td class="text-center">
                                                                           <br>
                                                                           <br>
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
                                                                           <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="100" style="margin-bottom : -50px; margin-top: -30px;">
                                                                           @endif
                                                                           <br>
                                                                           ({{ $gm['user']['name'] }})
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
                                                       @php
                                                           $filter_gmqsa = array_filter($request->RequestHistory->toArray(), function($el) {
                                                               return $el['status'] == 5;
                                                           });
                                                           $gmqsa = end($filter_gmqsa)
                                                       @endphp
                                                       Riviewed & Disposed by Lead Auditor <br>
                                                       @if($request->status >= 5)
                                                       @if($gmqsa['user']['signature'] != null)
                                                       <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-bottom : -30px; margin-top: -5px;">
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
                $text = "";
                $size = 7;
                $font = $fontMetrics->getFont("Myriad");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size );
                $pdf->page_text(35, $y, "Form No.: GMF/Q-234" , $font, $size );
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
        <table class="table table-bordered">
            <tr>
                <td style="width:75%">SHOP ABILITY for NDT</td>
                <td style="width:25%">No. : {{ strtoupper($request->SpecialShopAbility->shop_ability_number)}}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <br>
                    <table class="fullwidth">
                        <tr>
                            <td style="width: 200px; " valign="top"> 1. NDT METHOD </td>
                            <td>
                              <table>
                                @foreach(\App\NdtMethods::get() as $value)
                                <tr>
                                  <td style="width:20px;">
                                    <input type="checkbox" @if($request->SpecialShopAbility->ndt_method == $value->ndt_method ) checked @endif>
                                  </td>
                                  <td>
                                    {{ $value->ndt_method }}
                                  </td>
                                </tr>
                                @endForeach
                              </table>
                                <br>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>2. REFERENCES           </td>
                            <td>
                                {{ $request->SpecialShopAbility->reference }} <br>
                            </td>
                        </tr>
                    </table>
                    <br>
                </td>
            </tr>
        </table>

        3. EQUIPMENT & TOOL
        <table class="table table-bordered">
            <tr>
                <td colspan="3" class="text-center" style="width:50%">EQUIPMENT REQUIRED</td>
                <td colspan="3" class="text-center" style="width:50%">TOOL REQUIRED</td>
            </tr>
            <tr>
                <td class="text-center">NO</td>
                <td class="text-center">PART NUMBER</td>
                <td class="text-center">PART NAME</td>
                <td class="text-center">NO</td>
                <td class="text-center">PART NUMBER</td>
                <td class="text-center">PART NAME</td>
            </tr>
            @php
              $no = 1 ;
              $tot_te = count($request->SpecialTestEquipment) ;
              $tot_st = count($request->SpecialTools) ;

              if($tot_st >= $tot_te){
                $count = $tot_st ;
              }else{
                $count = $tot_te ;
              }
              $no_equipment = 1 ;
              $no_tools = 1 ;
            @endphp
            @if($count == 0)
            <tr>
              <td class="text-center" style="width: 10px ">N/A</td>
              <td class="text-center" style="width: 100px">N/A</td>
              <td class="text-center" style="width: 100px">N/A</td>
              <td class="text-center" style="width: 10px ">N/A</td>
              <td class="text-center" style="width: 100px">N/A</td>
              <td class="text-center" style="width: 100px">N/A</td>
            </tr>
            @endif
            @for($i = 0; $i < $count; $i++)
              <tr>
                <td class="text-center" style="width: 10px; ">
                    @if($no_equipment <= $tot_te ) {{ $no_equipment++ }} @endif
                </td>
                <td class="text-center" style="width: 100px">
                  @if(!empty($request->SpecialTestEquipment[$i]))
                      {{ $request->SpecialTestEquipment[$i]->part_number }}
                  @endif
                </td>
                <td class="text-center" style="width: 100px">
                  @if(!empty($request->SpecialTestEquipment[$i]))
                    {{ $request->SpecialTestEquipment[$i]->part_name }}
                  @endif
                </td>
                <td class="text-center" style="width: 10px">

                  @if($no_tools <= $tot_st ) {{ $no_tools++ }} @endif
                </td>
                <td class="text-center"  style="width:100px">
                  @if(!empty($request->SpecialTools[$i]))
                    {{ $request->SpecialTools[$i]->part_name }}
                  @endif
                </td>
                <td class="text-center" style="width:100px">
                  @if(!empty($request->SpecialTools[$i]))
                    {{ $request->SpecialTools[$i]->tool_name }}
                  @endif
                </td>

              </tr>
            @endFor
        </table>

        4. AVAILABLE QUALIFIED PERSONNEL
        <table class="table table-bordered" style="width:60%;">
            <thead>
              <tr>
                <td class="text-center" style="width: 20px;">NO</td>
                <td class="text-center" >NAME / NOPEG</td>
                <td class="text-center" style="width: 20px;">LEVEL</td>
              </tr>
            </thead>
            @php $no = 1 @endphp
            @if(count($request->SpecialPersonel ) == 0)
            <tr>
              <td class="text-center" style="min-height:200px; ">N/A</td>
              <td class="text-center">N/A</td>
              <td class="text-center" style="">N/A</td>
            </tr>
            @endif
            @foreach($request->SpecialPersonel as $sd )
            <tr>
              <td class="text-center" style="min-height:200px; ">{{ $no++ }}</td>
              <td  style="">{{ $sd->name }} / {{ $sd->id_number }}</td>
              <td class="text-center" style="">{{ $sd->level }}</td>
            </tr>
            @endforeach
        </table>


        5. MATERIAL
        <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
            <tr>
                <td style="width:5%">NO</td>
                <td>PART NAME</td>
                <td>PART NUMBER</td>
                <td>REMARKS</td>
            </tr>
            @php $no = 1 ;@endphp
            @if(count($request->SpecialMaterial) == 0)
            <tr>
                <td style="width:5%;">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
                <td class="text-center">N/A</td>
            </tr>
            @endif
            @foreach($request->SpecialMaterial as $cm )
            <tr>
                <td style="width:5% ; ">{{ $no++ }}</td>
                <td style="">{{ $cm->part_name }}</td>
                <td style="">{{ $cm->part_number }}</td>
                <td style="">{{ $cm->remark }}</td>
            </tr>
            @endForeach
        </table>
        <br>
        <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
            <tr>
                <td>
                    <table class="fullwidth">
                        <tr>
                            <td style="width:200px;">6. ABILITY</td>
                            <td >
                              <table class="fullwidth">
                                <tr>
                                  <td style="width:20px"> <input type="checkbox" name="" value="" @if(!empty($ability->on_wing))  @if($ability->on_wing == true) checked @endif @endif >  </td>
                                  <td>On Wing </td>
                                  <td style="width:20px"> <input type="checkbox" name="" value="" @if(!empty($ability->removed)) @if($ability->removed == true) checked @endif  @endif >  </td>
                                  <td>Removed </td>
                                </tr>
                              </table>
                            </td>
                        </tr>
                    </table>
                    <table class="fullwidth">
                        <tr>
                            <td colspan="3">7. SPECIAL FACILITY REQUIREMENT</td>
                        </tr>
                        <tr>
                            <td>
                              <table class="fullwidth">
                                <tr>
                                  <td style="width:40px;"></td>
                                  <td style="width:20px;"><input type="checkbox"  @if(!empty($special_facility->dark_room)) @if($special_facility->dark_room == true) checked @endif  @endif></td>
                                  <td>Dark Room</td>
                                  <td style="width:20px;"><input type="checkbox"  @if(!empty($special_facility->exposure_room)) @if($special_facility->exposure_room == true) checked @endif @endif></td>
                                  <td> Exposure Room</td>
                                  <td style="width:20px;"><input type="checkbox"  @if(!empty($special_facility->not_required)) @if($special_facility->not_required == true) checked @endif @endif></td>
                                  <td>Not Required</td>
                                </tr>
                              </table>
                          </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    @php
                        $manager = array_filter($request->RequestHistory->toArray(), function($el) {
                            return $el['status'] == 2;
                        });
                        $m = end($manager)
                    @endphp

                    <table style="width:40%;">
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">NDT Manager</td>
                        </tr>
                        <tr>
                            <td valign="top" >SIGNATURE <br>  </td>
                            <td valign="top">: <br> </td>
                            <td>
                                @if($request->status >= 2)
                                    @if($m['user']['signature'] != null)
                                        <img src="uploads/users/signature/{{ $m['user']['signature']  }}" height="100" style="margin-bottom : -10px; margin-top: -10px;">
                                    @endif
                                <br>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>NAME</td>
                            <td>:</td>
                            <td>
                                @if($request->status >= 3)
                                    ({{ $m['user']['name'] }})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>DATE</td>
                            <td>:</td>
                            <td>
                                @if($request->status >= 3)
                                    {{ date('d F Y', strtotime($m['created_at'])) }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- end lanscape -->
        @endif
    </body>
</html>
