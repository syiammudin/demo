<template >
<div>
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Questionare</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">

                    </div>
                    <el-table :data="this.filteredList.slice((page-1)*10, 10*page)" style="width: 100%" >
                        <el-table-column label="Type Request" >
                            <template slot-scope="scope">
                                {{ $store.state.RoleRequest.find(r => r.id == scope.row.master_request_id).name }}
                            </template>
                        </el-table-column>
                        <!-- <el-table-column prop="attachment_lenght" label="Questionare" ></el-table-column> -->
                        <el-table-column fixed="right" label="#" align="center">
                          <template slot-scope="scope">
                              <el-button @click="edit(scope.row)" type="warning" size="mini" icon="fa fa-plus" circle > </el-button>
                              <!-- <el-button @click="deleted(scope.row)" type="danger" size="mini" icon="fa fa-trash" circle > </el-button> -->
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
    <el-dialog title="Questionare" :visible.sync="showForm" >
        <!-- <form class="form-horizontal"> -->
            <h4>
                {{ this.type }}
                <el-button @click="formImport = true"  size="mini" icon="fa fa-file-excel-o " round > Import </el-button>
            </h4>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr v-for="(d, i) in  list_questionare" :key="i">
                        <td><input type="text" class="form-control" v-model="d.question" placeholder="fill question here"></td>
                        <td v-if="input.id == 5"><input  type="number" class="form-control" v-model="d.max_score" placeholder="Max Score"></td>
                        <td> <a @click="del(i)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                </tbody>
            </table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="addQuestionare()" size="mini" round icon="fa fa-plus" >Add Question</el-button>
                <el-button @click="save()" size="mini" type="primary">Save</el-button>
            </span>
        <!-- </form> -->
    </el-dialog>


    <el-dialog title="Form Aircraft " :visible.sync="formImport" >
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3">File (.xlsx)</label>
                <div class="col-md-9">
                    <input type="file" v-on:change="onFileChange" style="display:block" class="form-control" ref="fileInput" />
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="formImport = false" size="mini" type="danger">Cancel</el-button>
                <el-button @click="ImportFile()" type="primary" size="mini">Import </el-button>
            </span>
        </form>
        <div class="line-dashed"></div>
        For format import excel, you can  <a :href="base_url+'document_n_import/master/upload_questionnaire.xlsx'" target="_blank" style="color:blue!important">download here</a>
    </el-dialog>


</div>
</template>

<script>
export default {
    computed: {
        RoleRequest() { return this.$store.state.RoleRequest } ,
    },
    created() {
        this.$store.commit('getRoleRequest');
    },
    computed: {
        filteredList() {
            return this.data.filter(data => !this.search || data.workshop.toLowerCase().includes(this.search.toLowerCase()) )
        }
    },
    data(){
        return {
            type : '' , list_questionare : [], formImport : false , base_url : BASE_URL,
            data : [], input : {} , showForm : false, url : BASE_URL + 'submit_questionare', search: '', page: 1, formImport : false ,
            inputfile : {}
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
            axios.post(this.url+'/importExcel', data, config).then(res => {
                if(res.data.status == 1){
                    this.formImport = false
                    for (var i = 0; i < res.data.data.length; i++) {
                        var obj = {
                            question:res.data.data[i].question,
                            max_score : '',
                            answer: '',
                            remark: '',
                        }
                        this.list_questionare.push(obj);
                    }

                    const input = this.$refs.fileInput
                    input.type = 'text'
                    input.type = 'file'

                }
                loading.close()
            })
            .catch(error => {
                loading.close()
                this.$alert("Import Failed, Format Excel not Match", 'Warning', { confirmButtonText: 'OK', });
            })

        },
        addQuestionare(){
            this.list_questionare.push({question : '', answer : '', remark : ''});
        },
        del(i){
            this.list_questionare.splice(i , 1);
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
            this.type = this.$store.state.RoleRequest.find(r => r.id == data.master_request_id).name
            this.input.id = data.id
            this.list_questionare = JSON.parse(data.questionare)
        },
        save(){
            this.input.questionare = JSON.stringify(this.list_questionare)
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
