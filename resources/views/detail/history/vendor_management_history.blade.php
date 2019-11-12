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
            $vendor = json_decode(json_encode($vendor)) ;
            $type_busines = json_decode($vendor->type_bussines, true) ;
            $document_evidence = json_decode($vendor->document_evidence, true) ;

            $data =  json_decode(json_encode($vendor->vendor_management_history),true);
            $history = end($data);
        ?>
        <table class="table table-bordered table-xs">
            <tr>
                <td><img src="{{ public_path('images/gmf.png') }}" width="200"></td>
                <td colspan="3" class="text-center" style="font-family: Myriad;font-size:14pt; ">CANDIDATE VENDOR QUALITY <br> EVALUATION REQUEST </td>
            </tr>
            <tr>
                <td colspan="3" >
                    TO :  QUALITY SYSTEM & AUDITING
                </td>
                <td>
                    DATE : {{ date('d-m-Y', strtotime($vendor->created_at)) }}
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    FROM : <br>
                    {{ $vendor->from }}
                </td>
                <td>
                    DEPT : <br>
                    {{ $vendor->dept }}

                </td>
                <td>
                    PHONE : <br>
                    {{ $vendor->phone }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:250px;" >
                    VENDOR NAME, ADDRESS, PHONE: <br>
                    {{ $vendor->vendor_name }} <br>
                    {{ $vendor->vendor_address }} <br>
                    {{ ucwords($vendor->vendor_city) }} - {{ ucwords($vendor->vendor_state) }} <br>
                    TELP {{ $vendor->vendor_phone }} <br>
                    FAX {{ $vendor->vendor_fax }}
                </td>
                <td colspan="2" style="width:250px">PARENT COMPANY (If Applicable) <br> {{ $vendor->parent_company }}</td>
            </tr>
            <tr>
                <td colspan="2">CONTACT <br> {{ $vendor->contact_name }} <br> {{ $vendor->contact_email }}</td>
                <td> TITLE <br> {{ $vendor->contact_title }} </td>
                <td> SUPPLIER CODE No.: <br> {{ $vendor->supplier_code }} </td>
            </tr>
            <tr>
                <td colspan="4">
                    ITEM PROPOSED FROM PROCUREMENT FROM THE SOURCE: <br>
                    {{ $vendor->item_proposed }}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    APPLICABLE DRAWINGS AND/OR SPECIFICATIONS: <br>
                    {{  $vendor->aplication_drawing }}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    TYPE OF SUPPLIER & COMMENTS:
                    {{ $vendor->type_supplier }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    SIGNATURE  :
                    <span style="float:right">
                        @if($vendor->status != 0)
                            {{ date('d-m-Y', strtotime(\App\VendorManagementHistory::where('vendor_management_id', $vendor->id)->where('status', 1)->orderBy('id','desc')->first()->created_at))  }}
                        @endif <br>
                    </span>

                        <center>
                              @if($vendor->status != 0 && $vendor->user->signature != null  )
                              <img src="uploads/users/signature/{{ $vendor->user->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                              @endif
                              <br>
                              {{ $vendor->user->name }}
                        </center>
                </td>
                <td colspan="2">
                    @if($history['status'] == 4)
                        REJECTED BY  :
                        <span style="float:right">
                            {{ date('d-m-Y', strtotime($history['created_at'] ))  }}
                            <br>
                        </span>

                        <center>
                            <img src="uploads/users/signature/{{ $history['user']['signature']  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                            <br>
                            {{ $history['name'] }}
                        </center>
                    @else
                        APPROVED BY  :
                        <span style="float:right">
                            @if($vendor->status == 3)
                            {{ date('d-m-Y', strtotime(\App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->created_at ))  }}
                            @endif
                            <br>
                        </span>

                        <center>
                            @if($vendor->status == 3 )
                            <img src="uploads/users/signature/{{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->user->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                            <br>
                            {{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->name }}
                            @endif
                        </center>

                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    QUALITY SYSTEM & AUDITING ACKNOWLEDGMENT
                </td>
            </tr>
            <tr>
                <td colspan="4"> <input type="checkbox" @if($vendor->status == 4) checked @endif >  REQUEST DENIED. REASON:  @if($vendor->status == 4) {{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 4)->orderBy('id','desc')->first()->note }} @endif</td>
            </tr>
            <tr>
                <td colspan="2">
                    ON SITE AUDIT SCHEDULED FOR :
                </td>
                <td colspan="2">
                    @if($history['status'] == '4')
                        REJECTED BY & DATE :
                        {{ date('d-m-Y', strtotime($history['created_at'] ))  }}
                        <br>
                        <center>
                            <img src="uploads/users/signature/{{ $history['user']['signature']  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                            <br>
                            {{ $history['name'] }}
                        </center>
                    @else
                        APPROVED BY & DATE :
                        @if($vendor->status == 3)
                        {{ date('d-m-Y', strtotime(\App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->created_at ))  }}
                        @endif<br>
                        <center>
                            @if($vendor->status == 3 )
                            <img src="uploads/users/signature/{{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->user->signature  }}" height="100" style="margin-bottom : -50px; margin-top: -50px;">
                            <br>
                            {{ \App\VendorManagementHistory::where('vendor_management_id', $vendor->id )->where('status', 3)->orderBy('id','desc')->first()->name }}
                            @endif
                        </center>

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
