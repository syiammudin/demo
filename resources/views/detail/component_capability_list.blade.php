
<table border="1">
  <tr>
    <td>No</td>
    <td>Part Number</td>
    <td>Part Name</td>
    <td>Manufacture</td>
    <td>ATA</td>
    <td>Level Of Maintenance</td>
    <td>Workshop</td>
    <td>A/C Type</td>
    <td>Rating</td>
    <td>Date Approval</td>
    <td>Unit</td>
    <td>Request Type</td>
  </tr>
  @php $no = 1 @endphp
  @foreach($data as $d)
  <tr>
    <td>{{ $no++  }}</td>
    <td>{{ $d->part_number  }}</td>
    <td>{{ $d->component_name  }}</td>
    <td>{{ $d->vendor_manufacture  }}</td>
    <td>{{ $d->ata_chapter  }}</td>
    <td>
      @php
      $capability = json_decode($d->capability_level);
      @endphp
      @if($capability->overhauled == true) Overhauled, @endif
      @if($capability->inspection == true)Inspection, @endif
      @if($capability->testing == true) Testing, @endif
      @if($capability->repair == true) Repair, @endif
      @if($capability->modification == true) Modification @endif
    </td>
    <td>{{ $d->workshop  }}</td>
    <td>{{ $d->aircraft_type  }}</td>
    <td>{{ $d->authority  }}</td>
    <td>{{ $d->date_approval    }}</td>
    <td>{{ $d->component_type  }}</td>
    <td>{{ $d->request_type  }}</td>
  </tr>
  @endForeach
</table>
