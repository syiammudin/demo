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
        <input type="text" name="type" value="component" readonly >  <br>
        1. main <input type="file" name="mainfile" >  <br>
        2. Rating <input type="file" name="ratingfile" >  <br>
        3. Consumable material <input type="file" name="ConsumableMaterialfile" value=""> <br>
        4. Document <input type="file" name="documentfile" >  <br>
        5. Personel <input type="file" name="personelfile" >  <br>
        6. Test Equipment <input type="file" name="testequipmentfile" >  <br>
        7. special Tools <input type="file" name="specialtoolfile" >  <br>
        8. Material Planning <input type="file" name="materialplanningfile" >  <br>
        9. Manhours Planning <input type="file" name="manhourplanningfile" >  <br>
        10. attachment <input type="file" name="attachmentfile" >  <br>
        <button type="submit" name="button" > save </button>
    </form>
  </body>
</html>
