<template >
<div>
    <div class="col-lg-12">
        Search by :
    </div>
    <div class="form-horizontal">
        <div class="col-lg-4 radio radio-replace radio-success">
            <input type="radio" v-model="search_type" name="radios2" id="radio6" value="rn"  >
            <label for="radio6">Register Number</label>
        </div>
        <div class="col-lg-4  radio radio-replace radio-success">
            <input type="radio" v-model="search_type" name="radios2" id="radio6" value="pn" >
            <label for="radio6">Part Number</label>
        </div>
        <div class="col-lg-4  radio radio-replace radio-success">
            <input type="radio" v-model="search_type" name="radios2" id="radio6" value="sn" >
            <label for="radio6">Serial Number</label>
        </div>
    </div>
    <br>
    <br>
    <el-input v-model="search" placeholder="Type to search"/>
    <br>
    <br>
    <table class="table table-condensed table-striped" v-loading="loading" >
        <tbody>
            <tr v-for='(d, i) in data' :key="i">
                <td> {{ i+1 }}</td>
                <td> {{ d.REGISTER_NUMBER }}</td>
                <td> {{ d.PARTNUMBER }}</td>
                <td> {{ d.SERIALNUMBER }}</td>
                <td> {{ d.DESCRIPTION }}</td>
                <td> <el-button type="success" size="mini"  @click="addTools(d)" icon="fa fa-plus" circle></el-button> </td>
            </tr>
        </tbody>
    </table>

</div>
</template>

<script>
export default {
    data(){
        return{
            data : [], url : BASE_URL, search_type : 'rn', search : '',   loading: true,
        }
    },
    watch: {
        search(v) {
            this.getData()
        }
    },
    mounted(){
        this.getData();
    },
    methods : {
        getData(){
            let params = {
                search: this.search,
                search_type: this.search_type
            }
            // const loading = this.$loading({
            //   lock: true,
            //   text: 'Loading',
            //   spinner: 'el-icon-loading',
            //   background: 'rgba(0, 0, 0, 0.7)'
            // });
            axios.get(this.url+'store/tools/1', {params: params}).then((res) =>{
                this.data = res.data
                this.loading = false
                // loading.close()
            })
            .catch((err) => {
                this.loading = false
            })
        },
        addTools(d){
            this.$emit('add', d)

        }
    }
}
</script>

<style lang="css">
</style>
