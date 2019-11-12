<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Migration </title>
  </head>
  <body>
    <form class="" action="{{ url('migration_import') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        <input type="text" name="type" value="engine" readonly >  <br>
        1. main <input type="file" name="mainfile" >  <br>
        2. Rating <input type="file" name="ratingfile" >  <br>
        <button type="submit" name="button" >Import</button>
    </form>
  </body>
</html>
