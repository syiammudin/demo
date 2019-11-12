<table border="1">
  <tr>
    <td class="text-center align-middle" rowspan="2">No</td>
    <td class="text-center align-middle" rowspan="2">Part Number</td>
    <td class="text-center align-middle" rowspan="2">Part Name</td>
    <td class="text-center align-middle" rowspan="2">Manufacturer</td>
    <td class="text-center align-middle" rowspan="2">Ata</td>
    <td class="text-center align-middle" colspan="5">Capability</td>
    <td class="text-center align-middle" rowspan="2">Shop</td>
    <td class="text-center align-middle" rowspan="2">A/C Type</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

  @php $no = 1  @endphp
  @foreach($data as $d)
  <?php
  $capability_level = json_decode($d->capability_level) ;
  ?>
  <tr>
    <td class="text-center">{{ $no++ }}</td>
    <td>{{ $d->part_number }}</td>
    <td>{{ $d->component_name }}</td>
    <td>{{ $d->vendor_manufacture }}</td>
    <td>{{ $d->ata_chapter }}</td>
    <td class="text-center">@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->testing)) @if($capability_level->testing == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->repair)) @if($capability_level->repair == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->modification)) @if($capability_level->modification == true) X @endif @endif</td>
    <td class="text-center">@if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) X @endif @endif</td>
    <td>{{ $d->workshop }}</td>
    <td>{{ implode(',   ',explode('|', $d->aircraft_type)) }}</td>
  </tr>
  @endForeach
</table>
