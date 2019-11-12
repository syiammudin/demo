<template>
<div v-if="role_request == 2 || role_request == 3 || role_request == 4 || type == 'change' || type == 'delete'" >
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">{{ title }} ({{ type }})</h1>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3 label-control">No Request</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly :value="RequestNumber" >
                        </div>
                    </div>
                    <div class="form-group" v-if="type == 'add'">
                        <label class="col-lg-3 label-control"></label>
                        <div class="col-md-9 checkbox checkbox-replace checkbox-success">
                            <div class="col-md-3 ">
                                <input type="checkbox" class="form-control" v-model='input.authority'>
                                <label for="checkbox6">Add Authority </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" v-if="(type == 'change' || type == 'delete' || input.authority == true) && role_request != 1 ">
                        <label class="col-lg-3 label-control">{{ role_request == 4 ? 'NDT Method' : 'Part Number' }}</label>
                        <div class="col-lg-9">
                            <el-select v-model="input.part_number" filterable clearable :placeholder="role_request == 4 ? 'Select NDT Method' : 'Select Part Number'" >
                                <el-option v-for="d in master_configs" :key="d.part_number"
                                    :label="d.part_number"
                                    :value="d.part_number">
                                </el-option>
                            </el-select>
                            <span v-if="err.component_type" class="text-danger"> {{ err.component_type[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group" v-if="(type == 'change' || type == 'delete') && role_request == 1 ">
                        <label class="col-lg-3 label-control"> AircraftType</label>
                        <div class="col-lg-9">
                            <el-select v-model="input.master_config_id" filterable clearable placeholder="Select Aircraft Type" >
                                <el-option v-for="d in master_configs" :key="d.id"
                                    :label="d.aircraft_type+' - '+ d.maintenance_area +' ('+d.maintenance_area_value+') - '+ d.ability"
                                    :value="d.id">
                                </el-option>
                            </el-select>
                            <span v-if="err.component_type" class="text-danger"> {{ err.component_type[0] }}</span>
                        </div>
                    </div>
                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-3"></label>
                        <div class="col-lg-9">
                            <button type="button" class="btn btn-primary" @click="Ekstraks" v-if="type == 'change' || type == 'delete' || input.authority == true"> Ekstraks and Create Data </button>
                            <button type="button" class="btn btn-primary" @click="create" v-else> Create New</button>
                            <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['title','type'] ,
    computed: {
        RequestNumber() { return this.$store.state.RequestNumber } ,
    },
    created() {
        if(this.role_request == 1){
          this.$store.state.type_of_request = 'aircraft'
        }
        if(this.role_request == 3){
          this.$store.state.type_of_request = 'engine'
        }
        if(this.role_request == 4){
          this.$store.state.type_of_request = 'special'
        }
        this.$store.commit('getRequestNumber');
    },
    data() {
        return{
            input : {}, test : '' , err : [], component_type : COMPONENT_TYPE, role_request : ROLE_REQUEST,
            base_url : BASE_URL, master_configs : [],
        }
    },
    mounted(){
        this.input.component_type = this.component_type ;
        this.getData()
    },
    methods : {
        getData(){
            axios.get(this.base_url+'master_configs?type='+this.role_request).then((res) => {
                console.log(res.data);
                this.master_configs = res.data
            })
            .catch((err) => {

            })
        },
        create(){
            this.input.request_number = this.RequestNumber
            axios.get(this.base_url+'MasterRequest' ).then((res) =>{
                const link = res.data.find(d => d.id == this.role_request).link ;
                this.$router.push({ name: link, params: { type : '0' } } )
            })
            .catch((err) => {
                console.log(err)
            })
        },
        Ekstraks(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
            if(this.type == 'change'){
                this.input.request_type = 'Change' ;
            }
            if(this.type == 'delete'){
                this.input.request_type = 'Delete' ;
            }
            if(this.input.authority == true){
                this.input.request_type = 'Add Change' ;
            }

            if(this.role_request === '1' ){
                var link_url = 'submit_aircraft' ;
            }
            if(this.role_request === '3' ){
                var link_url = 'submit_engine' ;
            }
            if(this.role_request === '4'){
                var link_url = 'submit_special' ;
            }

            this.input.request_number = this.RequestNumber
            if(this.input.part_number != null || this.input.part_number !=  undefined || this.input.master_config_id != null){
              axios.post( this.base_url+''+link_url +'/ekstracData', this.input ).then((res) => {
                if(res.data.status == 1){
                  loading.close()
                  this.$router.push({ name: res.data.type, params: { type: res.data.id } })
                }else{
                  loading.close()
                  this.$alert('Create Request Failed', 'Warning', {
                    confirmButtonText: 'OK',
                  });
                }
              })
              .catch((err) => {

              })
            }else{
              this.$alert('Please Select part Number first', 'Warning', {
                confirmButtonText: 'OK',
              });
              loading.close()
            }
        }
    }
}
</script>

<style lang="css">
</style>
