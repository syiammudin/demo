<?php
    $app = \App\App::first() ;
?>
<style>
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
        @if($data->user->role_request == 5)
            Hay,
              @if(auth::user()->role == 2)
                  Manager
              @elseif(auth::user()->role == 3)
                  General Manager
              @elseif(auth::user()->role == 4)
                  QSA Team
              @elseif(auth::user()->role == 5)
                  General Manager QSA
              @endif
            you have data to check for Approve Vendor Management Request <br>
            with name vendor {{ $data->name_vendor }} <br>
            please Login to your App and Approve this document_type <br>
            @component('mail::button', ['url' => url('app/vendor_management') ])
                Click Here to login
            @endcomponent
        @else
            Hy,
            @if(auth::user()->role == 2)
                Manager
            @elseif(auth::user()->role == 3)
                General Manager
            @elseif(auth::user()->role == 4)
                QSA Team
            @elseif(auth::user()->role == 5)
                General Manager QSA
            @endif
            you have data to check for Approve Request {{ $data->MasterRequest->title }} <br>
            with number request {{ $data->request_number }} <br>
            please Login to your App and Approve this Document <br>

            @if($data->master_request_id == 1)
            @component('mail::button', ['url' => url('app/aproval_aircraft') ])
            Click Here to login
            @endcomponent
            @endif
            @if($data->master_request_id == 2)
            @component('mail::button', ['url' => url('app/component_request') ])
            Click Here to login
            @endcomponent
            @endif
            @if($data->master_request_id == 3)
            @component('mail::button', ['url' => url('app/engine_request') ])
            Click Here to login
            @endcomponent
            @endif
            @if($data->master_request_id == 4)
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
