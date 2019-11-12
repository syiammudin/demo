<template >
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">My Profile</h1>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Name</label>
                            <div class="col-lg-8">
                                <input readonly type="text" v-model='input.name' class="form-control" placeholder="name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Email</label>
                            <div class="col-lg-8">
                                <input readonly type="text" v-model='input.email' class="form-control" placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Unit</label>
                            <div class="col-lg-8">
                                <input readonly type="text" v-model='input.unit_code' class="form-control" placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Position</label>
                            <div class="col-lg-8">
                                <input readonly type="text" v-model='input.position_name' class="form-control" placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Role</label>
                            <div class="col-lg-8">
                                <el-select disabled v-model="input.role" filterable clearable placeholder="Select" >
                                    <el-option v-for="d in Role" :key="d.id"
                                        :label="d.role"
                                        :value="d.id">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Role</label>
                            <div class="col-lg-8">
                                <el-select disabled v-model="input.role_request" filterable clearable placeholder="Select" >
                                    <el-option v-for="d in RoleRequest" :key="d.id"
                                        :label="d.name"
                                        :value="d.id">
                                    </el-option>
                                </el-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Password</label>
                            <div class="col-lg-8">
                                <input type="password" v-model='input.password' class="form-control" placeholder="Password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Signature</label>
                            <div class="col-lg-8">
                                <el-upload
                                  class="upload-demo"
                                  :action="url + '/upload'"
                                  :on-success="uploadSuccess"
                                  :show-file-list="false"
                                  >
                                  <el-button size="mini" type="success"><i class="fa fa-file"></i> Upload</el-button>
                                </el-upload>
                                <div class="col-md-12 text-right">
                                    <a @click="deleteSignature()" v-if="input.signature != null"> <i class="fa fa-times "></i> </a>
                                </div>
                                <img :src="base_url+'uploads/users/signature/'+input.signature" alt="" style="max-height:150px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-8">
                                <el-button type="primary" size="mini" @click.prevent="update(input) ">Update</el-button>
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
    computed: {
        RoleRequest() { return this.$store.state.RoleRequest } ,
        Role() { return this.$store.state.Role } ,
    },
    created() {
        this.$store.commit('getRole');
        this.$store.commit('getRoleRequest');
        this.getData()
    },
    data() {
        return {
            input : {}, url : BASE_URL+'user', base_url : BASE_URL
        }
    },
    methods : {
        uploadSuccess(response, file, fileList) {
            if(response.success == true){
                console.log(response.file);
                this.input.signature = response.file
            }else{
                this.$message.error(response.message);
            }
        },
        getData(){
            axios.get(this.url+'/'+ AUTH_LOGIN_ID).then((res) => {
                this.input = res.data
                console.log(res.data);
            })
            .catch((err) => {

            })
        },
        deleteSignature(){
            this.input.signature = null
        },
        update(d){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+d.id, d).then((res) => {
                this.FormUser = false
                loading.close()
                this.getData()
                this.input = {}
                console.log(res.data);
                this.$message({ type: 'success', message: 'Update Success' });
            })
            .catch((err) => {

            })
        },
    }
}
</script>

<style lang="css">
</style>
