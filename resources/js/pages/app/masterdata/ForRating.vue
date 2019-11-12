<template >
<div>
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">For Rating</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <el-button type="primary" @click="add()" size="mini" icon="fa fa-plus" round > Add New</el-button>
                    </div>
                    <div class="col-md-4">
                        <el-input v-model="search" placeholder="Type to search"/>
                    </div>
                    <el-table :data="this.filteredList.slice((page-1)*10, 10*page)" style="width: 100%" >
                        <el-table-column prop="name_of_rating" label="Name of Rating" ></el-table-column>
                        <el-table-column prop="desciption" label="Value Rating" ></el-table-column>
                        <el-table-column prop="form_type" label="Form Type" ></el-table-column>
                        <el-table-column fixed="right" label="#" align="center" width="90">
                          <template slot-scope="scope">
                              <el-button @click="edit(scope.row)" type="warning" size="mini" icon="fa fa-edit" circle > </el-button>
                              <el-button @click="deleted(scope.row)" type="danger" size="mini" icon="fa fa-trash" circle > </el-button>
                          </template>
                        </el-table-column>
                  </el-table>
                  <el-pagination
                      background
                      layout="prev, pager, next"
                      :page-size="10"
                      @current-change="nextPage"
                      :total="filteredList.length">
                  </el-pagination>
                </div>
            </div>
        </div>
    </div>

    <el-dialog title="Form Rating " :visible.sync="showForm" >
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3">RATING NAME</label>
                <div class="col-md-9">
                    <input :disabled="input.id != undefined" placeholder="Name of Rating" type="text" class="form-control" v-model="input.name_of_rating">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3">Value Rating</label>
                <div class="col-md-9">
                    <textarea  class="form-control" v-model="input.desciption" placeholder="Value Rating"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">FORM Type</label>
                <div class="col-md-9">
                  <el-select v-model="input.form_type" placeholder="Form type for Capability">
                      <el-option value="1">1</el-option>
                      <el-option value="2">2</el-option>
                      <el-option value="3">3</el-option>
                      <el-option value="4">4</el-option>
                      <el-option value="5">5</el-option>
                      <el-option value="6">6</el-option>
                      <el-option value="7">7</el-option>
                  </el-select >
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
            data : [], input : {} , showForm : false, url : BASE_URL + 'for_rating', search: '', page: 1, formImport : false ,
            inputfile : {}, base_url : BASE_URL
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.fileexcel = e.target.files[0];
        },
        ImportFile(){
            this.load = true
            const config = { headers: { 'content-type': 'multipart/form-data' } }
            var data = new FormData();
            data.append('excelfile', this.fileexcel);
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/importExcel', data, config ).then((res) => {
                console.log(res.data);
                if(res.data.status == 1){
                    const inputfile = this.$refs.fileInput
                    inputfile.type = 'text'
                    inputfile.type = 'file'
                    this.$message({
                      type: 'success',
                      message: 'Import Aircraft Type Success'
                    });
                    this.getData();
                    this.formImport = false
                    loading.close()
                }else{
                    loading.close()
                    this.load = false
                    alert('Import Gagal')
                }
            }).catch((err) => {
                this.$alert('Something Wrong with formal excel', 'Warning', {
                    confirmButtonText: 'OK',
                });
                loading.close() ;
                console.log(err);
            })
        },
        nextPage(page) {
            this.page = page
            console.log(page);
        },
        add(){
            this.input = {}
            this.showForm = true
        },
        edit(data){
            this.showForm = true
            this.input = JSON.parse(JSON.stringify(data))
        },
        save(){
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });
            this.$confirm("Are you sure want to save this data ? if you save this data you can't edit Rating Name only Edit Value and Form Type", 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
              axios.post(this.url, this.input).then((res) => {
                    this.getData()
                    this.showForm = false
                    this.$message({ type: 'success', message: 'Update Success' });
                    loading.close()
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
                this.$message({ type: 'failed', message: 'Delete canceled' });
            })
            .finally(() =>{
                loading.close()
            })

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
        deleted(data){
            this.$confirm('Do You Want Delete this data ?', 'Warning', {  confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning'}).then(() => {
                axios.delete(this.url+'/'+data.id).then((res) => {
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
