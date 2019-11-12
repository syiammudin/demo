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
        Hay {{ $data['vendor_name'] }}, you have message from {{ auth::user()->name }}  <br>
        this message : <br>
        "{{ $data['message'] }}"
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
