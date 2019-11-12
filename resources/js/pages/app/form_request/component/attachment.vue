<template >
<div>
    <div class="form-horizontal">

        <div class="form-group" >
            <label class="col-lg-5 control-label">Vendor Statement "No training needed"</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="VendorStatement"
                    :on-change="handleChangevendor_statement"
                    :on-remove="removeVendor"
                    :file-list="fileListvendor_statement"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Simple Component Evaluation Document (EI)</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="SimpleComponentEvaluation"
                    :on-change="handleChangesimple_component_evaluation"
                    :on-remove="removeSimple"
                    :file-list="fileListsimple_component_evaluation"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Component Similarity Form</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="ComponentSimilarity"
                    :on-change="handleChangecomponent_similarity"
                    :on-remove="removeComponent"
                    :file-list="fileListcomponent_similarity"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Maintenance Record for Demo/Experimental</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="MaintenanceRecord"
                    :on-change="handleChangemaintenance_record"
                    :on-remove="removeMaintenance"
                    :file-list="fileListmaintenance_record"
                    :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Sample of component relased record</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="SampleComponentRelase"
                    :on-change="handleChangesample_component_relase"
                    :on-remove="removeSample"
                    :file-list="fileListsample_component_relase"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Others</label>
            <div class="col-lg-7">
                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="Other"
                    :on-change="handleChangeother"
                    :on-remove="removeOther"
                    :file-list="fileListother"
                     :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>

        <div class="line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-9">
                <button class="btn btn-primary" @click="save()" >Save</button>
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
    props : ['id', 'type','file'],
    data() {
        return {
            url : BASE_URL + 'submit_attachment',
            baseurl : BASE_URL,
            input : {},
            fileListvendor_statement : [] ,
            fileListsimple_component_evaluation : [] ,
            fileListcomponent_similarity : [] ,
            fileListmaintenance_record : [] ,
            fileListsample_component_relase : [] ,
            fileListother : [] ,
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        del(d){
            this.$confirm('Do you want Delete this Document ?', 'Norify', { confirmButtonText: 'OK', cancelButtonText: 'Cancel', type: 'warning' }).then(() => {
                axios.put(this.url+'/'+this.id, { 'doc' : d }).then((res) => {
                    if(d == 'manual_status_confirmation'){
                        this.input.manual_status_confirmation =  null
                    }
                    if(d == 'component_maintenance_manual'){
                        this.input.component_maintenance_manual = null
                    }
                    if(d == 'proposed_pd_sheet'){
                        this.input.proposed_pd_sheet = null
                    }
                    if(d == 'simple_component_evaluation'){
                        this.input.simple_component_evaluation = null
                    }
                    if(d == 'component_similarity'){
                        this.input.component_similarity = null
                    }
                    if(d == 'maintenance_record'){
                        this.input.maintenance_record
                    }
                    if(d == 'sample_component_relase'){
                        this.input.sample_component_relase
                    }
                    if(d == 'other'){
                        this.input.other
                    }
                    if(d == 'vendor_statement'){
                        this.input.vendor_statement
                    }
                    this.$message({  type: 'success', message: 'Delete Attachment Success'  });
                })
                .catch((err) => {
                    console.log(err);
                })
            }).catch(() => {
              this.$message({ type: 'info', message: 'Delete canceled' });
            });
        },
        getData(){
            this.input = this.file
            if(this.file.vendor_statement != null){
                this.fileListvendor_statement = [{type : 'vendor_statement',name: this.file.vendor_statement, url: this.baseurl+'uploads/component/attachment/'+this.file.vendor_statement}]
            }
            if(this.file.simple_component_evaluation != null){
                this.fileListsimple_component_evaluation =  [{ type : 'simple_component_evaluation', name: this.file.simple_component_evaluation, url: this.baseurl+'uploads/component/attachment/'+this.file.simple_component_evaluation}]
            }
            if(this.file.component_similarity != null){
                this.fileListcomponent_similarity =  [{ type : 'component_similarity', name: this.file.component_similarity, url: this.baseurl+'uploads/component/attachment/'+this.file.component_similarity}]
            }
            if(this.file.maintenance_record != null){
                this.fileListmaintenance_record =  [{ type : 'maintenance_record', name: this.file.maintenance_record, url: this.baseurl+'uploads/component/attachment/'+this.file.maintenance_record}]
            }
            if(this.file.sample_component_relase != null){
                this.fileListsample_component_relase =  [{ type : 'sample_component_relase', name: this.file.sample_component_relase, url: this.baseurl+'uploads/component/attachment/'+this.file.sample_component_relase}]
            }
            if(this.file.other != null){
                this.fileListother =  [{id : 'other', name: this.file.other, url: this.baseurl+'uploads/component/attachment/'+this.file.other}]
            }
        },
        save(){
            this.input.request_submittion_id = this.id
            axios.post(this.url, this.input).then((res) => {
                console.log(res.data);
                this.$message({  type: 'success', message: 'Save Attachment Success'  });
                this.$emit('loadAttachment', this.input );
            })
            .catch((error) =>{
                console.log(console.error());
            })
        },
        beforeAvatarUpload(file) {
            const isPDF = file.type === 'application/pdf';

            if (!isPDF) {
              this.$message.error('Type File must be PDF format!');
            }
            return isPDF;
        },
        handleChangevendor_statement(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListvendor_statement = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangesimple_component_evaluation(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListsimple_component_evaluation = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangecomponent_similarity(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListcomponent_similarity = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangeother(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListother = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangemaintenance_record(file, fileList){
            console.log(fileList[0]);
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListmaintenance_record = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleChangesample_component_relase(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileListsample_component_relase = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        removeVendor(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.vendor_statement = null
            })
        },
        removeSimple(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.simple_component_evaluation = null
            })
        },
        removeComponent(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.component_similarity = null
            })
        },
        removeMaintenance(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.maintenance_record = null
            })
        },
        removeSample(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.sample_component_relase = null
            })
        },
        removeOther(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name } ).then((res) => {
                this.input.other = null
            })
        },
        remove(d){
            console.log(d);
        },
        VendorStatement(response, file, fileList){
            this.input.vendor_statement = response.file
        },
        SimpleComponentEvaluation(response, file, fileList){
            this.input.simple_component_evaluation = response.file
        },
        ComponentSimilarity(response, file, fileList){
            this.input.component_similarity = response.file
        },
        MaintenanceRecord(response, file, fileList){
            this.input.maintenance_record = response.file
        },
        SampleComponentRelase(response, file, fileList){
            this.input.sample_component_relase = response.file
        },
        Other(response, file, fileList){
            this.input.other = response.file
        },
    }
}
</script>

<style lang="css">
</style>
