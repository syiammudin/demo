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
                $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                $size = 8;
                $font = $fontMetrics->getFont("Arial");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size, array(0.2, 0.2, 0.2));
                $pdf->page_text(20, $y, "Note : 1. Inspection, 2. Repair, 4. Modification, 5. overhauled" , $font, $size, array( 0.2, 0.2, 0.2) );
            }
       </script>
       <?php
        if($type != 'temporary'){
          $rev = \App\CapabilityList::find($data[0]->capability_list_id) ;
        }
       ?>
        <div id="header">
            <img src="{{ public_path('images/gmf.png') }}" width="200"> <br>
            <span style="font-size:15pt">CAPABILITY LIST</span> <br>
            Document No.: DQ-003 <br>
            @if($type != 'temporary')
              Revision : {{ $rev->revision }} <br>
              <span style="float:left; margin-top : -20px;">Issue : {{ $issue[$rev->issue-1]->issue }}</span>
              <span style="float:right; margin-top : -20px;">Date : {{ date('F d, Y', strtotime($rev->created_at) )}}</span> <br>
            @else
              Revision : Temporary <br>
              <span style="float:left; margin-top : -20px;">Issue : Temporary</span>
              <span style="float:right; margin-top : -20px;">Date : {{ date('F d, Y') }}</span> <br>
            @endif
            <div style="border-top:1px solid #463939; margin-top : -15px;"></div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td class="text-center align-middle" rowspan="2">No</td>
                <td class="text-center align-middle" rowspan="2">Rating</td>
                <td class="text-center align-middle" rowspan="2">ATA</td>
                <td class="text-center align-middle" rowspan="2">P/N</td>
                <td class="text-center align-middle" rowspan="2">Designation</td>
                <td class="text-center align-middle" rowspan="2">Manufacture</td>
                <td class="text-center align-middle" rowspan="2">Reference of the CMM</td>
                <td class="text-center align-middle" colspan="4">Level of Maintenance</td>
                <td class="text-center align-middle" rowspan="2">Work Shop</td>
                <td class="text-center align-middle" rowspan="2">A/C Type</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">2</td>
                <td class="text-center">3</td>
                <td class="text-center">4</td>
            </tr>
            @php $no = 1  @endphp
            @foreach($data as $d)
            <?php
                $rating = explode('-',$d->authority_value) ;
                $ata = explode('-',$d->ata_chapter) ;
                $capability_level = json_decode($d->capability_level) ;
            ?>
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $rating[0] }}</td>
                    <td class="text-center">{{ $ata[0] }}</td>
                    <td>{{ $d->part_number }}</td>
                    <td>{{ $d->component_name }}</td>
                    <td>{{ $d->vendor_manufacture }}</td>
                    <td>{{ $d->ata_chapter }}</td>
                    <td class="text-center">@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true) X @endif @endif</td>
                    <td class="text-center">@if(!empty($capability_level->repair)) @if($capability_level->repair == true) X @endif @endif</td>
                    <td class="text-center">@if(!empty($capability_level->modification)) @if($capability_level->modification == true) X @endif @endif</td>
                    <td class="text-center">@if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) X @endif @endif</td>
                    <td>{{ $d->workshop }}</td>
                    <td>{{ str_replace('|',', ', $d->aircraft_type) }}</td>
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

.table{
    font-size: 8pt !important ;
}
.table td {
    padding-top : 2px !important ;
    padding-bottom : 2px !important ;
}
.align-middle{
    vertical-align: middle !important;
}
</style>
