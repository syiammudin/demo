<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ public_path('pdf.css') }}">
    </head>
    <body style="margin-top:150 px; color : #463939 ;">
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Page {PAGE_NUM}";
                $size = 10;
                $font = $fontMetrics->getFont("Arial");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size, array(0.2, 0.2, 0.2) );
            }
       </script>
         <?php
          if($type != 'temporary'){
            $rev = \App\CapabilityList::find($data[0]->capability_list_id) ;
          }
         ?>
        <div id="header">
            <img src="{{ public_path('images/gmf.png') }}" width="200"> <br>
            <span style="font-size:20pt">CAPABILITY LIST</span> <br>
            Document No.: DQ-003 <br>
            @if($type != 'temporary')
              <span style="float:left">Date : {{ date('F, d Y', strtotime($rev->created_at)) }}</span> CAAC Certificate No: F06200762
              <span style="float:right">Revision : {{ $rev->revision }}</span> <br>
            @else
              <span style="float:left">Date : {{ date('F, d Y') }}</span> CAAC Certificate No: F06200762
              <span style="float:right">Revision : Temporary</span> <br>
            @endif
            <div style="border-top:1px solid"></div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td>No</td>
                <td>Part Number</td>
                <td>Part Name</td>
                <td>Ata</td>
                <td>Manufacturer</td>
                <td>Level of Maintenance</td>
                <td>Technical Data</td>
                <td>Major Equipment</td>
                <td>A/C Type</td>
            </tr>
            @php $no = 1  @endphp
            @foreach($data as $d)
            <?php
                $capability_level = json_decode($d->capability_level) ;
            ?>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->part_number }}</td>
                    <td>{{ $d->component_name }}</td>
                    <td>{{ $d->ata_chapter }}</td>
                    <td>{{ $d->vendor_manufacture }}</td>
                    <td>@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true)  Inspection/Test, @endif @endif
                        @if(!empty($capability_level->repair)) @if($capability_level->repair == true) Repair, @endif @endif
                        @if(!empty($capability_level->modification)) @if($capability_level->modification == true) Modification, @endif @endif
                        @if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) Overhaul, @endif @endif</td>
                    <td>{{ $d->technical_data }}</td>
                    <td>{{ $d->major_equipment }}</td>
                    <td>{{ implode(', ',explode('|', $d->aircraft_type)) }}</td>
                </tr>
            @endForeach
        </table>
    </body>
</html>
<style media="screen">
input[type=checkbox] { display: inline; }
.fix{
    padding : 0px !important ;
    margin : 0px !important ;
}
.noborder{
    border-top : 0px solid white !important ;
}
.withborder{
    border-bottom : 1px solid grey !important ;
}
.left{
    float: left ;
}
.right{
    float : right;
}

.font10{
    font-size: 10pt
}
.font9{
    font-size: 9pt
}
.font8{
    font-size: 8pt
}

.header-text {
    font-size : 8pt;
}

#footer {
    position: fixed; bottom: 10px; border-top: 1px solid; font-size: 8pt
}

p { page-break-after: always; }
.pagenum:before { content: counter(page) "/" counter(pages); }

#header {
    font-family: "Arial" ;
    font-size : 10pt;
    position: fixed;
    width: 100%;
    text-align: center  ;
    transform-origin: 50% 50%;
    z-index: -1000;
}
.header{
    font-family: "Arial-Bold-Italic" !important;
    /* font-weight: bold ;
    font-style: italic !important; */
}
.fullwidth{
    width: 100% ;
}
.table td {
    padding-top : 2px !important ;
    padding-bottom : 2px !important ;
}
.table{
    font-size: 8pt !important ;
}
</style>
