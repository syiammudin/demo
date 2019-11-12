<template >
<div >
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">User</h1>
                    <el-button @click="create()" type='primary' size="mini"><i class="fa fa-plus"></i> Add User </el-button>
                    <el-input v-model="search" style="width:20%" placeholder="Search"></el-input>
                </div>
                <div class="panel-body">
                    <el-table :data="this.filterData.slice((page-1)*10, 10*page)" class="table" ref="filterTable">
                        <el-table-column prop="name" label="Name" ></el-table-column>
                        <el-table-column prop="id_number" label="ID NUMBER" ></el-table-column>
                        <el-table-column prop="email" label="Email" ></el-table-column>
                        <el-table-column label="Position" >
                            <template slot-scope="scope">
                                <span v-if="scope.row.role != 0">
                                    {{ $store.state.Role.find(role => role.id == scope.row.role ).role }}
                                </span>
                            </template>
                        </el-table-column>
                        <el-table-column label="Area">
                            <template slot-scope="scope">
                                <span v-if=" scope.row.role_request != null">
                                    {{ $store.state.RoleRequest.find(request => request.id == scope.row.role_request ).name }}
                                    <span v-if="scope.row.role_request == 2">({{ scope.row.component_type }})</span>
                                </span>
                            </template>
                        </el-table-column>
                        <el-table-column label="Signature" >
                            <template slot-scope="scope">
                                <img :src="base_url+'uploads/users/signature/'+scope.row.signature" style="max-height:100px"  alt="">
                            </template>
                        </el-table-column>
                        <el-table-column fixed="right" label="#" width="100">
                          <template slot-scope="scope">
                              <el-button type="success" size="mini"  @click="edit(scope.row)" icon="fa fa-edit" circle></el-button>
                              <el-button type="danger" size="mini" @click="deleted(scope.row)" icon="fa fa-trash" circle></el-button>
                          </template>
                        </el-table-column>
                  </el-table>
                  <el-pagination
                      background
                      layout="prev, pager, next"
                      :page-size="10"
                      @current-change="nextPage"
                      :total="filterData.length">
                  </el-pagination>
                </div>
            </div>
        </div>
    </div>

    <el-dialog title="User Form " :visible.sync="FormUser" :before-close="handleClose">
      <el-button size="mini" icon='fa fa-search' @click="personelDialog = true" round > Find User </el-button>
      <div class="form-horizontal" >
          <div class="form-group">
              <label class="col-lg-4 control-label">Name</label>
              <div class="col-lg-8">
                  <input type="text" readonly v-model='input.name' class="form-control" placeholder="name" >
                  <span v-if="err.name" class="text-danger"> {{ err.name[0] }}</span>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 control-label">ID Number</label>
              <div class="col-lg-8">
                  <input type="text"  v-model='input.id_number' class="form-control" placeholder="ID Number" >
                  <span v-if="err.id_number" class="text-danger"> {{ err.id_number[0] }}</span>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 control-label">Unit</label>
              <div class="col-lg-8">
                  <input type="text" readonly v-model='input.unit_code' class="form-control" placeholder="Unit" >
                  <span v-if="err.unit_code" class="text-danger"> {{ err.unit_code[0] }}</span>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 control-label">Position</label>
              <div class="col-lg-8">
                  <input type="text" readonly v-model='input.position_name' class="form-control" placeholder="Position" >
                  <span v-if="err.position_name" class="text-danger"> {{ err.position_name[0] }}</span>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 control-label">Email</label>
              <div class="col-lg-8">
                  <input type="text"  v-model='input.email' class="form-control" placeholder="Email" >
                  <span v-if="err.email" class="text-danger"> {{ err.email[0] }}</span>
              </div>
          </div>
          <div class="form-group">
              <label class="col-lg-4 control-label">Role</label>
              <div class="col-lg-8">
                  <el-select v-model="input.role" filterable clearable placeholder="Select" >
                      <el-option v-for="d in Role" :key="d.id"
                          :label="d.role"
                          :value="d.id">
                      </el-option>
                  </el-select>
                  <span v-if="err.role" class="text-danger"> {{ err.role[0] }}</span>
              </div>
          </div>
          <div class="form-group" v-if="input.role != undefined && input.role != 5 && input.role != 6">
              <label class="col-lg-4 control-label">Request Area</label>
              <div class="col-lg-8">
                  <el-select v-model="input.role_request" placeholder="Select" clearable>
                      <el-option v-for="(r, i) in RoleRequest" :key="i" :value="r.id" :label="r.name"></el-option>
                  </el-select>
                  <span v-if="err.role_request" class="text-danger"> {{ err.role_request[0] }}</span>
              </div>
          </div>
          <div class="form-group" v-if="input.role_request == 2">
              <label class="col-lg-4 control-label">Component Type</label>
              <div class="col-lg-8">
                  <el-select v-model="input.component_type" placeholder="Select" clearable v-if="input.role_request == 2">
                      <el-option v-for="t in ['TCE','TBR','TCA','TNO','TCW']" :key="t" :value="t" :label="t"></el-option>
                  </el-select>
                  <span v-if="err.role_request" class="text-danger"> {{ err.role_request[0] }}</span>
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
                    :on-change="handleChange"
                    :on-remove="handleRemove"
                    :file-list="fileList"
                    :before-upload="beforeAvatarUpload"
                    list-type="picture"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                  </el-upload>
                  <!-- <div class="col-md-12 text-right">
                      <a @click="deleteSignature()" v-if="input.signature != null"> <i class="fa fa-times "></i> </a>
                  </div>
                  <img :src="base_url+'uploads/users/signature/'+input.signature" alt="" style="max-height:150px"> -->
              </div>
          </div>
      </div>


      <span slot="footer" class="dialog-footer">
        <el-button @click="FormUser = false">Close</el-button>
        <el-button type="primary" @click.prevent="input.id === undefined  ?  save(input) : input.id === 'item' ?  save()  : update(input) ">
        <i v-if="input.id === undefined || input.id === 'item'" class="fa fa-save"></i> <i v-else class="fa fa-pencil"></i>
        {{ input.id === undefined ? 'Add' : input.id === 'item' ?  'Add' : 'Update' }}</el-button>
        <!-- <el-button type="primary" @click="save()">Confirm</el-button> -->
      </span>
    </el-dialog>

    <el-dialog title="User Soe List" :visible.sync="personelDialog" >
        <PersonelList @add="addPersonel" />
    </el-dialog>
</div>
</template>

<script>
import PersonelList from '../../components/PersonelList'
export default {
    components : {
        PersonelList
    },
    computed: {
        Role() { return this.$store.state.Role } ,
        RoleRequest() { return this.$store.state.RoleRequest } ,
        // Personel() { return this.$store.state.Personel } ,
        filterData(){
            return this.data.filter(data => !this.search
                                        || data.name.toLowerCase().includes(this.search.toLowerCase())
                                        || data.id_number.toLowerCase().includes(this.search.toLowerCase())
                                        || data.email.toLowerCase().includes(this.search.toLowerCase())
                                        || data.role_request != null && this.$store.state.RoleRequest.find(request => request.id == data.role_request ).name.toLowerCase().includes(this.search.toLowerCase())
                                        || data.component_type != null && data.component_type.toLowerCase().includes(this.search.toLowerCase())
                                    ) ;
        }
    },
    created() {
        this.$store.commit('getRole');
        this.$store.commit('getRoleRequest');
        // this.$store.commit('getPersonel');
    },
    mounted() {
        this.getData() ;
        // this.getPersonel();
    },
    data() {
        return {
            url : BASE_URL + 'user',  data: [] , FormUser : false , input : {}, base_url : BASE_URL,search : '', page : 1 ,
            Personel : [], loading : true, soe : BASE_URL, personelDialog : false, err : [], fileList : []
        }
    },
    methods : {
        addPersonel(data){
            this.input.name = data.full_name
            this.input.id_number = data.personel_number
            this.input.unit_code = data.unit_code
            this.input.position_name = data.position_name
            this.input.email = data.email
            this.personelDialog = false
        },
        nextPage(page) {
            this.page = page
            console.log(page);
        },
        uploadSuccess(response, file, fileList) {
            if(response.success == true){
                console.log(response);
                this.input.signature = response.file
            }else{
                this.$message.error(response.message);
            }
        },
        getData(){
            axios.get(this.url).then((res) => {
                this.data = res.data
            })
            .catch((err) => {

            })
        },
        create(){
            this.FormUser = true
            this.input = {}
        },
        save(input){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url, input).then((res) => {
                this.FormUser = false
                loading.close();
                this.getData()
                this.input = {}
                this.err = []
                console.log(res.data);
            })
            .catch((error) => {
                this.err = error.response.data.errors;
                loading.close();
            })
        },
        edit(d){
            this.FormUser = true
            const edit = JSON.parse(JSON.stringify(d))
            this.input = edit
            if(edit.signature != null){
                this.fileList = [{name: edit.signature, url: this.base_url+'uploads/users/signature/'+ edit.signature, response : { file : edit.signature }  }]
            }else{
                this.fileList = []
            }
            this.loading = false
        },
        update(d){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading',background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+d.id, d).then((res) => {
                this.FormUser = false
                loading.close()
                this.getData()
                this.input = {}
                this.err = []
                console.log(res.data);
            })
            .catch((error) => {
                this.err = error.response.data.errors;
            })
        },
        deleted(d){
            this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                axios.delete(this.url+'/'+d.id).then((res) => {
                    console.log(res.data);
                    this.getData()
                    this.showForm = false
                    this.$message({ type: 'success', message: 'Delete Success' });
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
                this.$message({ type: 'failed', message: 'Delete canceled' });
            });
        },
        deleteSignature(){
            this.input.signature = null
        },
        handleChange(file, fileList){
            if(file.response){
                if(fileList.length >= 1){
                    axios.post(this.url+'/action_file?id='+this.input.id+'&signature='+this.input.signature, fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                        console.log(res.data)
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleRemove(file, fileList){
            console.log(file);
            if(file.response ){
                axios.post(this.url+'/action_file?type=delete&id='+this.input.id, {'file' : file.response.file } ).then((res) => {
                    this.input.signature = null
                })
                .catch((err) => {

                })
            }

        },
        beforeAvatarUpload(file){

            const isPNG = file.type === 'image/png';

            if (!isPNG) {
              this.$message.error('Type File must be PNG format and No background!');
            }

            return isPNG;
        },
        filterTag(value, row) {
            return row.component_type === value;
        },
        filterHandler(value, row, column) {
            const property = column['property'];
            return row[property] === value;
        },
        handleClose(){
            this.fileList = []
            this.FormUser = false
        }
    }
}
</script>

<style lang="css">
</style>
