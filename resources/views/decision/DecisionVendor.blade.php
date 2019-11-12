@extends('layouts.login_temp_old')

@section('content')

    <div id='app'>
        <decisionvendor id_request="{{ $data['id'] }}" documents="{{ $data['documents'] }}" />
    </div>

    <script type="text/javascript">
        const BASE_URL = '{{url("/")}}/';
        const APP_BASE = '{{env('APP_BASE', '/')}}';
        const ROLE_REQUEST =  '{{ auth::user()->role_request }}' ;
        const ROLE =  '{{ auth::user()->role }}' ;
        const AUTH_LOGIN_ID =  '{{ auth::user()->id }}' ;
    </script>

    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
