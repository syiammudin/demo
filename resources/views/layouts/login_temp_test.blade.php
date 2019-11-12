<!doctype html>
<?php $app = \App\App::first() ?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>LOGIN </title>
  <link rel="stylesheet" href="{{ asset('gmf_theme/css/login/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('gmf_theme/css/login/GMF.min.css')}}">
</head>

<body >
<section>
  <div class="container container-gmf">

  <div class="row row-gmf">
  <div class="col-md-9 col-sm-9 col-xs-9" >
    <a href="#" class="brand-logo"><img class="img img-responsive img-logo" style="margin-top: 25px; position: absolute;z-index:3;margin-left:45px;" src="{{ asset('gmf_theme/img/login/logo_fix.png')}}" width="300px"></a>
    <div class="frontText" style="   z-index: 2; position: absolute;color:white;padding-top: 200px;padding-left:121px;">
      <h3>Hi, welcome to</h3>
      <h1>Q-Apps Qapability & Vendor Management</h1>
      <hr style="border:4px solid white;width:45px;margin-left:0px;margin-top:30px !important">
      <span class="textUnder">{{ $app->street }} {{ $app->city }} {{ $app->country }} - Zip Code :  {{ $app->zip_code }} </span>   <br>
      <span><i>Phone {{ $app->phone }}, Fax : {{ $app->fax }}, Email : {{ $app->email }}</i></span>
    </div>
    <img src="{{ asset('/uploads/WebConfig/'.$app->background )}}" class="img img-responsive img-lf" style="width:100%;">
  </div>

        @yield('content')

  </div>
  </div>
</section>

  <script src="{{ asset('gmf_theme/js/login/jquery-1.12.4.min.js')}}"></script>
  <script src="{{ asset('gmf_theme/js/login/bootstrap.min.js')}}"></script>
  <?php
  header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  ?>

</body>
</html>
