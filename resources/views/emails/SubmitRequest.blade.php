<?php
    $gm = \App\User::where('role_request', auth::user()->role_request)->where('role', 2)->first() ;
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
            GMF AERO ASIA
        @endcomponent
    @endslot
    <div style="font-size:10pt;">
        @if(auth::user()->role_request == 5)
            Hay, {{ $gm->name }}  you have data to check Vendor Management Request <br>
            with name vendor {{ $data->name_vendor }} <br>
            please Login to your App and Check this document_type <br>
            @component('mail::button', ['url' => url('app/vendor_management') ])
                Click Here to login
            @endcomponent
        @else
            Hay, {{ $gm->name }}  you have data to check Request {{ $data->MasterRequest->title }} <br>
            with number request {{ $data->request_number }} <br>
            please Login to your App and Check this document_type <br>

            @if(auth::user()->role_request == 1)
            @component('mail::button', ['url' => url('app/aircraft_request') ])
            Click Here to login
            @endcomponent
            @endif
            @if(auth::user()->role_request == 2)
            @component('mail::button', ['url' => url('app/component_request') ])
            Click Here to login
            @endcomponent
            @endif
            @if(auth::user()->role_request == 3)
            @component('mail::button', ['url' => url('app/engine_request') ])
            Click Here to login
            @endcomponent
            @endif
            @if(auth::user()->role_request == 4)
            @component('mail::button', ['url' => url('app/special_request') ])
            Click Here to login
            @endcomponent
            @endif
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
