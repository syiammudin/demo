<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ public_path ('pdf.css') }}">
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

        *{margin:0;padding:0}
        th,td,p,div,b ... {margin:0;padding:0}
        html{margin:40px 50px}
        </style>
    </head>
    <body>
    <?php
        $tool_category = json_decode($equivalent->tool_category);
        $ability = json_decode($equivalent->ability);
        $recomended_tool = json_decode($equivalent->recomended_tool);
        $alternate_tool = json_decode($equivalent->alternate_tool);
        $maintenance_task = json_decode($equivalent->maintenance_task);
        $recomended = json_decode($equivalent->recomended);
        $alternate = json_decode($equivalent->alternate);

    ?>
    @if($type === 'potrait2')
    <table class="fullwidth">
        <tr>
            <td class="text-center">
                <img src="{{ public_path('images/gmf.png') }}" width="200">
            </td>
        </tr>
        <tr>
            <td>
                <table class="table table-bordered mini-line-hight">
                    <tr>
                         <td colspan='3' class="text-center"> EQUIVALENT TOOL/EQUIPMENT <br> ANALYSIS REPORT </td>
                         <td > No. {{ $equivalent->equivalent_number }} </td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="height:10px !important;">
                            <table class="fullwidth">
                                <tr>
                                    <td style="width:170px;"> Tool/Equipment Category </td>
                                    <td>
                                        <input type="checkbox" @if(!empty($tool_category->two)) checked @endif> 2  <br>
                                        <input type="checkbox" @if(!empty($tool_category->three)) checked @endif> 3  <br>
                                        <input type="checkbox" @if(!empty($tool_category->four)) checked @endif> 4
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="3" style="height:10px !important;">
                            <div class="row" >
                                <div class="col-xs-5">
                                    Original Issued Date
                                </div>
                                <div class="col-xs-7">
                                    : {{ $equivalent->original_issued }}
                                </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-xs-5">
                                        Rev
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ $equivalent->rev_no }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-5">
                                        Issued Date
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ $equivalent->issued }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0px">
                                <div class="row">
                                    <div class="col-xs-4 distribution">
                                        Distribution
                                    </div>
                                        <div class="col-xs-6 distribution-border" >
                                        : {{ strtoupper($equivalent->distribution) }}
                                    </div>
                                </div>
                            </td>
                            <td colspan="3" style="padding:0px;">
                                <div class="row" style="width:100%;">
                                    <div class="col-xs-2 distribution">
                                        TQC
                                    </div>
                                    <div class="col-xs-2 distribution-border">

                                    </div>
                                    <div class="col-xs-2 distribution-border" >

                                    </div>
                                    <div class="col-xs-2 distribution-border" >

                                    </div>
                                    <div class="col-xs-2 distribution-border" >

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                EFFECTIVITY
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center" style="width:350px"> <input type="checkbox" @if($equivalent->efectifity == 'Aircraft') checked @endif > <label for="checkbox6"> Aircraft</label> </td>
                            <td colspan="2" class="text-center" style="width:350px"> <input type="checkbox" @if($equivalent->efectifity == 'Aircraft Component') checked @endif > <label for="checkbox6"> Aircraft Component </label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-xs-5">
                                        Aircraft or A/C Company type
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ strtoupper($request->ComponentRequest->aircraft_type)  }}
                                    </div>
                                </div>
                            </td>
                            <td rowspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        ATA
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ $request->ComponentRequest->ata_chapter  }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-xs-5">
                                        Description
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ $request->ComponentRequest->component_name  }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-xs-5">
                                        Part Number
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ str_replace('|',',',$request->ComponentRequest->part_number)  }}
                                    </div>
                                </div>
                            </td>
                            <td rowspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Doc No
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ $equivalent->doc_no  }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-xs-5">
                                        Manufacturer
                                    </div>
                                    <div class="col-xs-7">
                                        : {{ strtoupper($request->ComponentRequest->vendor_manufacturer)  }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                REASON OF ISSUANCE : <br>
                                {{ $equivalent->reason_issuance  }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                EFECT ON MAINTENANCE PROCEDURE : <br>
                                <input type="checkbox" @if($request->ComponentRequest->effect_maintenance_procedure == 0) checked @endif > NO <br>
                                <input type="checkbox" @if($request->ComponentRequest->effect_maintenance_procedure == 1) checked @endif > YES
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-xs-2 ">
                                        <input type="checkbox" @if(!empty($ability->test) ) checked @endif ><label for="checkbox6">TEST </label>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="checkbox" @if(!empty($ability->diassembly) ) checked @endif><label for="checkbox6">DIASSEMBLY </label>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="checkbox" @if(!empty($ability->assembly) ) checked @endif><label for="checkbox6">ASSEMBLY </label>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="checkbox" @if(!empty($ability->cleaning) ) checked @endif><label for="checkbox6">CLEANING  </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <input type="checkbox" @if(!empty($ability->inspection) ) checked @endif><label for="checkbox6">INSPECTION </label>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="checkbox" @if(!empty($ability->trouble_shooting) ) checked @endif><label for="checkbox6">TROUBLE SHOOTING </label>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="checkbox" @if(!empty($ability->repair) ) checked @endif><label for="checkbox6">REPAIR </label>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="checkbox" @if(!empty($ability->firs_clearance) ) checked @endif><label for="checkbox6">FITS AND CLEARANCE </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" > Reason of Revision : {{ $equivalent->reason_of_revision }}  </td>
                        </tr>
                        <tr>
                            <td colspan="2"> RECOMENDED TOOL/EQUIPMENT </td>
                            <td colspan="2"> ALTERNATE TOOL/EQUIPMENT</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Name
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($recomended_tool->name)) {{ strtoupper($recomended_tool->name) }} @endif
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Name
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($alternate_tool->name)) {{ strtoupper($alternate_tool->name) }} @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Model/Type
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($recomended_tool->model)) {{ strtoupper($recomended_tool->model) }} @endif
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Model/Type
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($alternate_tool->model)) {{ strtoupper($alternate_tool->model) }} @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        P/N
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($recomended_tool->pn))    {{ $recomended_tool->pn }}  @endif
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        P/N
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($alternate_tool->pn)) {{ $alternate_tool->pn }} @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Manufacturer
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($recomended_tool->manufacture)) {{ strtoupper($recomended_tool->manufacture) }}  @endif
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Manufacturer
                                    </div>
                                    <div class="col-xs-9">
                                        @if(!empty($alternate_tool->manufacture)) {{ strtoupper($alternate_tool->manufacture) }} @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                Prepared by : <br>
                                @if($request->user->signature != null)
                                <img src="uploads/users/signature/{{ $request->user->signature  }}" height="100" style="margin-bottom : -20px; margin-top: -30px;">
                                @endif <br>
                                {{ $request->user->name }} / {{ $request->user->id_number }}<br>
                                {{ $request->user->position_name }}
                            </td>
                            <td colspan="2" class="text-center">
                                Approved by : <br>
                                (Signature) <br>
                                Name of qsa <br>
                                position
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Date
                                    </div>
                                    <div class="col-xs-5">
                                        : @if($request->status != 0 )
                                            {{ date('d F Y', strtotime(\App\RequestHistory::where('request_submittion_id', $request->id)->where('status', 1)->orderBy('id','desc')->first()->created_at )) }}
                                          @endif
                                    </div>
                                </div>
                             </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-3">
                                        Date
                                    </div>
                                    <div class="col-xs-5">
                                        :
                                    </div>
                                </div>
                             </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
    @endif

    @if($type === 'lanscape2')
    <table class="fullwidth">
        <tr>
            <td class="text-center">
                <img src="{{ public_path('images/gmf.png') }}" width="200">
            </td>
        </tr>
    </table>
    <table class="table table-bordered mini-line-hight">
        <tr>
            <td colspan="7" class="text-center">EQUIVALENT TOOL/EQUIPMENT ANALYSIS REPORT (CONTINUED)</td>
            <td colspan="4"> No  : {{ $equivalent->equivalent_number }} </td>
        </tr>
        <tr>
            <td colspan="11" class="text-center">MAINTENANCE TASK REFERENCE</td>
        </tr>
        <tr>
            <td colspan="11">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($maintenance_task->ad )) checked @endif > <label for="">  Airworthiness Directives(AD) No. </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($maintenance_task->ad )) {{ strtoupper($maintenance_task->value_ad) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="11">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($maintenance_task->cmm )) checked @endif  > <label for="">  Component Maintenance Manual (CMM)</label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($maintenance_task->cmm )) {{ strtoupper($maintenance_task->value_cmm) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="11">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox"  @if(!empty($maintenance_task->amm )) checked @endif  > <label for="">  Aircraft Maintenance Manual (AMM) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($maintenance_task->amm )) {{ strtoupper($maintenance_task->value_amm) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="11">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($maintenance_task->sb )) checked @endif > <label for="">  Service Bulletin (SB) No. </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($maintenance_task->sb )) {{ strtoupper($maintenance_task->sb) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="11">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($maintenance_task->others )) checked @endif  > <label for="">  Others (Specify) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($maintenance_task->others )) {{ strtoupper($maintenance_task->others) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="text-center">
                RECOMENDED TOOL/EQUIPMENT REFERENCE
            </td>
            <td colspan="5" class="text-center">
                ALTERNATE TOOL/EQUIPMENT REFERENCE
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($recomended->wiring_diagram )) checked @endif  > <label for="">  Wiring Diagram </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($recomended->wiring_diagram )) {{ strtoupper($recomended->wiring_diagram) }} @endif
                    </div>
                </div>
            </td>
            <td colspan="5">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($alternate->wiring_diagram )) checked @endif  > <label for="">  Wiring Diagram </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($alternate->wiring_diagram )) {{ strtoupper($alternate->wiring_diagram) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($recomended->tm )) checked @endif  > <label for=""> Tool/Equipment Manual(TM) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($recomended->tm )) {{ strtoupper($recomended->tm) }} @endif
                    </div>
                </div>
            </td>
            <td colspan="5">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($alternate->tm )) checked @endif  > <label for="">  Tool/Equipment Manual(TM)  </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($alternate->tm )) {{ strtoupper($alternate->tm) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($recomended->ts )) checked @endif  > <label for=""> Tool/Equipment Specification(TS) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($recomended->ts )) {{ strtoupper($recomended->ts) }} @endif
                    </div>
                </div>
            </td>
            <td colspan="5">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($alternate->ts )) checked @endif  > <label for=""> Tool/Equipment Specification(TS) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($alternate->ts )) {{ strtoupper($alternate->ts) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($recomended->amm )) checked @endif  > <label for=""> Aircraft Maintenance Manual </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($recomended->amm )) {{ strtoupper($recomended->amm) }} @endif
                    </div>
                </div>
            </td>
            <td colspan="5">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($alternate->amm )) checked @endif  > <label for="">  Aircraft Maintenance Manual </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($alternate->amm )) {{ strtoupper($alternate->amm) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($recomended->others )) checked @endif  > <label for=""> Other (Specify) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($recomended->others )) {{ strtoupper($recomended->others) }} @endif
                    </div>
                </div>
            </td>
            <td colspan="5">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="checkbox" @if(!empty($alternate->others )) checked @endif  > <label for="">  Other (Specify) </label>
                    </div>
                    <div class="col-xs-5">
                        : @if(!empty($alternate->others )) {{ strtoupper($alternate->others) }} @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="11" class="text-center"> RELATED MAINTENANCE TASK TO BE PERFORMED </td>
        </tr>
        <tr>
            <td colspan="4" class="text-center"> Maintenance Task </td>
            <td colspan="3" class="text-center"> Maintenance Task Vs Recomended Tool/Equipment</td>
            <td colspan="3" class="text-center"> Maintenance Task Vs Alternate Tool/Equipment</td>
            <td rowspan="2" class="text-center"> Compliance </td>
        </tr>
        <tr>
            <td>Ref</td>
            <td>Page/Parag</td>
            <td>Description</td>
            <td style="width:120px;">Acceptable Result</td>
            <td>Ref</td>
            <td>Page/Parag</td>
            <td>Requirements</td>
            <td>Ref</td>
            <td>Page/Parag</td>
            <td>Requirements</td>
        </tr>
        @foreach(json_decode($equivalent->related_maintenance   ) as $rm )
        <tr>
            <td>{{ $rm->ref_maintenance }}</td>
            <td>{{ $rm->page_parag_maintenance }}</td>
            <td>{{ $rm->description_maintenance }}</td>
            <td>{{ $rm->acceptable_maintenance }}</td>
            <td>{{ $rm->ref_recomended }}</td>
            <td>{{ $rm->page_parag_recomended }}</td>
            <td>{{ $rm->requirement_recomended }}</td>
            <td>{{ $rm->ref_alternate }}</td>
            <td>{{ $rm->page_parag_alternate }}</td>
            <td>{{ $rm->requirement_alternate }}</td>
            <td>{{ $rm->compliance }}</td>
        </tr>
        @endForeach
        <tr>
            <td colspan="11"> Note : {{ $equivalent->note }}</td>
        </tr>
    </table>
    @endif

    </body>
</html>
