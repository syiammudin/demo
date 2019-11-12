<template>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">File</label>
            <div class="col-md-9">
                <el-upload class="upload-demo" :action="url + '/upload'" :on-success="onProses"
                    :on-change="handleChange"
                    :on-remove="removeUpload"
                    :file-list="fileList"
                    :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary btn-sm" @click="Add()">Add Attachment</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['index', 'type'] ,
    data(){
        return {
            url : BASE_URL + 'submit_aircraft', fileList : [], input : {}
        }
    },
    methods : {
        Add(){
            this.input.index = this.index
            this.$emit('add', this.input );
            this.input = {}
            this.fileList = []
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
                if(fileList.length > 1){
                    axios.post(this.url+'='+this.type, fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        removeUpload(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.name, 'type' : this.type } ).then((res) => {
                this.input.attachment = null
            })
        },
        onProses(response, file, fileList){
            this.input.attachment = response.file
        },
    }
}
</script>

<style lang="css" scoped>
</style>
