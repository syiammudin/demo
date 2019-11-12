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
        @if(auth::user()->role_request == 5)
            @if($data->status == 2)
                Hay, {{ $data->User->name }} your Request to vendor {{ $data->vendor_name }} Already Checked by {{ auth::user()->name }}
                @endif
            @if($data->status == 3)
                Hay, {{ $data->User->name }} your Request to vendor {{ $data->vendor_name }} Already Approve by {{ auth::user()->name }}
            @endif
            @if($data->status == 4)
                Hay, {{ $data->User->name }} your Request to vendor {{ $data->vendor_name }} has Rejected by {{ auth::user()->name }} <br>
                Note Rejected : {{ \App\VendorManagementHistory::where('vendor_management_id', $data->id)->where('status',4)->orderBy('id', 'desc')->first()->note }}
            @endif
        @else
            @if($data->status == 2)
                Hay, {{ $data->User->name }} your Request with number {{ $data->request_number }} Already Checked by {{ auth::user()->name }}
                @endif
            @if($data->status == 3)
                Hay, {{ $data->user->name }} your Request with number {{ $data->request_number }} Already Approve by {{ auth::user()->name }}
            @endif
            @if($data->status == 4)
                Hay, {{ $data->user->name }} your Request with number {{ $data->request_number }} Rejected by {{ auth::user()->name }} <br>
                Note Rejected : {{ \App\RequestHistory::where('request_submittion_id', $data->id)->where('status',4)->orderBy('id', 'desc')->first()->note }}
            @endif

        @endif

        @component('mail::button', ['url' => url('app') ])
        Click Here to login
        @endcomponent
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
