<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ public_path('pdf.css') }}">
    </head>
    <body style="margin-top:150 px; color : black ;">
        <div id="header">
            <img src="{{ public_path('images/gmf.png') }}" width="200"> <br>
            <span style="font-size:20pt">CAPABILITY LIST</span> <br>
            Document No.: DQ-003 <br>
            <span style="float:left">asdsa</span>Revision : 9 <span style="float:right">asdsa</span> <br>
            <div style="border-top:1px solid"></div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td rowspan="2">No</td>
                <td rowspan="2">Rating</td>
                <td rowspan="2">ATA</td>
                <td rowspan="2">P/N</td>
                <td rowspan="2">Designation</td>
                <td rowspan="2">Manufacture</td>
                <td rowspan="2">Reference of the CMM</td>
                <td colspan="4">Level of Maintenance</td>
                <td rowspan="2">Work Shop</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>
            @php $no = 1  @endphp
            @foreach($data as $d)
            <?php
                $rating = explode('-',$d->value) ;
                $ata = explode('-',$d->ata_chapter) ;
                $capability_level = json_decode($d->capability_level) ;
            ?>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rating[0] }}</td>
                    <td>{{ $ata[0] }}</td>
                    <td>{{ $d->part_number }}</td>
                    <td>{{ $d->component_name }}</td>
                    <td>{{ $d->vendor_manufacture }}</td>
                    <td>{{ $d->ata_chapter }}</td>
                    <td>@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true) X @endif @endif</td>
                    <td>@if(!empty($capability_level->repair)) @if($capability_level->repair == true) X @endif @endif</td>
                    <td>@if(!empty($capability_level->modification)) @if($capability_level->modification == true) X @endif @endif</td>
                    <td>@if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) X @endif @endif</td>
                    <td>{{ $d->workshop }}</td>
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
</style>
