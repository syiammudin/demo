<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>View Detail Request</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ storage_path('pdf.css') }}">

    </head>
    <body >
      <?php
          if($request->AircraftRequest->engine != null){
              $series = 'Series Engine '. $request->AircraftRequest->engine;
          }else{
              $series = '' ;
          }
      ?>
        @if($request->AircraftRequest->status == 2 && $request->AircraftRequest->status_read != null)
        <div id="watermark">
            <h1>CHECKEED</h1>
        </div>
        @endif
        @if($type == 'cover')
          <div class="col-md-12 text-center">
              <img src="{{ public_path('images/gmf.png') }}" width="200">
          </div>
          <div class="cover" >
              Maintenance Capability <br>
              {{ $request->AircraftRequest->aircraft_type }} <br>
              @if($request->AircraftRequest->engine != null ) Powered By @endif {{ $series }}
          </div>
        @endif
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
                $pdf->page_text(20, $y, "Form No. GMF/Q-268 R5" , $font, $size );
            }
        </script>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                </td>
            </tr>
        </table >
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
                  <td style="width:300px"> : {{ strtoupper($request->AircraftRequest->aircraft_type) }}</td>
                </tr>
                <tr>
                  <td></td>
                  <td> Manufacturer  <br> <br> </td>
                  <td> : {{ strtoupper($request->AircraftRequest->aircraft_manufacturer) }}<br> <br>  </td>
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
                        <td style="width: 20px"> <input type="checkbox" @if($request->AircraftRequest->maintenance_area_value == $hg->hangar_name) Checked @endif >  </td>
                        <td> {{ $hg->hangar_name }}</td>
                      </tr>
                      @endForeach
                      <tr>
                        <td style="width: 20px"> <input type="checkbox" @if($request->AircraftRequest->maintenance_area == 'line_maintenance') Checked @endif >  </td>
                        <td> Line Maintenance : @if($request->AircraftRequest->maintenance_area == 'line_maintenance')
                          @if($request->AircraftRequest->maintenance_area_value != null && \App\MaintenanceArea::where('code', $request->AircraftRequest->maintenance_area_value)->count() >= 1)
                              {{ \App\MaintenanceArea::where('code', $request->AircraftRequest->maintenance_area_value)->first()->description }}
                          @endif
                          ({{ $request->AircraftRequest->maintenance_area_value }}) </td>
                          @endif
                        </tr>
                        <tr>
                          <td style="width: 20px"> <input type="checkbox" @if($request->AircraftRequest->maintenance_area == 'other_area') Checked @endif>  </td>
                          <td> Other : @if($request->AircraftRequest->maintenance_area == 'other_area')
                            {{ strtoupper($request->AircraftRequest->maintenance_area_value) }}
                            @endif</td>
                          </tr>
                        </table>
                          <br>
                      </td>
                    </tr>
                    <tr>
                      <th>3. </th>
                      <th colspan="2">APPROVAL REQUEST</th>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="2">
                        Approval request to {{ $request->request_type }} capability to carry out: ({{ str_replace('RATING','',$request->AircraftRequest->authority) }}) <br>
                        Inspection up to
                        @if($request->AircraftRequest->ability != null )
                          {{ $request->AircraftRequest->ability }}
                        @else
                          {{ $request->AircraftRequest->ability_other_value }}
                        @endif

                        including minor repair, minor alteration for {{ $request->AircraftRequest->aircraft_manufacturer }} {{ $request->AircraftRequest->aircraft_type }}
                        {{ $series }}
                        <br>
                        <br>
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
                            <td style="width:20px;"> <input type="checkbox" @if($request->AircraftRequest->facilities == 1) checked @endif > </td>
                            <td> Facilities </td>
                            <td style="width:20px;"> <input type="checkbox" @if($request->AircraftRequest->qualified_personel == 1) checked @endif> </td>
                            <td> Qualified Personnel </td>
                          </tr>
                          <tr>
                            <td> <input type="checkbox" @if($request->AircraftRequest->certifying_staff == 1) checked @endif> </td>
                            <td> Certifying Staff </td>
                            <td> <input type="checkbox" @if($request->AircraftRequest->special_tools == 1) checked @endif> </td>
                            <td>  Special Tools </td>
                          </tr>
                          <tr>
                            <td> <input type="checkbox" @if($request->AircraftRequest->approved_data == 1) checked @endif> </td>
                            <td>  Approved Data </td>
                            <td> <input type="checkbox" @if($request->AircraftRequest->consumable == 1) checked @endif> </td>
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

                              @php
                              $filter_manager = array_filter($request->RequestHistory->toArray(), function($el) {
                                return $el['status'] == 2;
                              });
                              $manager = end($filter_manager)
                              @endphp
                              @if($request->status >= 2)
                              {{  $manager['user']['position_name'] }}
                              <br>
                              @if($manager['user']['signature'] != null)
                              <img src="uploads/users/signature/{{ $manager['user']['signature']  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                              @endif
                              @endif
                              <br>
                              Name & Signature <br>
                              @if($request->status >= 2)
                              {{ $manager['user']['name'] }}
                              @endif
                            </td>
                            <td style="width:50%" class="text-center">
                              <br>
                              <strong>General Manager</strong>  <br>
                              @php
                              $filteredgm = array_filter($request->RequestHistory->toArray(), function($el) {
                                return $el['status'] == 3;
                              });
                              $gm = end($filteredgm)
                              @endphp

                              @if($request->status >= 3)
                              {{ $gm['user']['position_name'] }}
                              <br>
                              @if($gm['user']['signature'] != null)
                              <img src="uploads/users/signature/{{ $gm['user']['signature']  }}" height="100" style="margin-bottom : -30px; margin-top: -30px;">
                              @endif
                              <br>
                              Name & Signature <br>
                              {{ $gm['user']['name'] }}

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
                            <td style="width:20px"><input type="checkbox" @if($request->status == 5) checked @endif></td>
                            <td>Aproved</td>
                            <td style="width:20px"></td>
                            <td style="width:20px"><input type="checkbox" @if($request->status == 6 || $request->status == 8) checked @endif ></td>
                            <td>Disapproved</td>
                          </tr>
                        </table>
                      </td>
                      <td rowspan="2" class="text-center">
                        Jakarta,
                        @php
                        $filtered_gmqsa = array_filter($request->RequestHistory->toArray(), function($el) {
                          return $el['status'] == 5;
                        });
                        $gmqsa = end($filtered_gmqsa)
                        @endphp
                        @if($request->status >= 5)
                        {{date('d F Y', strtotime($gmqsa['created_at']))}}
                        @endif
                        <br>

                        @if($request->status >= 5)
                        <strong>{{  $gmqsa['user']['position_name'] }}</strong>
                        <br>
                        <br>
                        @if($gmqsa['user']['signature'] != null)
                        <img src="uploads/users/signature/{{ $gmqsa['user']['signature']  }}" height="100" style="margin-bottom : -20px; margin-top: -20px;">
                        @endif
                        <br>
                        Name & Signature
                        <br>
                        {{ $gmqsa['user']['name'] }}
                        @else
                        .............................
                        @endif<br>
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
        @endif

        @if($type == 'landscape')
        <script type="text/php">
            if (isset($pdf)) {
                $text = "";
                $size = 7;
                $font = $fontMetrics->getFont("Myriad");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size );
                $pdf->page_text(20, $y, "Form No.: GMF/Q-267 R1" , $font, $size );
            }
        </script>
        <table style="width:100%">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('images/gmf.png') }}" width="200">
                </td>
            </tr>
        </table>
        <table class="table table-bordered" style="margin-bottom:0px;">
          <tr>
            <td class="text-center" colspan="4"><strong>MAINTENANCE ABILITY</strong></td>
          </tr>
          <tr>
            <td>MAINTENANCE AREA : <br>
              @if($request->AircraftRequest->maintenance_area == 'line_maintenance')
              {{ $request->AircraftRequest->maintenance_area_value }}
              @else
              {{ $request->AircraftRequest->maintenance_area_value }}
              @endif
            </td>
            <td>NO.: <br> {{ $request->AircraftRequest->number }} </td>
            <td>AIRCRAFT MANUFACTURER: <br> {{ $request->AircraftRequest->aircraft_manufacturer }} </td>
            <td>AIRCRAFT TYPE: <br> {{ $request->AircraftRequest->aircraft_type }} </td>
          </tr>
          <tr>
            <td colspan="4">
              MANUFACTURES DOCUMENTATION / DRAWING AVAILABILITY: <br>
              @if(\App\AircraftDocument::where('request_submittion_id',$request->id )->count() >= 1)
              See list of Acceptable data/document required for {{ $request->AircraftRequest->aircraft_type }} {{ $series }} <br>
              @else
              - <br>
              @endif
              TOOLS/EQUIPMENT AVAILABILITY: <br>
              @if(\App\AircraftToolEquipment::where('request_submittion_id',$request->id )->count() >= 1)
                See list of Tool and Equipment up to
                {{ $request->AircraftRequest->ability }}
                @if($request->AircraftRequest->ability == 'Other')
                Check
                @endif
                {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
              @else
              -
              @endif

            </td>
          </tr>
          <tr>
            <td colspan="2" style="width:58%;">
              MATERIAL AVAILABILITY: <br>
              @if(\App\AircraftMaterial::where('request_submittion_id',$request->id )->count() >= 1)
              SEE ATTACHMENT LIST OF MATERIAL FOR  {{ $request->AircraftRequest->aircraft_type }} {{ $series }} <br>
              @else
              MATERIAL WILL BE ORDERED BEFORE MAINTENANCE (Based on Customer's Workscope) <br>
              @endif
            </td>
            <td rowspan="2" colspan="2">
              QUALIFIED PERSONNEL AVAILABILITY: <br>
              <br>
              @php
              $amel = \App\AircraftAuthorizedPersonel::where('request_submittion_id',$request->id )->where('license_type','amel')->count()  ;
              $cs = \App\AircraftAuthorizedPersonel::where('request_submittion_id',$request->id )->where('license_type','cs')->count()  ;
              @endphp
              @if($amel != 0 )
              Amel Holder : {{ $amel }}<br>
              @endif
              @if($cs != 0)
              Certifying Staff : {{ $cs }}
              @endif
            </td>
          </tr>
          <tr>
            <td colspan="2" rowspan="2" style="padding-bottom: 0px;">
              ABILITY: (Put Check sign (<input type="checkbox" disabled checked>) to The Selected Boxes) <br>
              <table>
                <tr>
                  <td>No </td>
                  <td>Yes </td>
                  <td> </td>
                </tr>
                <tr>
                  {{ $request->ability_a_check }}
                  <td><input type="checkbox" @if($request->AircraftRequest->ability != 'A-Check') checked @endif  > </td>
                  <td><input type="checkbox" @if($request->AircraftRequest->ability == 'A-Check') checked @endif > </td>
                  <td>A-Check  @if($request->AircraftRequest->ability == 'A-Check' && $request->AircraftRequest->customer != null ) (For {{ $request->AircraftRequest->customer }})  @endif</td>
                </tr>
                <tr>
                  <td><input type="checkbox" @if($request->AircraftRequest->ability != 'C-Check') checked @endif  > </td>
                  <td><input type="checkbox" @if($request->AircraftRequest->ability == 'C-Check') checked @endif > </td>
                  <td>C-Check @if($request->AircraftRequest->ability == 'C-Check' && $request->AircraftRequest->customer != null) (For {{ $request->AircraftRequest->customer }}) @endif</td>
                </tr>
                <tr>
                  <td><input type="checkbox" @if($request->AircraftRequest->ability != 'D-Check') checked @endif  > </td>
                  <td><input type="checkbox" @if($request->AircraftRequest->ability == 'D-Check') checked @endif > </td>
                  <td>D-Check @if($request->AircraftRequest->ability == 'D-Check' && $request->AircraftRequest->customer != null) (For {{ $request->AircraftRequest->customer }}) @endif</td>
                </tr>
                <tr>
                  <td valign='top'>
                    <input type="checkbox"
                    @if($request->AircraftRequest->ability == 'A-Check' or $request->AircraftRequest->ability == 'C-Check' or $request->AircraftRequest->ability == 'D-Check') checked @endif  >
                  </td>
                  <td valign='top'>
                    <input type="checkbox"
                    @if($request->AircraftRequest->ability != 'A-Check' and $request->AircraftRequest->ability != 'C-Check' and $request->AircraftRequest->ability != 'D-Check') checked @endif > </td>
                    <td>OTHER MAINTENANCE: <br>
                      @if($request->AircraftRequest->ability != 'A-Check' and $request->AircraftRequest->ability != 'C-Check' and $request->AircraftRequest->ability != 'D-Check')
                      @if($request->AircraftRequest->ability == 'Other')
                      {{ $request->AircraftRequest->ability_other_value }} Check
                      @else
                      {{ $request->AircraftRequest->ability }} Check @if($request->AircraftRequest->customer != null) For {{ $request->AircraftRequest->customer }} @endif
                      @endif
                      @else .............. @endif


                    </td>
                  </tr>
                </table>
                <br>
                LIMITATION:<br>
                {{ ucwords($request->AircraftRequest->limitation) }}
              </td>
            </tr>
            <tr>
              <td colspan="2">
                SPECIAL WORK TO BE ORDER OUTSIDE: <br>
                {{ $request->AircraftRequest->special_work }}
              </td>
            </tr>
          </table>
          <table class="table table-bordered" style="margin-top: -2px; margin-bottom:0px;">
            <tr>
              <td colspan="4">
                <table style="width:100%">
                  <tr>
                    <td style="width:50%"  class="text-center">
                      Prepared By <br>
                      MANAGER <br>
                      @php
                      $filter_manager = array_filter($request->RequestHistory->toArray(), function($el) {
                        return $el['status'] == 2;
                      });
                      $manager = end($filter_manager)
                      @endphp
                      @if($request->status >= 2)
                          {{ strtoupper($manager['user']['position_name']) }}
                      @endif
                      <br>
                      <table class="fullwidth">
                        <tr>
                          <td style="width:150px" valign='top'>Signature</td>
                          <td> : <br>
                            @if($request->status >= 2)
                            @if($manager['user']['signature'] != null)
                            <img src="uploads/users/signature/{{ $manager['user']['signature'] }}" height="80" style="margin-left: -10px;margin-bottom:-20px; margin-top:-20px">
                            @endif
                            @endif
                            <!-- <img src="uploads/users/signature/{{ $request->User->signature }}" width="200" style="margin-left: -30px;margin-bottom:-20px; margin-top:-20px"> -->
                          </td>
                        </tr>
                        <tr>
                          <td>NAME</td>
                          <td> : @if($request->status >= 2) {{ $manager['user']['name'] }} @endif</td>
                        </tr>
                        <tr>
                          <td>DATE</td>
                          <td> : @if($request->status >= 2) {{ date('d F Y', strtotime($manager['created_at'])) }} @endif</td>
                        </tr>
                      </table>
                    </td>
                    <td style="width:50%" class="text-center">
                      Checked By <br>
                      GENERAL MANAGER <br>
                      @php
                      $filter_gm = array_filter($request->RequestHistory->toArray(), function($el) {
                        return $el['status'] == 3;
                      });
                      $gm = end($filter_gm)
                      @endphp
                      @if($request->status >= 3)
                          {{ strtoupper($gm['user']['position_name']) }}
                      @endif
                      <br>
                      <table class="fullwidth">
                        <tr>
                          <td style="width:150px" valign='top'>Signature</td>
                          <td> : <br>
                            @if($request->status >= 3)
                            @if($gm['user']['signature'] != null)
                            <img src="uploads/users/signature/{{ $gm['user']['signature'] }}" height="80" style="margin-left: -10px;margin-bottom:-20px; margin-top:-20px">
                            @endif
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td>NAME</td>
                          <td> : @if($request->status >= 3) {{ $gm['user']['name'] }} @endif</td>
                        </tr>
                        <tr>
                          <td>DATE</td>
                          <td> : @if($request->status >= 3) {{ date('d F Y', strtotime($gm['user']['created_at'])) }} @endif</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        @endif


    @if($type == 'content')
        <div class="col-md-12 text-center">
            <img src="{{ public_path('images/gmf.png') }}" width="200">
        </div>
        <br>
        <br>
        <br>
        <div class="col-md-12 content-text">
          <div class="col-md-12 text-center">CONTENTS</div>
          <br>
          1. Maintenance Capability Evaluation Sheet Request <br><br>
          2. Maintenance Ability <br><br>
          3. Appendix <br><br>
          <ul>
            <li class="apendix-li"> Appendix A <br>
              List of AMEL {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
            </li>
            <li class="apendix-li"> Appendix B <br>
              List of Certifying Staff Personnel {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </li>
          <li class="apendix-li"> Appendix C <br>
              List of Maintenance Document {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </li>
          <li class="apendix-li"> Appendix D <br>
              List of Material {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </li>
          <li class="apendix-li"> Appendix E <br>
              List of Test & Equipment {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          <li class="apendix-li"> Apendix F <br>
              List of Facilities {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </li>

          @if(count($request->AdditionalAttachment) != null)
          <li class="apendix-li"> Apendix Additional Attachment <br>
              List Of Additional Attachment {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </li>
          @endif
        </ul>
      </div>


          <div class="page_break"></div>
          <div class="apendik">
            Appendix A <br>
            <div class="title-apendik">
                List Of AMEL {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
            </div>
          </div>
    @endif


    @if($type == 'amel')
        Attachment of Maintenance Ability {{ $request->AircraftRequest->number }} <br>
        <strong style="font-size:14pt">List of Authorized Personnel {{ $request->AircraftRequest->aircraft_type }} Amel Holder</strong> <br>
            <table class="table isi-table table-bordered isi-table">
                  <thead>
                    <tr>
                        <th rowspan="2" class="middle" style="width:20px">No</th>
                        <th rowspan="2" class="middle">Name</th>
                        <th rowspan="2" class="middle">Pers. No</th>
                        <th rowspan="2" class="middle">Unit/Sta</th>
                        <th rowspan="2" class="middle">Stamp No</th>
                        <th rowspan="2" class="middle">Jobs Title</th>
                        <th colspan="2" class="middle">AMEL License</th>
                        <!-- <th colspan="2" class="middle">COMPANY LICENSE</th> -->
                    </tr>
                    <tr>
                        <th style="width: 200px;">Aircraft Type.</th>
                        <th>Exp. Date   </th>
                        <!-- <th style="width: 200px;">Scope of Authorization</th>
                        <th>Exp. Date</th> -->
                    </tr>
                  </thead>
                  <tbody>
                      @php $no = 1 @endphp
                      @if(\App\AircraftAuthorizedPersonel::where('license_type','amel')->where('request_submittion_id', $request->id)->count() == 0)
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
                      @foreach($request->AircraftAuthorizedPersonel as $per)
                        @if($per->license_type == 'amel')
                        <tr>
                          <td class="text-center">{{ $no++ }}</td>
                          <td>{{ $per->name }}</td>
                          <td>{{ $per->personal_number }}</td>
                          <td>{{ $per->sta }}</td>
                          <td>{{ $per->stamp_no }}</td>
                          <td>{{ $per->skill }}</td>
                          <td>
                            Amel No : <br> {{ $per->amel_no }} <br>
                            @foreach(json_decode($per->amel_scope) as $amel )
                            <span style="font-size:6pt">{{ $amel }}<br> </span>
                            @endForeach
                          </td>
                          <td>{{ date('d F Y', strtotime($per->ex_date_ame)) }}</td>
                          <!-- <td>@if($per->license_type == 'cs') GMF Auth No <br> {{ $per->gmf_auth_number }}@endif</td>
                          <td>@if($per->license_type == 'cs'){{ date('d F Y', strtotime($per->ex_date_company)) }}@endif</td> -->
                        </tr>
                        @endif
                      @endforeach
                  </tbody>
            </table>
        @endif
        @if($type == 'apendixcs')
        <div class="apendik">
          Appendix B <br>
          <div class="title-apendik">
            List Of Certifying Staff Personnel {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>
        @endif
        @if($type == 'cs')
        Attachment of Maintenance Ability {{ $request->AircraftRequest->number }} <br>
        <strong style="font-size:14pt">List of Authorized Personnel {{ $request->AircraftRequest->aircraft_type }} Certifying Staff Holder</strong> <br>
            <table class="table  isi-table table-bordered isi-table">
              <thead>
                <tr>
                  <th rowspan="2" class="middle" style="width:20px">No</th>
                  <th rowspan="2" class="middle">Name</th>
                  <th rowspan="2" class="middle">Pers. No</th>
                  <th rowspan="2" class="middle">Unit/Sta</th>
                  <th rowspan="2" class="middle">Stamp No</th>
                  <th rowspan="2" class="middle">Jobs Title</th>
                  <th colspan="2" class="middle">AMEL License</th>
                  <th colspan="2" class="middle">COMPANY LICENSE</th>
                </tr>
                <tr>
                  <th style="width: 200px;">Aircraft Type.</th>
                  <th>Exp. Date   </th>
                  <th style="width: 200px;">Scope of Authorization</th>
                  <th>Exp. Date</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1 @endphp
                @if(\App\AircraftAuthorizedPersonel::where('license_type','cs')->where('request_submittion_id', $request->id)->count() == 0)
                <tr>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                </tr>
                @endif
                @foreach($request->AircraftAuthorizedPersonel as $per)
                @if($per->license_type == 'cs')
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td>{{ $per->name }}</td>
                  <td>{{ $per->personal_number }}</td>
                  <td>{{ $per->sta }}</td>
                  <td>{{ $per->stamp_no }}</td>
                  <td>{{ $per->skill }}</td>
                  <td> Amel No : <br> {{ $per->amel_no }} <br>
                    @foreach(json_decode($per->amel_scope) as $amel )
                    <span style="font-size:6pt">{{ $amel }}<br> </span>
                    @endForeach
                  </td>
                  <td>{{ date('d F Y', strtotime($per->ex_date_ame)) }}</td>
                  <td>GMF Auth No <br> {{ $per->gmf_auth_number }} <br>
                    @foreach(json_decode($per->gmf_scope) as $gmf )
                    <span style="font-size:6pt">{{ $gmf }}<br> </span>
                    @endForeach
                  </td>
                  <td>{{ date('d F Y', strtotime($per->ex_date_company)) }}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
    @endif
    @if($type == 'potrait2')
        <div class="apendik">
          Appendix C<br>
          <div class="title-apendik">
            List Of Documents {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>

        <div class="page_break"></div>
        Attachment of Maintenance Ability {{ $request->AircraftRequest->number }} <br>
        <strong style="font-size:14pt">List of Document's Up to {{ $request->AircraftRequest->ability }}
            @if($request->AircraftRequest->ability == 'Other')
                Check
            @endif {{ $request->AircraftRequest->aircraft_type }}</strong><br>

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
                    <th>Revision</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1 @endphp
                @if(count($request->AircraftDocument) ==0)
                <tr>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                  <td class="text-center" >N/A</td>
                </tr>
                @endif
                @foreach($request->AircraftDocument as $doc)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $doc->document_code }}</td>
                  <td>{{ $doc->type }}</td>
                  <td>{{ $doc->effective_code }}</td>
                  <td>{{ $doc->description_document }}</td>
                  <td>{{ $doc->manufacture }}</td>
                  <td>{{ $doc->ac_type }}</td>
                  <td>Rev. {{ $doc->rev }}, Rev Date {{ $doc->rev_date }}</td>
                </tr>
                @endforeach
              </tbody>
        </table>
        <div class="page_break"></div>
        <div class="apendik">
          Appendix D<br>
          <div class="title-apendik">
            List Of Materials {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>
        <div class="page_break"></div>

        @if(count($request->AircraftMaterial) == 0)
            <div class="apendik">
                Based on the Work Scope (Refer to AMM provided by Customer)
            </div>
        @else
            Attachment of Maintenance Ability {{ $request->AircraftRequest->number }} <br>
            <strong style="font-size:14pt">List of Materials Up to {{ $request->AircraftRequest->ability }}
            @if($request->AircraftRequest->ability == 'Other')
                Check
            @endif
            {{ $request->AircraftRequest->aircraft_type }} </strong><br>
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
                    @if(count($request->AircraftMaterial) == 0)
                    <tr>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <td class="text-center">N/A</td>
                      <!-- <td>{{ $mat->availability }}</td> -->
                    </tr>
                    @endif
                    @foreach($request->AircraftMaterial as $mat)
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
                        <!-- <td>{{ $mat->availability }}</td> -->
                      </tr>
                    @endForeach
                </tbody>
            </table>
        @endif


        <div class="page_break"></div>
        <div class="apendik">
          Appendix E<br>
          <div class="title-apendik">
            List Of Special Tools {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>
        <div class="page_break"></div>
        Attachment of Maintenance Ability {{ $request->AircraftRequest->number }}<br>
        <strong style="font-size:14pt">List of Tools and Equipment Up to {{ $request->AircraftRequest->ability }}
            @if($request->AircraftRequest->ability == 'Other')
                Check
            @endif {{ $request->AircraftRequest->aircraft_type }} </strong> <br>


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
                    <th>UNIT</th>
                    <!-- <th>REMARKS</th> -->
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @if(count($request->AircraftToolEquipment) == 0)
                <tr>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                  <td class="font-little text-center">N/A</td>
                </tr>
                @endif
                @foreach($request->AircraftToolEquipment as $tool)
                  <tr>
                    <td class="font-little">{{ $no++ }}</td>
                    <td class="font-little">{{ $tool->camp_number }}</td>
                    <td class="font-little">{{ $tool->jobcard_number }}</td>
                    <td class="font-little">{{ $tool->title }}</td>
                    <td class="font-little">{{ $tool->mpd_number }}</td>
                    <td class="font-little">{{ $tool->references }}</td>
                    <td class="font-little">{{ $tool->interval }}</td>
                    <td class="font-little">{{ $tool->description_tools }}</td>
                    <td class="font-little">{{ $tool->part_no }}</td>
                    <td class="font-little">{{ $tool->qty }}</td>
                    <td>{{ $tool->unit }}</td>
                    <!-- <td>{{ $tool->remark }}</td> -->
                  </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page_break"></div>
        <div class="apendik">
          Appendix F<br>
          <div class="title-apendik">
            List Of Facilities {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>
        <div class="page_break"></div>
        Attachment of Maintenance Ability {{ $request->AircraftRequest->number }}<br>
        <strong style="font-size:14pt">List of Facilities Up to {{ $request->AircraftRequest->ability }}
            @if($request->AircraftRequest->ability == 'Other')
                Check
            @endif {{ $request->AircraftRequest->aircraft_type }} </strong> <br>


        <table class="table table-bordered isi-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <!-- <th>UNIT</th>
                    <th>REMARKS</th> -->
                </tr>
            </thead>
            <tbody>
              @php $no = 1 @endphp
              @if(\App\AircraftFacility::where('request_submittion_id', $request->id)->count() == 0)
              <tr>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
                <td class="text-center" >N/A</td>
              </tr>
              @endif
                @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->distinct('description_main')->select('description_main')->get() as $af)
                    <?php
                        $cek = \App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->count() ;
                    ?>
                    @if($cek > 1)
                      <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $af->description_main }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->get() as $d)
                        <tr>
                          <td></td>
                          <td>{{ $d->description }}</td>
                          <td>{{ $d->quantity }}</td>
                          <td>{{ $d->unit }}</td>
                          <td>{{ $d->status }}</td>
                          <td>{{ $d->remark }}</td>
                        </tr>
                      @endForeach
                    @else
                      @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->get() as $d)
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $d->description_main }}</td>
                          <td>{{ $d->quantity }}</td>
                          <td>{{ $d->unit }}</td>
                          <td>{{ $d->status }}</td>
                          <td>{{ $d->remark }}</td>
                        </tr>
                      @endForeach
                    @endif
                    <?php $no++ ; ?>
                @endForeach
            </tbody>
        </table>

        @if(count($request->AdditionalAttachment) != null)
        <div class="page_break"></div>
        <div class="apendik">
          Appendix Additional Attachment<br>
          <div class="title-apendik">
            List Of Additional Attachment {{ $request->AircraftRequest->aircraft_type }} {{ $series }}
          </div>
        </div>
        @endif
@endif

    </body>

    <!-- <style media="screen">
    @font-face {
        font-family: 'Myriad';
        src: url(" {{ storage_path('Myriad MM Regular.ttf') }}");
    }

    body {
        font-family: Myriad;
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
    </style> -->
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
.apendik{
    font-size: 42px;
    padding-top : 45%;
    text-align: center;
}

.cover{
    font-size: 28px;
    padding-top : 30%;
    text-align: center;
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
    vertical-align : middle ;
}

.middle {
    vertical-align : middle !important ;
}
body, table  {
    font-size: 10pt;
}
.content-text{
   font-size: 16pt ;
}
.apendix-li {
   margin-left: 40px;
   padding-bottom: 20px;
}
.title-apendik{
  font-size : 12pt ;
}

.font-little{
  font-size: 6pt!important ;
}
</style>
