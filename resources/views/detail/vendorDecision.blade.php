<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Vendor Management {{ date('d F Y')  }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">
    </head>
    <body>
        <?php
            $decision = json_decode($vendor->decision ) ;
            // echo $decision ;
         ?>

         <script type="text/php">
             if (isset($pdf)) {
                 $text = "{PAGE_NUM} of {PAGE_COUNT}" ;
                 $size = 7;
                 $font = $fontMetrics->getFont("Myriad");
                 $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                 $x = ($pdf->get_width() - $width);
                 $y = $pdf->get_height() - 35;
                 $pdf->page_text(20, $y, "Form No. GMF/Q-040 R2" , $font, $size );
             }
         </script>
        <table class="fullwidth">
            <tr>
                <td class="text-center"><img src="{{ public_path('images/gmf.png') }}" width="200"></td>
            </tr>
            <tr>
                <td class="text-center">VENDOR APPROVAL QUESTIONARE EVALUATION SHEET</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <table class="fullwidth">
            <tr>
                <td style="width:15%">Vendor Name</td>
                <td style="width:2%">:</td>
                <td style="width:60%">{{ ucwords($vendor->vendor_name)}}</td>
                <td style="width:8%">Date</td>
                <td  style="width:15%"> : {{ date('d M Y') }}</td>
            </tr>
            <tr>
                <td style="width:15%">Address</td>
                <td style="width:2%">:</td>
                <td colspan="3">{{ ucwords($vendor->vendor_address).", ". $vendor->vendor_city ." ". $vendor->vendor_state }}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Item</th>
                    <th>Max Score</th>
                    <th>Score</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1 ;
                    $count =  count($decision) ;
                @endphp
                @foreach($decision as $d)
                <tr>
                    <td>{{ $no}}</td>
                    <td>{{ $d->question }}</td>
                    <td>{{ $d->max_score }}</td>
                    <td>{{ $d->score }}</td>
                    @if($no++ == 1)
                    <td rowspan="{{ $count }}" style="text-align: center; vertical-align : middle;"> Pass With Score {{ $vendor->score }}</td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <td style="border-bottom:1px solid white; border-left: 1px solid white; border-right: 1px solid white; " colspan="2"></td>
                    <td style="border-bottom:1px solid white; border-right: 1px solid white;">Total Score </td>
                    <td style="border-bottom:1px solid white; border-left: 1px solid white; border-right: 1px solid white; " colspan="2">{{ $vendor->score }}</td>
                </tr>
            </tbody>
        </table>
            <br>
            <br>
        <table class="fullwidth">
            <tr>
                <td class="text-center">Accepted by </td>
                <td class="text-center">Evaluated by</td>
            </tr>
            <tr>
                <td class="text-center">
                    <br>
                    @if($vendor->status == 5 )
                      @if(\App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->user->signature  != null)
                        <img src="uploads/users/signature/{{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->user->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                      @endif
                    @endif
                    <br>
                    <br>
                </td>
                <td class="text-center">
                    <br>
                    @if($vendor->status == 5 )
                        @if(\App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 4)->orderBy('id','desc')->first()->user->signature  != null)
                          <img src="uploads/users/signature/{{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 4)->orderBy('id','desc')->first()->user->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                        @endif
                    @endif
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    @if($vendor->status == 5 )
                        {{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->name }}
                    @endif
                </td>
                <td class="text-center">
                    @if($vendor->status == 5 )
                        {{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 4)->orderBy('id','desc')->first()->name }}
                    @endif
                </td>
            </tr>
        </table>
    </body>
</html>
<style media="screen">
.table{
    line-height: 15px !important;
}

body{
    line-height: 15px;
}
.border-list-customer{
    border-bottom: 1px solid #DDD ;
}

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

</style>
