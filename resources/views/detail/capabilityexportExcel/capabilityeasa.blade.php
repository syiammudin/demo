<table border="1">
  <tr>
    <td class="text-center align-middle" rowspan="2">No</td>
    <td class="text-center align-middle" rowspan="2">Rating</td>
    <td class="text-center align-middle" rowspan="2">ATA</td>
    <td class="text-center align-middle" rowspan="2">P/N</td>
    <td class="text-center align-middle" rowspan="2">Designation</td>
    <td class="text-center align-middle" rowspan="2">Manufacture</td>
    <td class="text-center align-middle" rowspan="2">Reference of the CMM</td>
    <td class="text-center align-middle" colspan="4">Level of Maintenance</td>
    <td class="text-center align-middle" rowspan="2">Work Shop</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  @php $no = 1  @endphp
  @foreach($data as $d)
  <?php
  $rating = explode('-',$d->value) ;
  $ata = explode('-',$d->ata_chapter) ;
  $capability_level = json_decode($d->capability_level) ;
  ?>
  <tr>
    <td class="text-center">{{ $no++ }}</td>
    <td>{{ $rating[0] }}</td>
    <td>{{ $ata[0] }}</td>
    <td>{{ $d->part_number }}</td>
    <td>{{ $d->component_name }}</td>
    <td>{{ $d->vendor_manufacture }}</td>
    <td>{{ $d->ata_chapter }}</td>
    <td class="text-center">@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->repair)) @if($capability_level->repair == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->modification)) @if($capability_level->modification == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) X @endif @endif</td>
    <td>{{ $d->workshop }}</td>
  </tr>
  @endForeach
</table>
