<table border=1 width=500>
    @php
        $no = 1 ;
    @endphp
    <tr>
        <td>No</td>
        <td>description</td>
        <td>qty</td>
        <td>unit</td>
        <td>remark</td>
    </tr>
    @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->distinct('description_main')->select('description_main')->get() as $af)
        <?php
            $cek = \App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->count() ;
        ?>
        @if($cek > 1)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $af->description_main }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->get() as $d)
                <tr>
                    <td></td>
                    <td>{{ $d->description }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->unit }}</td>
                    <td>{{ $d->remark }}</td>
                </tr>
            @endForeach
        @else
            @foreach(\App\AircraftFacility::where('request_submittion_id', $request->id)->where('description_main', $af->description_main)->get() as $d)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $d->description_main }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->unit }}</td>
                    <td>{{ $d->remark }}</td>
                </tr>
            @endForeach
        @endif
        <?php $no++ ; ?>
    @endForeach
</table>
