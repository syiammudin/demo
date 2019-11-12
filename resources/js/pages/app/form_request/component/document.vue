<template>
<div class="form-horizontal">
    <div class="form-group">
        <label class="col-lg-3">Document Type</label>
            <div class="col-lg-9">
                <el-select  v-model="input.document_type"  clearable placeholder="Select Document type" >
                    <el-option label="Maintenance Manual" value="Maintenance Manual"> </el-option>
                    <el-option label="Maintenance Instruction" value="Maintenance Instruction"> </el-option>
                </el-select>
            <span v-if="err.document_type" class="text-danger"> {{ err.document_type[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="input.document_type == 'Maintenance Manual'">
            <label class="col-lg-3">Manual Status Confirmation</label>
            <div class="col-lg-9">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="ManualConfirmation"
                    :on-change="handleChangeManualConfirmation"
                    :on-remove="handleRemoveManualConfirmation"
                    :file-list="fileListManualConfirmation"
                    :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
                <span v-if="err.manual_status_confirmation" > {{ err.manual_status_confirmation[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.document_type == 'Maintenance Manual'">
            <label class="col-lg-3">Component Maintenance Manual</label>
            <div class="col-lg-9">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="ComponentMainteance"
                    :on-change="handleChangeComponentMainteance"
                    :on-remove="handleRemoveComponentMainteance"
                    :file-list="fileListComponentMainteance"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
                <span v-if="err.component_maintenance_manual" > {{ err.component_maintenance_manual[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.document_type == 'Maintenance Instruction'">
            <label class="col-lg-3">Proposed PD Sheet {{ role_request == 3 ? '':'(*)' }}</label>
            <div class="col-lg-9">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="ProposedpdSheet"
                    :on-change="handleChangeProposedpdSheet"
                    :on-remove="handleRemoveProposedpdSheet"
                    :file-list="fileListProposedpdSheet"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
                <span v-if="err.proposed_pd_sheet" > {{ err.proposed_pd_sheet[0] }}</span>
            </div>
        </div>

    <div class="form-group">
        <label class="label-control col-lg-3">Document</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.no_document" placeholder="No Document" >
            <span v-if="err.no_document" > {{ err.no_document[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="input.document_type == 'Maintenance Manual'">
        <label class="label-control col-lg-3">Rev</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.rev" placeholder="Rev">
            <span v-if="err.rev" > {{ err.rev[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="input.document_type == 'Maintenance Manual'">
        <label class="label-control col-lg-3">Rev Date</label>
        <div class="col-lg-9">
            <el-date-picker v-model="input.rev_date" type="date" placeholder="Rev Date" value-format="yyyy-MM-dd"></el-date-picker>
            <span v-if="err.rev_date" > {{ err.rev_date[0] }}</span>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="label-control col-lg-3">Attachment</label>
        <div class="col-lg-9">
            <el-upload
              class="upload-demo"
              :action="url+'/attachment'"
              :on-change="handleChange"
              :on-remove="handleRemove"
               :before-upload="beforeAvatarUpload"
              :file-list="fileList">
              <el-button size="small" type="primary">Click to upload</el-button>
              <div slot="tip" class="el-upload__tip">File PDF</div>
            </el-upload>
            <span v-if="err.attachment" > {{ err.attachment[0] }}</span>
        </div>
    </div> -->
    <div class="line-dashed"> </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <el-button @click="id_document == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ id_document == null ? 'Add ': 'Update' }} </el-button>
        </div>
    </div>
    <span v-if="input.document_type == 'Maintenance Instruction' || role_request != 3">
      (*) Mandatory Item
    </span>
</div>
</template>

<script>
export default {
    props : ['id','id_document','index_document'],
    data() {
        return {
            baseurl : BASE_URL ,
            url : BASE_URL + 'submit_component_document' ,  attach : {} ,
            fileListManualConfirmation : [],
            fileListComponentMainteance : []  ,
            fileListProposedpdSheet : [],
            err : [] ,
            input : {},
            role_request : ROLE_REQUEST

        }
    },
    mounted(){
        this.getData();
    },
    methods : {
        getData(){
            if(this.id_document != null){
                axios.get(this.url+'/'+this.id_document).then(res => {
                    this.input = res.data

                    if(res.data.manual_status_confirmation != null){
                        this.fileListManualConfirmation = [{name: res.data.manual_status_confirmation, url: this.baseurl+'uploads/component/attachment/'+res.data.manual_status_confirmation}]
                    }
                    if(res.data.component_maintenance_manual != null){
                        this.fileListComponentMainteance =  [{  name: res.data.component_maintenance_manual, url: this.baseurl+'uploads/component/attachment/'+res.data.component_maintenance_manual}]
                    }
                    if(res.data.proposed_pd_sheet != null){
                        this.fileListProposedpdSheet =  [{ name: res.data.proposed_pd_sheet, url: this.baseurl+'uploads/component/attachment/'+res.data.proposed_pd_sheet}]
                    }
                })
                .catch(error => {

                })
            }
        },
        // validate before upload
        beforeAvatarUpload(file) {
            const isPDF = file.type === 'application/pdf';

            if (!isPDF) {
              this.$message.error('Type File must be PDF format!');
            }
            return isPDF;
        },

        // handle handleChange
        handleChangeManualConfirmation(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListManualConfirmation = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangeComponentMainteance(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListComponentMainteance = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangeProposedpdSheet(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListProposedpdSheet = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },

        // on upload
        ManualConfirmation(response, file, fileList){
            this.input.manual_status_confirmation =  response.file
        },
        ComponentMainteance(response, file, fileList){
            this.input.component_maintenance_manual =  response.file
        },
        ProposedpdSheet(response, file, fileList){
            this.input.proposed_pd_sheet = response.file
        },

        // handleremove
        handleRemoveManualConfirmation(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                this.input.manual_status_confirmation =  undefined
            })
        },
        handleRemoveComponentMainteance(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                this.input.component_maintenance_manual =  undefined
            })
        },
        handleRemoveProposedpdSheet(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                this.input.proposed_pd_sheet = undefined
            })
        },
        save(){
            if(this.input.document_type == 'Maintenance Manual' && this.input.manual_status_confirmation == undefined && this.input.component_maintenance_manual == undefined){
                this.$alert("Please Attach one of the document", 'Warning', {
                    confirmButtonText: 'OK',
                });
            }

            if(this.role_request != 3){
              if(this.input.document_type == 'Maintenance Instruction' && this.input.proposed_pd_sheet == undefined){
                this.$alert("Please Attach proposed PD Sheet  document", 'Warning', {
                  confirmButtonText: 'OK',
                })
              }
            }

            this.input.request_submittion_id = this.id
            if(this.input.document_type == 'Maintenance Manual' && (this.input.manual_status_confirmation != undefined || this.input.component_maintenance_manual != undefined)
              ||(this.input.document_type == 'Maintenance Instruction' && this.input.proposed_pd_sheet != undefined && this.role_request != 3) || this.role_request == 3){
                axios.post(this.url, this.input).then((res) => {
                    if(res.data.status == 1){
                        this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                        this.input = {}
                        this.fileListManualConfirmation = []
                        this.fileListComponentMainteance = []
                        this.fileListProposedpdSheet = []
                        res.data.data.index = this.index_document
                        this.$emit('addDocument', res.data.data)
                    }else{
                        this.$alert(res.data.message, 'Warning', {
                            confirmButtonText: 'OK',
                        });
                    }
                })
                .catch((error) => {
                    this.err = error.response.data.errors
                })
            }
        },
        update(){
            axios.put(this.url+'/'+this.id_document, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Update '+this.input.name+' Success'  });
                    this.input = {}
                    this.fileListManualConfirmation = []
                    this.fileListComponentMainteance = []
                    this.fileListProposedpdSheet = []
                    res.data.data.index = this.index_document
                    this.$emit('addDocument', res.data.data)
                }else{
                    this.$alert(res.data.message, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors
            })
        }
    }
}
</script>

<style lang="css">
</style>
