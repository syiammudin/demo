<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ storage_path('pdf.css') }}">
  </head>
  <body>
      <br>
      <br>
      <br>
      <br>
      <table class="fullwidth text-center">
          <tr>
              <td ><img src="{{ public_path('images/gmf.png') }}" width="200"></td>
          </tr>
          <tr>
              <td> <br> <u>WORKSHOP CAPABILITY DEVELOPMENT</u> </td>
          </tr>
      </table>
                  <br>
                  <br>
      <table class="field">
        <tr>
          <td style="width:200px">PART NAME</td>
          <td style="width:10px;">:</td>
          <td>{{ strtoupper($request->ComponentRequest->component_name) }}</td>
        </tr>
        <tr>
          <td valign="top">PART NUMBER</td>
          <td valign="top" style="width:10px;">:</td>
          <td>{{ str_replace('|',', ', $request->ComponentRequest->part_number) }}
            @if($request->ComponentRequest->part_number_new != null), {{ str_replace('|',', ', $request->ComponentRequest->part_number_new) }} @endif
          </td>
        </tr>
        <tr>
          <td>MANUFACTURER</td>
          <td style="width:10px;">:</td>
          <td>{{ strtoupper($request->ComponentRequest->vendor_manufacturer) }}</td>
        </tr>
        <tr>
          <td>ATA CHAPTER</td>
          <td style="width:10px;">:</td>
          <td>{{ $request->ComponentRequest->ata_chapter }}</td>
        </tr>
        <tr>
          <td valign="top" >AIRCRAFT</td>
          <td valign="top" style="width:10px;">:</td>
          <td>{{ str_replace('|',', ', $request->ComponentRequest->aircraft_type) }}</td>
        </tr>
        <tr>
          <td>WORKSHOP</td>
          <td style="width:10px;">:</td>
          <td>{{ strtoupper($request->ComponentRequest->workshop) }}</td>
        </tr>

      </table>

      <div class="page_break"></div>
      <br>
      <br>
      <br>
      <br>
      <table class="fullwidth text-center">
          <tr>
              <td><img src="{{ public_path('images/gmf.png') }}" width="200"></td>
          </tr>
          <tr>
              <td>CAPABILITY LIST SHEET REQUEST</td>
          </tr>
      </table>
      <br>
      <br>
      <table class="field">
          <tr>
            <td style="width:200px">PART NAME</td>
            <td style="width:10px;">:</td>
            <td>{{ strtoupper($request->ComponentRequest->component_name) }}</td>
          </tr>
          <tr>
            <td valign="top">PART NUMBER</td>
            <td valign="top" style="width:10px;">:</td>
            <td>{{  str_replace('|',', ', $request->ComponentRequest->part_number) }}
                @if($request->ComponentRequest->part_number_new != null), {{ str_replace('|',', ', $request->ComponentRequest->part_number_new) }} @endif
            </td>
          </tr>
      </table>
    <br>
      <table class="field">
        <tr>
          <td></td>
          <td class="text-center" style="width:30px;">A</td>
          <td class="text-center" style="width:30px;">N/A</td>
        </tr>
          <tr>
            <td>CAPABILITY LIST EVALUATION SHEET REQUEST</td>
            <td class="text-center">  <input type="checkbox" checked class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" class="big-checkbox"> </td>
          </tr>
          <tr>
            <td>SHOP ABILITY</td>
            <td class="text-center">  <input type="checkbox" checked class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" class="big-checkbox"></td>
          </tr>
          <tr>
            <!-- documen manual-->
            <?php
                $documentManual = array_filter($request->ComponentDocument->toArray(), function($manual) {
                                        return $manual['document_type'] == 'Maintenance Manual' ;
                                  }) ;
                $documentInstruction = array_filter($request->ComponentDocument->toArray(), function($manual) {
                                        return $manual['document_type'] == 'Maintenance Instruction' ;
                                  }) ;
             ?>
            <td>COMPONENT MAINTENANCE MANUAL  </td>
            <td class="text-center">  <input type="checkbox" @if(count($documentManual) != 0) checked @endif class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" @if(count($documentManual) == 0) checked @endif class="big-checkbox"></td>
          </tr>
          <tr>
            <!-- maintenance instruction -->
            <td>PLANNING DATA SHEET </td>
            <td class="text-center">  <input type="checkbox" @if(count($documentInstruction) != 0) checked @endif class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" @if(count($documentInstruction) == 0) checked @endif class="big-checkbox"></td>
          </tr>
          <tr>
            <td>EQUIPMENT TOOLS/EQUIPMENT ANALYSIS REPORT</td>
            <td class="text-center">  <input type="checkbox" @if($request->ComponentTestEquipment != null) checked  @endif class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" @if($request->ComponentTestEquipment == null) checked  @endif class="big-checkbox"></td>
          </tr>
          <tr>
            <td>PERSONAL ABILITY LIST</td>
            <td class="text-center">  <input @if($request->ComponentPersonel != null) checked  @endif type="checkbox" class="big-checkbox"> </td>
            <td class="text-center">  <input @if($request->ComponentPersonel == null) checked  @endif type="checkbox" class="big-checkbox"></td>
          </tr>
          <tr>
            <td>OTHER REFERENCE</td>
            <td class="text-center">  <input type="checkbox" @if($request->ComponentAttachment != null) checked  @endif class="big-checkbox"> </td>
            <td class="text-center">  <input type="checkbox" @if($request->ComponentAttachment == null) checked  @endif class="big-checkbox"></td>
          </tr>
      </table>
      <br>
      <br>
      <br>
      <br>
      <table class="field">
          <tr>
            <td>
              <table>
                <tr>
                  <td colspan="2">NOTE :</td>
                </tr>
                <tr>
                  <td>A</td>
                  <td> : AVAILBILE</td>
                </tr>
                <tr>
                  <td>N/A</td>
                  <td> : NOT AVAILABLE</td>
                </tr>
              </table>

            </td>
          </tr>
      </table>
  </body>
</html>


<style media="screen">
#watermark {
    font-family: Myriad ;
    font-size : 36pt;
    position: fixed;
    top: 45%;
    width: 50%;
    text-align: center;
    opacity: .6;
    transform: rotate(-30deg);
    transform-origin: 50% 50%;
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

.width {
  width: 20px;
}
.isi-table th{
    background: grey ;
    color:white ;
    text-align: center ;
    v-align : middle ;
}
.distribution {
    padding-left: 20px; padding-top:10px;
}

.distribution-border{
    border-left: 1px solid #ddd ; padding: 10px; height: 27px;
}

.mini-line-hight{
    line-height: 10px !important;
}
.mini-line-hight-2{
    line-height: 110px !important;
}

.field{
  width: 80% ;
  margin :auto ;
}

.field td {
  padding-top : 5px;
  padding-bottom : 5px;

}
body{
  background: cyan;
}

body, table  {
    font-size: 12pt;

}

.big-checkbox{
  font-size: 24px;
  margin-left: 5px!important;
  /* margin: auto ; */
}

.firstPage{
   font-size: 11pt !important ;
}

@page{margin: 0.1in 0.1in 0.1in 0.1in;}
</style>
