<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QAPPS GMF AEROASIA</title>
    <link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
    <link href="{{ asset('theme/css/entypo.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/css3-animate-it-plugin/animations.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/mouldifi-core.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/mouldifi-forms.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style media="screen">
        /* @font-face {
        font-family: 'Segoe UI';
        font-style: normal;
        font-weight: normal;
        src: local('Segoe UI'), url("{{ asset('segoeui.woff') }}") format('woff');
        } */

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            font-family: Arial;
            margin: 0 0 15px;
        }
        .el-pagination.is-background .el-pager li:not(.disabled).active {
            background-color : #006298 ;
        }
    </style>
</head>
<body style="font-family:Arial">

    @yield('content')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script type="text/javascript">
        const BASE_URL = '{{url("/")}}/';
        const APP_BASE = '{{env('APP_BASE', '/')}}';
        const AUTH_LOGIN_ID =  {{ auth::user()->id }} ;
        const ROLE_REQUEST =  '{{ auth::user()->role_request }}' ;
        const ROLE = '{{ auth::user()->role }}' ;
        const AUTH_LOGIN_NAME =  '{{ auth::user()->name }}' ;
        const AUTH_LOGIN_ID_NUMBER =  '{{ auth::user()->id_number }}' ;
        const COMPONENT_TYPE =  '{{ auth::user()->component_type }}' ;
    </script>

    <script src="{{ asset('js/app.js') }}" ></script>
    <!-- <script src="{{ asset('theme/js/plugins/css3-animate-it-plugin/css3-animate-it.js')}}"></script> -->
    <!-- <script src="{{ asset('theme/js/bootstrap.min.js')}}"></script> -->
    <script src="{{ asset('theme/js/plugins/metismenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('theme/js/plugins/blockui-master/jquery-ui.js')}}"></script>
    <script src="{{ asset('theme/js/plugins/blockui-master/jquery.blockUI.js')}}"></script>
    <script src="{{ asset('theme/js/functions.js')}}"></script>

    <?php
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ?>


</body>
</html>
