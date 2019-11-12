<template >
<div class="">
    <div class="form-group">
        <a type="button" name="button" class="btn btn-primary btn-sm" :href="url+'/'+dataDetail.id+'?type=component&form_type='+type+'&rating='+authority" target="blank"> <i class="fa fa-print"></i> Print </a>
        <a type="button" name="button" class="btn btn-success btn-sm" :href="url+'/exportexcel/'+dataDetail.id+'?type=component&form_type='+type+'&rating='+authority" target="blank"> <i class="fa fa-file-excel-o"></i> Export </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td class="align-middle text-center" rowspan="2">No</td>
                <td class="align-middle text-center" rowspan="2">Rating</td>
                <td class="align-middle text-center" rowspan="2">ATA</td>
                <td class="align-middle text-center" rowspan="2">P/N</td>
                <td class="align-middle text-center" rowspan="2">Designation</td>
                <td class="align-middle text-center" rowspan="2">Manufacture</td>
                <td class="align-middle text-center" rowspan="2">Reference of the CMM</td>
                <td class="align-middle text-center" colspan="4">Level of Maintenance</td>
                <td class="align-middle text-center" rowspan="2">Work Shop</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(d, i) in dataDetail.component_capability_list" :key="i">
                <td>{{ i+1 }}</td>
                <td>{{ (JSON.parse(d.for_rating).find(d => d.name == 'EASA RATING').value).split('-')[0] }}</td>
                <td>{{ d.ata_chapter.split('-')[0] }}</td>
                <td>{{ d.part_number }}</td>
                <td>{{ d.component_name }}</td>
                <td>{{ d.vendor_manufacture }}</td>
                <td>{{ d.ata_chapter }}</td>
                <td>{{ JSON.parse(d.capability_level).repair == true ? 'X' : '' }}</td>
                <td>{{ JSON.parse(d.capability_level).testing == true ? 'X' : '' }}</td>
                <td>{{ JSON.parse(d.capability_level).inspection == true ? 'X' : '' }}</td>
                <td>{{ JSON.parse(d.capability_level).modification == true ? 'X' : '' }}</td>
                <td>{{ d.workshop }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    Note : 1. Inspection, 2. Repair, 4. Modification, 5. overhauled
</div>
</template>

<script>
export default {
    props :['dataDetail','type','authority'],
    data(){
        return {
            url : BASE_URL + 'action_capability',
        }
    }
}
</script>

<style lang="css" scoped>
.align-middle{
    vertical-align: middle !important;
}
</style>
