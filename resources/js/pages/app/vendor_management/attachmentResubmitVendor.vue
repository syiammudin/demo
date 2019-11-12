<template>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">File (JPG, PNG, JPEG)</label>
            <div class="col-md-9">
                <el-upload class="upload-demo" :action="url + '/attachment?type='+type" :on-success="onProses"
                    :on-change="handleChange"
                    :on-remove="removeUpload"
                    :file-list="fileList"
                    :before-upload="beforeAvatarUpload"
                    >
                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                </el-upload>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-md-3">Note </label>
            <div class="col-md-9">
                <textarea name="name" class="form-control" rows="8" v-model='input.note'></textarea>
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
    props : ['id', 'type'] ,
    data(){
        return {
            url : BASE_URL + 'attachmentResubmitVendor', fileList : [], input : {}
        }
    },
    methods : {
        Add(){
            this.input.request_submittion_id = this.id
            axios.post(this.url, this.input).then((res) => {
                this.$emit('add', res.data.data )
                this.input = {}
                this.fileList = []
            })
            .catch((err) => {
                console.log(err);
            })
        },
        beforeAvatarUpload(file) {
            const isJPG = file.type === 'image/jpeg';
            const isPNG = file.type === 'image/png';

            if (!isJPG) {
              this.$message.error('Type File must be JPEG format!');
            }

            return isJPG || isPNG;
        },
        handleChange(file, fileList){
            if(file.response != null){
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file?type='+this.type, fileList[0].response ).then((res) => {
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
