
<table border="1">
    <tr>
        <td>No</td>
        <td>Part Number</td>
        <td>Part Name</td>
        <td>Ata</td>
        <td>Manufacturer</td>
        <td>Level of Maintenance</td>
        <td>Technical Data</td>
        <td>Major Equipment</td>
        <td>A/C Type</td>
    </tr>
    @php $no = 1  @endphp
    @foreach($data as $d)
    <?php
        $capability_level = json_decode($d->capability_level) ;
    ?>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $d->part_number }}</td>
            <td>{{ $d->component_name }}</td>
            <td>{{ $d->ata_chapter }}</td>
            <td>{{ $d->vendor_manufacture }}</td>
            <td>@if(!empty($capability_level->inspection)) @if($capability_level->inspection == true)  Inspection/Test, @endif @endif
                @if(!empty($capability_level->repair)) @if($capability_level->repair == true) Repair, @endif @endif
                @if(!empty($capability_level->modification)) @if($capability_level->modification == true) Modification, @endif @endif
                @if(!empty($capability_level->overhauled)) @if($capability_level->overhauled == true) Overhaul, @endif @endif</td>
            <td>{{ $d->technical_data }}</td>
            <td>{{ $d->major_equipment }}</td>
            <td>{{ implode(', ',explode('|', $d->aircraft_type)) }}</td>
        </tr>
    @endForeach
</table>
