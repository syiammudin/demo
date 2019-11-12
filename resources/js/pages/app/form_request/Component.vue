<template>
<div v-if="role_request == 2 || role_request == 3 || type == 'change' || type == 'delete'" >
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">Component Capability Request</h1>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3 label-control">No Request</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly :value="RequestNumber" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 label-control"> Unit Component Request</label>
                        <div class="col-lg-9">
                            <input type="text" :value="component_type" class="form-control" readonly>
                            <span v-if="err.component_type" class="text-danger"> {{ err.component_type[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group" v-if="type == null">
                        <label class="col-lg-3 label-control"></label>
                        <div class="col-md-9 checkbox checkbox-replace checkbox-success">
                            <div class="col-md-12 ">
                                <input type="checkbox" class="form-control" v-model='input.authority'>
                                <label for="checkbox6">Add Part Number and/or Add Authority </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" v-if="type == 'change' || type == 'delete' || input.authority == true">
                        <label class="col-lg-3 label-control"> Part Number</label>
                        <div class="col-lg-9">
                            <el-select  v-model="input.part_number" filterable clearable placeholder="Select Material" >
                                <el-option v-for="d in master_configs" :key="d.part_number"
                                    :label="d.part_number"
                                    :value="d.part_number">
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
                            <button type="button" class="btn btn-primary" @click="create" v-else> Create </button>
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
    props : ['type'] ,
    computed: {
        RequestNumber() { return this.$store.state.RequestNumber } ,
    },
    created() {
        this.$store.state.type_of_request = 'component'
        this.$store.commit('getRequestNumber');
    },
    data() {
        return{
            input : {}, test : '' , url : BASE_URL + 'submit_component', err : [], component_type : COMPONENT_TYPE, role_request : ROLE_REQUEST,
            base_url : BASE_URL, master_configs : []
        }
    },
    mounted(){
        this.input.component_type = this.component_type ;
        this.getData()
    },
    watch : {
        'input.authority' : function (vo){

        },
    },
    methods : {
        getData(){
            axios.get(this.base_url+'master_configs').then((res) => {
                console.log(res.data);
                this.master_configs = res.data
            })
            .catch((err) => {

            })
        },
        create(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',  background: 'rgba(0, 0, 0, 0.7)' });
            this.input.for_rating = {}
            this.input.part_number = null
            this.input.request_number = this.RequestNumber
            this.input.component_type = this.component_type
            this.$router.push({ name: 'form_component_data', params: { type: 0, component_type : this.input.component_type } })
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

            this.input.request_number = this.RequestNumber
            this.input.component_type = this.component_type
            axios.post(this.url+'/ekstracData', this.input ).then((res) => {
                if(res.data.status == 1){
                    loading.close()
                    this.$router.push({ name: 'form_component_data', params: { type: res.data.id, component_type : res.data.type } })
                }else{
                    loading.close()
                    this.$alert('Create Request Failed', 'Warning', {
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch((err) => {

            })
        }
    }
}
</script>

<style lang="css">
</style>
