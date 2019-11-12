<template >
<div>
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Master Request</h1>
                </div>
                <div class="panel-body">
                    <el-table :data="data" style="width: 100%" >
                        <el-table-column prop="title" label="Title" ></el-table-column>
                        <el-table-column prop="description" label="Picture" ></el-table-column>
                        <el-table-column label="Picture" >
                            <template slot-scope="scope">
                                <img :src="base_url+'picture/'+scope.row.picture" alt="">
                                <!-- {{ scope.row.picture }} -->
                            </template>
                        </el-table-column>

                        <el-table-column fixed="right" label="#" align="center" width="90">
                          <template slot-scope="scope">
                              <el-button @click="edit(scope.row)" type="warning" size="mini" icon="fa fa-edit" circle > </el-button>
                              <!-- <el-button @click="deleted(scope.row)" type="danger" size="mini" icon="fa fa-trash" circle > </el-button> -->
                          </template>
                        </el-table-column>
                  </el-table>

                </div>
            </div>
        </div>
    </div>

    <el-dialog title="Form Master Request " :visible.sync="showForm" >
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3">Title</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="input.title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Manufacture</label>
                <div class="col-md-9">
                    <textarea  class="form-control" v-model="input.description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Picture</label>
                <div class="col-md-9">
                    <el-upload
                      class="upload-demo"
                      :action="url + '/upload'"
                      :on-success="uploadSuccess"
                      :show-file-list="false"
                      >
                      <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                    </el-upload>
                    <img :src="base_url+'picture/'+input.picture" alt="">
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="showForm = false" size="mini" type="danger">Cancel</el-button>
                <el-button @click="input.id === undefined ? save() : update()" type="primary" size="mini">{{ input.id === undefined ? 'Save' : 'Update' }} </el-button>
            </span>

        </form>
    </el-dialog>
</div>
</template>

<script>
export default {
    computed: {
        filteredList() {
            return this.data.filter(data => !this.search || data.code.toLowerCase().includes(this.search.toLowerCase()) || data.description.toLowerCase().includes(this.search.toLowerCase()) || data.station.toLowerCase().includes(this.search.toLowerCase()))
        }
    },
    data(){
        return {
            data : [], input : {} , showForm : false, url : BASE_URL + 'MasterRequest', search: '', page: 1, base_url : BASE_URL
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        uploadSuccess(response, file, fileList) {
            if(response.success == true){
                this.input.picture = response.file
            }else{
                this.$message.error(response.message);
            }
        },
        edit(data){
            this.showForm = true
            this.input = JSON.parse(JSON.stringify(data))
        },

        update(){
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });
            axios.put(this.url+'/'+this.input.id, this.input).then((res) => {
                this.getData()
                this.showForm = false
                this.$message({ type: 'success', message: 'Update Success' });
                loading.close()
            })
            .catch((err) => {
                console.log(err);
            })
        },
        getData(){
            axios.get(this.url).then((res) => {
                this.data = res.data
            })
            .catch((err) => {

            })
        }
    }

}
</script>

<style lang="css">
</style>
