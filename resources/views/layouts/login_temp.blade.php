<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php $app = \App\App::first() ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QAPPS GMF AEROASIA</title>
    <link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
    <link href="{{ asset('theme/css/entypo.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/css3-animate-it-plugin/animations.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/mouldifi-core.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/mouldifi-forms.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style media="screen">
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            background-image: url("{{ asset('/uploads/WebConfig/'.$app->background )}}") !important;
            width: 100% ;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .transparent{
            background: rgba(255, 255, 255, 0.6);
        }

        .text{
            opacity : 1 ;
        }
    </style>
</head>
<body class="login-page bg">
<!-- <div class="page-container"> -->
        @yield('content')
<!-- </div> -->
<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<script src="{{ asset('theme/js/jquery.min.js')}}"></script>
<!-- Load CSS3 Animate It Plugin JS -->
<script src="{{ asset('theme/js/plugins/css3-animate-it-plugin/css3-animate-it.js')}}"></script>
<script src="{{ asset('theme/js/bootstrap.min.js')}}"></script>
</body>
</html>
