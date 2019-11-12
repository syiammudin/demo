@extends('layouts.login_temp_old')

@section('content')

    <div id='app'>
        <vendor vendor_id="{{ $data->id }}" token="{{ $data->token }}" />
    </div>

    <script type="text/javascript">
        const BASE_URL = '{{url("/")}}/';
        const APP_BASE = '{{env('APP_BASE', '/')}}';
    </script>

    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
