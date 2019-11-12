<template >
<div class="">
    <div class="form-group">
        <a type="button" name="button" class="btn btn-primary btn-sm" :href="url+'/'+dataDetail.id+'?type=component&form_type='+type+'&rating='+authority" target="blank"> <i class="fa fa-print"></i> Print </a>
        <a type="button" name="button" class="btn btn-success btn-sm" :href="url+'/exportexcel/'+dataDetail.id+'?type=component&form_type='+type+'&rating='+authority" target="blank"> <i class="fa fa-file-excel-o"></i> Export </a>
    </div>
    <table class="table table-bordered">
        <thead>
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
        </thead>
        <tbody>
            <tr v-for="(d, i) in list_capabality" :key="i">
                <td>{{ i+1 }}</td>
                <td>{{ d.part_number }}</td>
                <td>{{ d.component_name }}</td>
                <td>{{ d.ata_chapter }}</td>
                <td>{{ d.vendor_manufacture }}</td>
                <td>{{ JSON.parse(d.capability_level).repair == true ? 'Repair, ' : '' }}
                    {{ JSON.parse(d.capability_level).inspection == true ? 'Inspection/Test, ' : '' }}
                    {{ JSON.parse(d.capability_level).modification == true ? 'Modification ' : '' }}
                    {{ JSON.parse(d.capability_level).overhauled == true ? 'Overhaul, ' : '' }}
                </td>
                <td> <input type="text" v-model="d.technical_data" class="form-control" placeholder="Technical Data"> </td>
                <td> <input type="text" v-model="d.major_equipment" class="form-control" placeholder="Major Equipment"> </td>
                <td>{{ d.aircraft_type }}</td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" name="button" @click="update()">Update</button>
</div>
</template>

<script>
export default {
    props :['dataDetail','type','authority'],
    data(){
        return {
            url : BASE_URL + 'action_capability', input : {}, list_capabality : []
        }
    },
    mounted(){
      this.getData() ;
    },
    methods : {
        getData(){
            this.list_capabality = this.dataDetail.component_capability_list
        },
        update(){
          const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
           axios.put(this.url+'/1', this.list_capabality).then((res) => {
             this.$message({
               type: 'success',
               message: 'Update Success'
             });
             // if(res.data.status == 1){
             // }
             loading.close()
           })
           .catch((error ) => {
             loading.close()
           })
        }
    }
}
</script>

<style lang="css" scoped>
</style>
