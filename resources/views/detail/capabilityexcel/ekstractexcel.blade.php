
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
    <td>Date of Approved by GM QSA</td>
    <td>Unit</td>
    <td>Request Type</td>
    <td>Revision No.</td>
  </tr>
  @php $no = 1 @endphp
  @foreach($data as $d)
  <tr>
    <td>{{ $no++  }}</td>
    <td>{{ $d->part_number  }}</td>
    <td>{{ $d->part_name  }}</td>
    <td>{{ $d->vendor_manufacture  }}</td>
    <td>{{ $d->ata_chapter  }}</td>
    <td>
      @php
      $capability = json_decode($d->level_of_maintenance);
      @endphp
      @if($capability->overhauled == true) Overhauled, @endif
      @if($capability->inspection == true)Inspection, @endif
      @if($capability->testing == true) Testing, @endif
      @if($capability->repair == true) Repair, @endif
      @if($capability->modification == true) Modification @endif
    </td>
    <td>{{ $d->workshop  }}</td>
    <td>{{ str_replace('|',', ',$d->aircraft_type)  }}</td>
    <td>{{ $d->rating  }}</td>
    <td>{{ $d->date_approval    }}</td>
    <td>{{ $d->authority_value  }}</td>
    <td>{{ $d->request_type  }}</td>
    <td>
      @if($d->issue != null)
        Issue : {{ \App\Issue::find($d->issue)->issue }} , Rev : {{ $d->revision }}
      @endif
    </td>
  </tr>
  @endForeach
</table>
