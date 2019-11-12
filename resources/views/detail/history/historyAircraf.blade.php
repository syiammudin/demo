<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>View Detail Request</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">

    </head>
    <body>
        <?php
            $aircrafRequest = json_decode(json_encode($request['aircraft_request'])) ;
            $user = json_decode(json_encode($request['user'])) ;
            $aircraftDocument = json_decode(json_encode($request['aircraft_document'])) ;
            $aircraftMaterial = json_decode(json_encode($request['aircraft_material'])) ;
            $aircraftToolEquipment = json_decode(json_encode($request['aircraft_tool_equipment'])) ;
            $aircraftAuthPerosonel = json_decode(json_encode($request['aircraft_authorized_personel'])) ;
         ?>
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
                             <td class="text-center"><strong>MAINTENANCE CAPABILITY EVALUATION SHEET REQUEST</strong></td>
                         </tr>
                         <tr>
                             <td>
                                 <table class="fullwidth">
                                     <tr>
                                         <th style="width:20px">1. </th>
                                         <th colspan="2">AIRCRAFT DATA</th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td style="width:200px"> Aircraft Type </td>
                                         <td style="width:300px"> : {{ $aircrafRequest->aircraft_type }} </td>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td> Manufacturer </td>
                                         <td> : {{ $aircrafRequest->aircraft_manufacturer }} </td>
                                     </tr>
                                     <tr>
                                         <th>2. </th>
                                         <th colspan="2">Maintenance Area</th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td colspan="2">
                                             (Put Check (<input type="checkbox" disabled checked>) Sign to the Selected Box) <br>
                                             <table>
                                                 @foreach(\App\Hangar::get() as $hg)
                                                     <tr>
                                                         <td style="width: 20px"> <input type="checkbox" @if($aircrafRequest->maintenance_area_value == $hg->hangar_name) Checked @endif >  </td>
                                                         <td> {{ $hg->hangar_name }}</td>
                                                     </tr>
                                                 @endForeach
                                                 <tr>
                                                     <td style="width: 20px"> <input type="checkbox" @if($aircrafRequest->maintenance_area == 'line_maintenance') Checked @endif >  </td>
                                                     <td> Line Maintenance : @if($aircrafRequest->maintenance_area == 'line_maintenance')
                                                             {{ \App\MaintenanceArea::where('code', $aircrafRequest->maintenance_area_value)->first()->description }}
                                                             @endif
                                                         ({{ $aircrafRequest->maintenance_area_value }}) </td>
                                                 </tr>
                                                 <tr>
                                                     <td style="width: 20px"> <input type="checkbox" @if($aircrafRequest->maintenance_area == 'other_area') Checked @endif>  </td>
                                                     <td> Other : @if($aircrafRequest->maintenance_area == 'other_area')
                                                                     {{ $aircrafRequest->maintenance_area_value }}
                                                         @endif</td>
                                                 </tr>
                                             </table>

                                         </td>
                                     </tr>
                                     <tr>
                                         <th>3. </th>
                                         <th colspan="2">APPROVAL REQUEST</th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td colspan="2">
                                             Approval request to {{ $request['request_type'] }} capability to carry out: <br>
                                             Inspection up to
                                             {{ $aircrafRequest->ability }}
                                             including minor repair, minor alteration for Airbus {{ $aircrafRequest->aircraft_type }}
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>4. </th>
                                         <th colspan="2">MANAGER STATEMENT:</th>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td colspan="2">
                                             I certify that my department has capability to maintain the above mention items, according to
                                             AMO Manual 1.9.21 MOE 1.9.5/ RSQM 1.9.2 requirement and items with Check (<input type="checkbox" disabled checked>) sign below
                                             have been provided. <br>
                                             <table class="fullwidth">
                                                 <tr>
                                                     <td style="width:20px;"> <input type="checkbox" @if($aircrafRequest->facilities == 1) checked @endif > </td>
                                                     <td> Facilities </td>
                                                     <td style="width:20px;"> <input type="checkbox" @if($aircrafRequest->qualified_personel == 1) checked @endif> </td>
                                                     <td> Qualified Personnel </td>
                                                 </tr>
                                                 <tr>
                                                     <td> <input type="checkbox" @if($aircrafRequest->certifying_staff == 1) checked @endif> </td>
                                                     <td> Certifying Staff </td>
                                                     <td> <input type="checkbox" @if($aircrafRequest->special_tools == 1) checked @endif> </td>
                                                     <td>  Special Tools </td>
                                                 </tr>
                                                 <tr>
                                                     <td> <input type="checkbox" @if($aircrafRequest->approved_data == 1) checked @endif> </td>
                                                     <td>  Approved Data </td>
                                                     <td> <input type="checkbox" @if($aircrafRequest->consumable == 1) checked @endif> </td>
                                                     <td> Consumable </td>
                                                 </tr>

                                             </table>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td colspan="3">
                                             <table class="fullwidth">
                                                 <tr>
                                                     <td style="width:50%" class="text-center">
                                                         <br>
                                                         <strong>Manager</strong>  <br>
                                                         Capacity Planning & Performance Analysis
                                                         <br>
                                                             @if($user->signature != null)
                                                             <img src="uploads/users/signature/{{ $user->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                                             @endif
                                                         <br>
                                                         Name & Signature <br>
                                                         {{ $user->name }}
                                                     </td>
                                                     <td style="width:50%" class="text-center">
                                                         <br>
                                                         <strong>General Manager</strong>  <br>
                                                         Line Maintenance Planning & Control
                                                         <br>
                                                         @if($request['checked_name'] != null)
                                                             @if(\App\User::find($request['checked_name'])->signature != null)
                                                             <img src="uploads/users/signature/{{ \App\User::find($request['checked_name'])->signature  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                                                             @endif
                                                         <br>
                                                         Name & Signature <br>
                                                         @if( $request['checked_name'] != null)
                                                             {{ \App\User::find($request['checked_name'])->name }}
                                                         @endif
                                                         @else
                                                         .............................
                                                         @endif

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
                                         <td rowspan="2" class="text-center">
                                             Jakarta,
                                             @if( $request['approve_name'] != null) {{ date('d F Y', strtotime(\App\RequestHistory::where('status',3)->where('request_submittion_id', $request['id'])->orderBy('id', 'desc')->first()->created_at )) }}  @endif
                                             <br>
                                             <strong>Lead Auditor</strong>
                                             <br>

                                             @if( $request['approve_name'] != null)
                                                 @if(\App\User::find($request['approve_name'])->signature != null)
                                                 <img src="uploads/users/signature/{{ \App\User::find($request['approve_name'])->signature  }}" height="100" style="margin-bottom : -20px; margin-top: -20px;">
                                                 @endif
                                                 <br>
                                                 {{ \App\User::find($request['approve_name'])->name }}
                                             @else
                                               .............................
                                             @endif<br>
                                             Name & Signature
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
                                                 .............................................................................................. <br>
                                                 .............................................................................................. <br>
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
         Form No. GMF/Q-268 R5

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
                             <td class="text-center" colspan="4"><strong>MAINTENANCE ABILITY</strong></td>
                         </tr>
                         <tr>
                             <td>MAINTENANCE AREA : <br>

                                 {{ $aircrafRequest->maintenance_area_value }}
                             </td>
                             <td>NO.: <br> {{ $aircrafRequest->number }} </td>
                             <td>AIRCRAFT MANUFACTURER: <br> {{ $aircrafRequest->aircraft_manufacturer }}S </td>
                             <td>AIRCRAFT TYPE: <br> {{ $aircrafRequest->aircraft_type }} </td>
                         </tr>
                         <tr>
                             <td colspan="4">
                                 MANUFACTURERES DOCUMENT ATIONI DRAWING AVAILABILITY: <br>
                                 @if(\App\AircraftDocument::where('request_submittion_id',$request['id'] )->count() >= 1)
                                     See list of acceptable data/document required for {{ $aircrafRequest->aircraft_type }} <br>
                                 @else
                                     - <br>
                                 @endif
                                 TOOLS/EQUIPMENT AVAILBILlTY: <br>
                                 @if(\App\AircraftToolEquipment::where('request_submittion_id',$request['id'] )->count() >= 1)
                                     See list of tool and equipment up to
                                     {{ $aircrafRequest->ability }} Check
                                      {{ $aircrafRequest->aircraft_type }} <br>
                                 @else
                                     - <br>
                                 @endif
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2">
                                 MATERIAL AVAILABILITY: <br>
                                 @if(\App\AircraftMaterial::where('request_submittion_id',$request['id'] )->count() >= 1)
                                     Material will be order before maintenance (Based on work scope) <br>
                                 @else
                                     - <br>
                                 @endif
                             </td>
                             <td colspan="2">
                                 QUALIFIED PERSONNEL AVAILABILITY: <br>
                                 Certifying Staff : {{ \App\AircraftAuthorizedPersonel::where('request_submittion_id',$request['id'] )->count() }}
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2">
                                 ABILITY: (Put Check sign (<input type="checkbox" disabled checked>) to The Selected Boxes) <br>
                                 <table>
                                     <tr>
                                         <td>No </td>
                                         <td>Yes </td>
                                         <td> </td>
                                     </tr>
                                     <tr>
                                         <td><input type="checkbox" @if($aircrafRequest->ability != 'A-Check') checked @endif  > </td>
                                         <td><input type="checkbox" @if($aircrafRequest->ability == 'A-Check') checked @endif > </td>
                                         <td>A-Check </td>
                                     </tr>
                                     <tr>
                                         <td><input type="checkbox" @if($aircrafRequest->ability != 'C-Check') checked @endif  > </td>
                                         <td><input type="checkbox" @if($aircrafRequest->ability == 'C-Check') checked @endif > </td>
                                         <td>C-Check </td>
                                     </tr>
                                     <tr>
                                         <td><input type="checkbox" @if($aircrafRequest->ability != 'D-Check') checked @endif  > </td>
                                         <td><input type="checkbox" @if($aircrafRequest->ability == 'D-Check') checked @endif > </td>
                                         <td>D-Check </td>
                                     </tr>
                                     <tr>
                                         <td valign='top'>
                                             <input type="checkbox"
                                             @if($aircrafRequest->ability == 'A-Check' or $aircrafRequest->ability == 'C-Check' or $aircrafRequest->ability == 'D-Check') checked @endif  >
                                         </td>
                                         <td valign='top'>
                                             <input type="checkbox"
                                             @if($aircrafRequest->ability != 'A-Check' or $aircrafRequest->ability != 'C Check' or $aircrafRequest->ability != 'D Check') checked @endif > </td>
                                         <td>OTHER MAINTENANCE: <br>
                                             @if($aircrafRequest->ability != 'A-Check' or $aircrafRequest->ability != 'C Check' or $aircrafRequest->ability != 'D Check')
                                                 @if($aircrafRequest->ability == 'Other')
                                                     {{ $aircrafRequest->ability_other_value }} Check
                                                 @else
                                                     {{ $aircrafRequest->ability }} Check
                                                 @endif
                                             @else .............. @endif
                                         </td>
                                     </tr>
                                 </table>
                                 <br>
                                 LIMITATION:<br>
                                 {{ $aircrafRequest->limitation }}
                             </td>
                             <td colspan="2">
                                 SPECIAL WORK TO BE ORDER OUTSIDE: <br>
                                 {{ $aircrafRequest->special_work }}
                             </td>
                         </tr>
                         <tr>
                             <td colspan="4">
                                 <table style="width:100%">
                                     <tr>
                                         <td style="width:50%"  class="text-center">
                                             Prepared By <br>
                                             MANAGER <br>
                                             CAPACITY PLANNING & PERFORMAN CE-ANALYSIS
                                             <table class="fullwidth">
                                                 <tr>
                                                     <td style="width:150px" valign='top'>Signature</td>
                                                     <td> : <br>
                                                         @if($user->signature != null)
                                                             <img src="uploads/users/signature/{{ $user->signature }}" height="80" style="margin-left: -10px;margin-bottom:-20px; margin-top:-20px">
                                                         @endif
                                                         <!-- <img src="uploads/users/signature/{{ $user->signature }}" width="200" style="margin-left: -30px;margin-bottom:-20px; margin-top:-20px"> -->
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>NAME</td>
                                                     <td> : {{ $user->name }}</td>
                                                 </tr>
                                                 <tr>
                                                     <td>DATE</td>
                                                     <td> : @if($request['status'] != 0) {{ date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request['id'])->where('status', 1)->orderBy('id', 'desc')->first()->created_at )) }} @endif</td>
                                                 </tr>
                                             </table>
                                         </td>
                                         <td style="width:50%" class="text-center">
                                             Checked By <br>
                                             GENERAL MANAGER <br>
                                             LINE MAINTENANCE PLANNING & CONTROL
                                             <br>
                                             <table class="fullwidth">
                                                 <tr>
                                                     <td style="width:150px" valign='top'>Signature</td>
                                                     <td> : <br>
                                                         @if($request['checked_name'] != null)
                                                             @if(\App\User::find($request['checked_name'])->signature != null)
                                                                 <img src="uploads/users/signature/{{ \App\User::find($request['checked_name'])->signature }}" height="80" style="margin-left: -10px;margin-bottom:-20px; margin-top:-20px">
                                                             @endif
                                                         @endif
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>NAME</td>
                                                     <td> : @if($request['checked_name'] != null) {{ \App\User::find($request['checked_name'])->name }} @endif</td>
                                                 </tr>
                                                 <tr>
                                                     <td>DATE</td>
                                                     <td> : @if($request['checked_name'] != null) {{ date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request['id'])->where('status', 2)->orderBy('id', 'desc')->first()->created_at)) }} @endif</td>
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

         </table>
         Form No. GMF/Q-268 R5

         <div class="page_break"></div>
         Attachment of Line Maintenance Ability {{ $aircrafRequest->number }} <br>
         <strong style="font-size:14pt">List of Authorized Personel {{ $aircrafRequest->aircraft_type }}</strong> <br>
         STA 8TJ <br>
             <table class="table table-bordered isi-table">
                 <thead>
                     <tr>
                         <th rowspan="2">No</th>
                         <th rowspan="2">Name</th>
                         <th rowspan="2">Pers. No</th>
                         <th rowspan="2">Sta</th>
                         <th rowspan="2">Skill</th>
                         <th colspan="2">AME License</th>
                         <th colspan="2">COMPANY LICENSE</th>
                     </tr>
                     <tr>
                         <th>AMELNo.</th>
                         <th>Exp. Date   </th>
                         <th>GMF Auth No</th>
                         <th>Exp. Date</th>
                     </tr>
                         @php $no = 1 @endphp
                         @foreach($aircraftAuthPerosonel as $per)
                             <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $per->name }}</td>
                                 <td>{{ $per->personal_number }}</td>
                                 <td>{{ $per->sta }}</td>
                                 <td>{{ $per->skill }}</td>
                                 <td>{{ $per->amel_no }}</td>
                                 <td>{{ date('d F Y', strtotime($per->ex_date_ame)) }}</td>
                                 <td>{{ $per->gmf_auth_number }}</td>
                                 <td>{{ date('d F Y', strtotime($per->ex_date_company)) }}</td>
                             </tr>
                         @endforeach
                 </thead>
             </table>
         <div class="page_break"></div>
         Attachment of Line Maintenance Ability {{ $aircrafRequest->number }} <br>
         <strong style="font-size:14pt">List of Document's Up to {{ $aircrafRequest->ability }}  {{ $aircrafRequest->aircraft_type }}</strong><br>
         STA BTJ
         <table class="table table-bordered isi-table" >
             <thead>
                 <tr>
                     <th>No</th>
                     <th>Document Code</th>
                     <th>Type</th>
                     <th>Effective Code</th>
                     <th>Description</th>
                     <th>Manufacture</th>
                     <th>ACType</th>
                     <th>Update</th>
                 </tr>
                 @php $no = 1 @endphp
                 @foreach($aircraftDocument as $doc)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td>{{ $doc->document_code }}</td>
                         <td>{{ $doc->type }}</td>
                         <td>{{ $doc->effective_code }}</td>
                         <td>{{ $doc->description_document }}</td>
                         <td>{{ $doc->manufacture }}</td>
                         <td>{{ $doc->ac_type }}</td>
                         <td>{{ $doc->update }}</td>
                     </tr>
                 @endforeach
             </thead>
         </table>

         <div class="page_break"></div>

         Attachment of Line Maintenance Ability {{ $aircrafRequest->number }} <br>
         <strong style="font-size:14pt">List of Materials Up to {{ $aircrafRequest->ability }}  {{ $aircrafRequest->aircraft_type }}</strong> <br>
         Sta. BTJ <br>

         <table class="table table-bordered isi-table">
             <thead>
                 <tr>
                     <th>NO.</th>
                     <th>Camp Number</th>
                     <th>Jobcard Number</th>
                     <th>Title</th>
                     <th>MPD No</th>
                     <th>References</th>
                     <th>Interval</th>
                     <th>Desciption</th>
                     <th>Part Number</th>
                     <th>QTY</th>
                     <!-- <th>Availability</th> -->
                 </tr>
             </thead>
             <tbody>
                 @php $no = 1 @endphp
                 @foreach($aircraftMaterial as $mat)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td>{{ $mat->camp_number }}</td>
                         <td>{{ $mat->jobcard_number }}</td>
                         <td>{{ $mat->title }}</td>
                         <td>{{ $mat->mpd_number }}</td>
                         <td>{{ $mat->references }}</td>
                         <td>{{ $mat->interval }}</td>
                         <td>{{ $mat->description_material }}</td>
                         <td>{{ $mat->pn }}</td>
                         <td>{{ $mat->qty }}</td>
                     </tr>
                 @endForeach
             </tbody>
         </table>

         <div class="page_break"></div>
         Attachment of Line Maintenance Ability {{ $aircrafRequest->number }} <br>
        <strong style="font-size:14pt"> List of Tools and Equipment Up to {{ $aircrafRequest->ability }}  {{ $aircrafRequest->aircraft_type }} </strong> <br>
         STA BTJ <br>

         <table class="table table-bordered isi-table">
             <thead>
                 <tr>
                     <th>NO.</th>
                     <th>Camp Number</th>
                     <th>Jobcard Number</th>
                     <th>Title</th>
                     <th>MPD No</th>
                     <th>References</th>
                     <th>Interval</th>
                     <th>Desciption</th>
                     <th>Part Number</th>
                     <th>QTY</th>
                     <!-- <th>UNIT</th>
                     <th>REMARKS</th> -->
                 </tr>
             </thead>
             <tbody>
                 @php $no = 1 @endphp
                 @foreach($aircraftToolEquipment as $tool)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td>{{ $tool->camp_number }}</td>
                         <td>{{ $tool->jobcard_number }}</td>
                         <td>{{ $tool->title }}</td>
                         <td>{{ $tool->mpd_number }}</td>
                         <td>{{ $tool->references }}</td>
                         <td>{{ $tool->interval }}</td>
                         <td>{{ $tool->description_tools }}</td>
                         <td>{{ $tool->part_no }}</td>
                         <td>{{ $tool->qty }}</td>
                         <!-- <td>{{ $tool->unit }}</td>
                         <td>{{ $tool->remark }}</td> -->
                     </tr>
                 @endforeach
             </tbody>
         </table>
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

</style>
