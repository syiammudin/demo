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
                <el-upload class="upload-demo" :action="url + '/attachment?type=document'" :on-success="ManualConfirmation"
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
            <label class="col-lg-3">Reference Manual</label>
            <div class="col-lg-9">
                <el-upload class="upload-demo" :action="url + '/attachment?type=document'" :on-success="ComponentMainteance"
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
            <label class="col-lg-3">Proposed PD Sheet (*)</label>
            <div class="col-lg-9">
                <el-upload class="upload-demo" :action="url + '/attachment?type=document'" :on-success="ProposedpdSheet"
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
            <el-button @click="index_document == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ index_document == null ? 'Add ': 'Update' }} </el-button>
        </div>
    </div>
    <span v-if="input.document_type == 'Maintenance Instruction'">
      (*) Mandatory Item
    </span>
</div>
</template>

<script>
export default {
    props : ['type','index_document','data_document'],
    data() {
        return {
            baseurl : BASE_URL ,
            url : BASE_URL + 'submit_special' ,  attach : {} ,
            fileListManualConfirmation : [],
            fileListComponentMainteance : []  ,
            fileListProposedpdSheet : [],
            err : [] ,
            input : {},

        }
    },
    mounted(){
        this.getData();
    },
    methods : {
        getData(){
            if(this.index_document !=  undefined){
              this.input = JSON.parse(JSON.stringify(this.data_document))
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
            // if(this.input.document_type == 'Maintenance Manual' && this.input.manual_status_confirmation == undefined && this.input.component_maintenance_manual == undefined){
            //     this.$alert("Please Attach one of the document", 'Warning', {
            //         confirmButtonText: 'OK',
            //     });
            // }
            // if(this.input.document_type == 'Maintenance Instruction' && this.input.proposed_pd_sheet == undefined){
            //     this.$alert("Please Attach proposed PD Sheet  document", 'Warning', {
            //         confirmButtonText: 'OK',
            //     })
            // }
            //
            // this.input.request_submittion_id = this.id
            // if(this.input.document_type == 'Maintenance Manual' && (this.input.manual_status_confirmation != undefined || this.input.component_maintenance_manual != undefined)
            //   || this.input.document_type == 'Maintenance Instruction' && this.input.proposed_pd_sheet != undefined){
            //
            //     this.$emit('addDocument', this.input)
            // }
            this.$emit('addDocument', this.input)
        },
        update(){
          this.input.index = this.index_document
          this.$emit('addDocument', this.input)
        }
    }
}
</script>

<style lang="css">
</style>
