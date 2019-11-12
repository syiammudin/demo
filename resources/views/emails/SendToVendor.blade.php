<?php
    $app = \App\App::first() ;
?>
<style >
element.style {
    font-size : 8pt;
}
</style>
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $app->app_name }}
        @endcomponent
    @endslot
    <div style="font-size:10pt;">
        @if($vendor->attachment != null)
            Hy, {{ $vendor->User->name }} , <br>
            Document from  {{ $vendor->contact_name }} Already upload on website,  please check this document
            @component('mail::button', ['url' => url('app/form_vendor_management/'.$vendor->id) ])
            Click Here to Check
            @endcomponent
        @else
            Haloo, {{ $vendor->contact_name }} <br>
            Please Attach your document to our Aplication, <br>
            this link to attach document

            @component('mail::button', ['url' => url("vendor_attach/".$encript = base64_encode(base64_encode(base64_encode($vendor->id)))."/".$vendor->token) ])
            Click Here
            @endcomponent
        @endif


    </div>

    {{-- Subcopy --}}
    @slot('subcopy')
    @component('mail::subcopy')
    @endcomponent
    <h3>{{ $app->app_name }}</h3>
    <div style="font-size:8pt;">
        {{ $app->street }} <br>
        {{ $app->city }} - {{ $app->country }} - {{ $app->zip_code }}  <br>
        Po. Box {{ $app->po_box }} <br>
        Phone {{ $app->phone }}, Fax {{ $app->fax }}, Email {{ $app->email }}
    </div>
    @endslot

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            Copyright@gmf-aeroasia
        @endcomponent
    @endslot
@endcomponent
