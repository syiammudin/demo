<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ public_path('pdf.css') }}">
    </head>
    <body style="margin-top:80px; color : #463939 ;">
        <script type="text/php">
            if (isset($pdf)) {
                @if($data->type_supplier == 'Calibration')
                    $text = "Page D{PAGE_NUM} of D{PAGE_COUNT}";
                @endif
                @if($data->type_supplier == 'Maintenance Function')
                    $text = "Page C{PAGE_NUM} of C{PAGE_COUNT}";
                @endif
                @if($data->type_supplier == 'Repair Station')
                    $text = "Page A{PAGE_NUM} of A{PAGE_COUNT}";
                @endif
                @if($data->type_supplier == 'Material Supplier')
                    $text = "Page B{PAGE_NUM} of B{PAGE_COUNT}";
                @endif

                $size = 8;
                $font = $fontMetrics->getFont("Arial");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 1.6;
                $x = ($pdf->get_width() - $width);
                $y = 40;
                $pdf->page_text($x, $y, $text, $font, $size, array(0.2, 0.2, 0.2) );
            }
        </script>
        <div id="header-img">
            <img src="{{ public_path('images/gmf.png') }}" width="200">
        </div>
        <div id="header" class="text-right">
            @if($data->type_supplier == 'Calibration')
            <span class="header">CALIBRATION SUPPRLIER LIST</span>
            @endif
            @if($data->type_supplier == 'Maintenance Function')
            <span class="header">MAINTENANCE FUNCTION LIST</span>
            @endif
            @if($data->type_supplier == 'Repair Station')
            <span class="header">REPAIR STATION SUPPRLIER LIST</span>
            @endif
            @if($data->type_supplier == 'Material Supplier')
            <span class="header">SUPPRLIER LIST</span>
            @endif
            <br>
            <br>
            <div class="header-text">
                Issue {{ $issue[$data->issue-1]->issue }} Rev {{ $data->revision }}
            </div>
            <div class="header-text">
                Date : {{ $data->created_at }}
            </div>
        </div>
        <div id="footer">
            @if($data->type_supplier == 'Maintenance Function')
                @php $no = 1 @endphp
                @foreach(\App\MainFn::get() as $mn)
                    {{ $mn->label }}
                    @if(\App\MainFn::count() != $no++)
                    ,
                    @endif
                @endForeach
            @endif
            <span class="right">Printed Date : {{ $data->created_at }}</span>
        </div>

        <table class="table table-sm font9">
            <thead>
                <tr>
                    <td class="withborder text-center">No</td>
                    <td class="withborder text-center">Supplier Name</td>
                    <td class="withborder text-center">Supplier Code</td>
                    @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Repair Station')
                        <td class="withborder text-center">DGCA</td>
                    @endif
                    @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Repair Station')
                        <td class="withborder text-center">FAA</td>
                    @endif
                    @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Repair Station')
                        <td class="withborder text-center">EASA</td>
                    @endif
                    @if($data->type_supplier == 'Maintenance Function')
                        <td class="withborder text-center">NC</td>
                    @endif
                    @if($data->type_supplier == 'Calibration')
                        <td class="withborder text-center">KAN</td>
                    @endif
                    @if($data->type_supplier == 'Material Supplier')
                        <td class="withborder text-center">ASA</td>
                    @endif
                    @if($data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Calibration')
                        <td class="withborder text-center">ISO</td>
                    @endif
                    @if($data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Calibration')
                        <td class="withborder text-center">OTHER</td>
                    @endif
                    <td class="withborder text-center">Last Update</td>
                    @if($data->type_supplier == 'Maintenance Function')
                    <td class="withborder text-center">Main Fn</td>
                    @endif
                    <td class="withborder text-center">Product Service</td>
                </tr>
            </thead>
            @php $no = 1 ; @endphp
            @foreach($data->VendorCapablityListDetail as $d)
            <tr>
                <td class="noborder text-center">{{ $no++ }}</td>
                <td class="noborder">{{ $d->supplier_name }} <br> {{ $d->address }}</td>
                <td class="noborder">{{ $d->vendor_code }} </td>
                @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Repair Station')
                    <td class="noborder text-center"><input type="checkbox" @if($d->dgca == 1) checked @endif> </td>
                @endif
                @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Repair Station')
                    <td class="noborder text-center"><input type="checkbox" @if($d->faa == 1) checked @endif> </td>
                    <td class="noborder text-center"><input type="checkbox" @if($d->easa == 1) checked @endif> </td>
                @endif
                @if($data->type_supplier == 'Maintenance Function')
                    <td class="noborder text-center"><input type="checkbox" @if($d->dgca == null && $d->faa == null && $d->easa == null) checked @endif> </td>
                @endif
                @if($data->type_supplier == 'Calibration')
                    <td class="noborder text-center"><input type="checkbox" @if($d->kan == 1) checked @endif> </td>
                @endif
                @if($data->type_supplier == 'Material Supplier')
                    <td class="noborder text-center"><input type="checkbox" @if($d->asa == 1) checked @endif> </td>
                @endif
                @if($data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Calibration')
                    <td class="noborder text-center"><input type="checkbox" @if($d->iso == 1) checked @endif> </td>
                    <td class="noborder text-center"><input type="checkbox" @if($d->other == 1) checked @endif> </td>
                @endif
                <td class="noborder">{{ date('d M Y', strtotime($d->last_update)) }}</td>
                @if($data->type_supplier == 'Maintenance Function')
                <td class="noborder">
                    <?php
                        $mf = explode(',', $d->maint_fn) ;
                        foreach ($mf as $maint) {
                            $m = explode('-', $maint) ;
                            echo $m[0] ;
                        }
                    ?>
                </td>
                @endif
                <td class="noborder">{{ $d->product_service}} </td>
            </tr>
            <tr>
                <td  class="noborder"></td>
                <td  class="noborder">{{ $d->email }}</td>
                <td  class="noborder" colspan="7" style="font-size:6pt;">
                    @php $doc_evidence = json_decode($d->document_evidence) @endphp

                    @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Repair Station')
                        @if(!empty($doc_evidence->DGCA)) @if($doc_evidence->DGCA == true) DGCA @endif @endif
                        @if(!empty($doc_evidence->dgca_no_certificate)) {{ $doc_evidence->dgca_no_certificate }}, @endif
                        @if(!empty($doc_evidence->dgca_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->dgca_exp_date )) }}, @endif
                    @endif

                    @if($data->type_supplier == 'Maintenance Function' || $data->type_supplier == 'Repair Station')
                        @if(!empty($doc_evidence->FAA)) @if($doc_evidence->FAA == true) FAA @endif @endif
                        @if(!empty($doc_evidence->faa_no_certificate)) {{ $doc_evidence->faa_no_certificate }}, @endif
                        @if(!empty($doc_evidence->faa_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->faa_exp_date )) }}, @endif

                        @if(!empty($doc_evidence->EASA)) @if($doc_evidence->EASA == true) EASA @endif @endif
                        @if(!empty($doc_evidence->easa_no_certificate)) {{ $doc_evidence->easa_no_certificate }}, @endif
                        @if(!empty($rating->easa_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->easa_exp_date )) }}, @endif
                    @endif

                    @if($data->type_supplier == 'Maintenance Function')
                        @if(!empty($doc_evidence->NC)) @if($doc_evidence->NC == true) NC @endif @endif
                        @if(!empty($doc_evidence->nc_no_certificate)) {{ $doc_evidence->nc_no_certificate }}, @endif
                        @if(!empty($doc_evidence->nc_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->nc_exp_date )) }}, @endif
                    @endif

                    @if($data->type_supplier == 'Calibration')
                        @if(!empty($doc_evidence->KAN)) @if($doc_evidence->KAN == true) KAN @endif @endif
                        @if(!empty($doc_evidence->kan_no_certificate)) {{ $doc_evidence->kan_no_certificate }}, @endif
                        @if(!empty($rating->kan_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->kan_exp_date )) }}, @endif
                    @endif

                    @if($data->type_supplier == 'Material Supplier')
                        @if(!empty($doc_evidence->ASA)) @if($doc_evidence->ASA == true) ASA @endif @endif
                        @if(!empty($doc_evidence->asa_no_certificate)) {{ $doc_evidence->asa_no_certificate }}, @endif
                        @if(!empty($doc_evidence->asa_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->asa_exp_date )) }}, @endif
                    @endif

                    @if($data->type_supplier == 'Material Supplier' || $data->type_supplier == 'Calibration')
                        @if(!empty($doc_evidence->ISO)) @if($doc_evidence->ISO == true) ISO @endif @endif
                        @if(!empty($doc_evidence->iso_no_certificate)) {{ $doc_evidence->iso_no_certificate }}, @endif
                        @if(!empty($doc_evidence->iso_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->iso_exp_date )) }}, @endif

                        @if(!empty($doc_evidence->Other)) @if($doc_evidence->Other == true) Other @endif @endif
                        @if(!empty($doc_evidence->other_no_certificate)) {{ $doc_evidence->other_no_certificate }}, @endif
                        @if(!empty($doc_evidence->other_exp_date))Exp. Date {{ date('d M Y', strtotime($doc_evidence->other_exp_date )) }}, @endif
                    @endif

                        Questionare Exp. Date {{ date('d M Y', strtotime($d->questionnaire_exp_date )) }}
                </td>
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
    font-family: "Myriad" ;
    font-size : 10pt;
    position: fixed;
    top: -20px;
    width: 100%;
    text-align: right;
    margin-right: 4px;
    transform-origin: 50% 50%;
    z-index: -1000;
}

#header-img {
    font-family: "Myriad" ;
    font-size : 10pt;
    position: fixed;
    top: -20px;
    width: 100%;
    text-align: left;
    margin-left: 10px;
    transform-origin: 50% 50%;
    z-index: -1000;
}

.header{
    font-family: "Arial-Bold-Italic" !important;
    /* font-weight: bold ;
    font-style: italic !important; */
}

</style>
