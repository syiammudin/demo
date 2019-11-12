<template>
<div class=" panel-default">
    <!-- <div class="panel-heading clearfix" style="background-color : #eee ;">
        <div class="form-horizontal">
            <div class="col-sm-offset-2 col-sm-4 radio radio-replace radio-success">
                <input type="radio" v-model="input_by" name="radios2" id="radio6" value="techpub"  >
                <label for="radio6">List Techpub</label>
            </div>
            <div class="col-lg-4  radio radio-replace radio-success">
                <input type="radio" v-model="input_by" name="radios2" id="radio6" value="manual" >
                <label for="radio6">Manual Document</label>
            </div>
        </div>
    </div> -->
    <br>

    <!-- techpub -->
    <div class="form-horizontal" v-show="techpub">
        <div class="form-group">
            <label class="col-md-3 control-label"> Search By </label>
            <div class="col-md-9">
                <select class="form-control" v-model="search_type">
                    <option value="docno">Document Number</option>
                    <option value="nama">Document Name</option>
                    <option value="actype">Aircraft Type</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Find Data </label>
            <div class="col-md-9">
                 <el-input placeholder="Type to search" v-model="search" class="input-with-select">
                    <el-button slot="append" icon="el-icon-search"></el-button>
                </el-input>
            </div>
        </div>
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>DOCNO</th>
                    <th>TITLE</th>
                    <th>partno</th>
                    <th>Aircraft </th>
                    <th>acreg </th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(d, i) in data.slice((page-1)*10, 10*page)" :key="i">
                    <td>{{ d.docno }}</td>
                    <td>{{ d.title }}</td>
                    <td>{{ d.partno }}</td>
                    <td>{{ d.aircraft_name }}</td>
                    <td>{{ d.acreg }}</td>
                    <td> <el-button type="success" size="mini"  @click="addTechpub(d)" icon="fa fa-plus" circle></el-button> </td>
                </tr>
                <tr v-if="error != ''">
                    <td colspan="6">{{ error }}</td>
                </tr>
            </tbody>
        </table>
        <el-pagination
            background
            layout="prev, pager, next"
            :page-size="10"
            @current-change="nextPage"
            :total="data.length">
        </el-pagination>
    </div>



    <!-- //manual -->
    <div class="form-horizontal" v-show="manual">
        <div class="form-group">
            <label class="control-label col-lg-3">Document Code</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.document_code" placeholder="Document Code">
                {{ err.document_code }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Type</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.type"  placeholder="Type">
                {{ err.type }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Effective Code</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.effective_code"  placeholder="Effective Code">
                {{ err.effective_code }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Description</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.description_document"  placeholder="Desciption">
                {{ err.description_document }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Manufacture</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.manufacture"  placeholder="Manufacture">
                {{ err.manufacture }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Ac Type</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.ac_type"  placeholder="Ac Type">
                {{ err.ac_type }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Rev</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" v-model="input.rev"  placeholder="Update">
                {{ err.rev }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Rev Date</label>
            <div class="col-lg-9">
              <el-date-picker v-model="input.rev_date" type="date" placeholder="Rev Date" value-format="yyyy-MM-dd"></el-date-picker>
                {{ err.rev_date }}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Attachment </label>
            <div class="col-lg-9">
                <el-upload
                  class="upload-demo"
                  :action="url + '/upload'"
                  :on-success="uploadSuccess"
                  :on-change="handleChange"
                  :on-remove="handleRemove"
                  :file-list="fileList"
                  :before-upload="beforeAvatarUpload"
                  >
                  <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-primary" @click="add()" >Add</button>
                <router-link :to="{ name: 'request' }" class="btn btn-danger">Cancel </router-link>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return{
            url : BASE_URL + 'submit_aircraft', base_url : BASE_URL ,error : '',
            fileList : [], input : {}, err : {}, data : [], search : '', page : 1,
            manual : true , techpub : false, input_by : 'techpub' , search_type : 'docno'
        }
    },
    watch:{
        search(v) {
            if(this.search_type == 'actype'){
                if(v.length >= 3){
                    this.getData()
                }
            }else{
                if(v.length > 5){
                    this.getData()
                }
            }
        },

        'input_by': function(v, o) {
            if(v === 'techpub'){
                this.techpub = true
                this.manual = false
            }
            if(v === 'manual'){
                this.manual = true
                this.techpub = false
            }
        },
    },
    methods : {
        nextPage(page) {
            this.page = page
            console.log(page);
        },
        getData(){
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
              spinner: 'el-icon-loading',
              background: 'rgba(0, 0, 0, 0.7)'
            });
            // var = ''
            if(this.search_type === 'docno'){
                var search_by = 'search_type=docno&search='+this.search
            }
            if(this.search_type === 'nama'){
                var search_by = 'search_type=nama&search='+this.search
            }
            if(this.search_type === 'actype'){
                var search_by = 'search_type=actype&search='+this.search
            }

            axios.get(this.base_url+'store/techpub/1?'+search_by).then((res) => {
                if(res.data.status == 0){
                    this.$message.error(res.data.message);
                    this.error = 'No documents were found'
                    this.data = []
                }else{
                    this.data = res.data
                    this.error = ''
                }
                console.log(res.data);
                loading.close()
            })
        },
        add(){
            this.test = this.input.document_code
            if(this.input.document_code != null && this.input.type != null && this.input.effective_code != null
                && this.input.rev_date != null && this.input.rev != null && this.input.ac_type != null && this.input.manufacture != null
                && this.input.description_document != null ){
                    this.$emit('add', this.input )
                    this.input = {}
                    this.fileList = []
                }else {
                    if(this.input.document_code == null ){ this.err.document_code = "Document Code Can't Null" }
                    if(this.input.type == null ){ this.err.type = "Type Can't Null" }
                    if(this.input.effective_code == null ){ this.err.effective_code = "Effective Code Can't Null" }
                    if(this.input.rev == null ){ this.err.update = "Rev Can't Null" }
                    if(this.input.rev_date == null ){ this.err.update = "Rev Date Can't Null" }
                    if(this.input.ac_type == null ){ this.err.ac_type = "Ac Type Can't Null" }
                    if(this.input.manufacture == null ){ this.err.manufacture = "Manufacture Can't Null" }
                    if(this.input.description_document == null ){ this.err.description_document = "Description Can't Null" }
                }
        },
        addTechpub(d){
            this.input.document_code = d.docno
            this.input.type = ''
            this.input.effective_code = ''
            this.input.update = ''
            this.input.ac_type = d.aircraft_name
            this.input.manufacture = ''
            this.input.description_document = d.title
            this.input.attachment = d.pdffile
            this.$emit('add', this.input )
            this.input = {}
        },
        uploadSuccess(response, file, fileList) {
            if(response.success == true){
                this.input.attachment = response.file
            }else{
                this.$message.error(response.message);
            }
        },
        beforeAvatarUpload(file) {
            const isPDF = file.type === 'application/pdf';

            if (!isPDF) {
              this.$message.error('Type File must be PDF format!');
            }
            return isPDF;
        },
        handleChange(file, fileList){
            if(file.response != null){
                // console.log(response.index);
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        const test =  fileList.slice(-1);
                        console.log(test);
                        this.list_document[file.response.index].fileList =  test
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleRemove(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                console.log(res.data);
            })
            .catch((err) => {

            })
        },
    }
}
</script>

<style lang="css">
.test {
    display: none ;
}
</style>
