<template>
<div>
    <div>
        <div class="panel panel-default form-horizontal ">
            <div class="form-group">
                <div class="login-container">
                    <div class="login-content">
                        <div class="form-group text-center" >
                            <el-upload
                                class="upload-demo"
                                drag
                                :action="url+'/attachment'"
                                :on-preview="handlePreview"
                                :on-remove="handleRemove"
                                :file-list="fileList"
                                :on-change="handleChange"
                                >
                                <i class="el-icon-upload"></i>
                                <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
                                <div class="el-upload__tip" slot="tip">(.PDF) The Document Should PDF</div>
                            </el-upload>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-dashed"></div>
            <div class="form-group">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-primary" @click="save(id)" >Save </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['id','index'],
    data (){
        return {
            url : BASE_URL + 'vendor_attach', fileList : [] , attachment : ''
        }
    },
    methods : {
        handlePreview(file){
            console.log(file);
        },
        handleRemove(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                console.log(res.data);
            })
            .catch((err) => {

            })
        },
        handleChange(file, fileList){
            if(file.response != null){
                this.attachment = file.response.file
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        save(id){
            axios.put(this.url+'/vendor_attachment/'+id, { 'attachment' : this.attachment }).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Upload Success'  });
                    this.$emit('endAttach', { 'attachment' : this.attachment, 'index' : this.index })
                }else{
                    this.$message({  type: 'warning', message: 'Upload Failed'  });
                }
            })
            .catch((err) => {

            })
        }
    }
}
</script>

<style lang="css">
</style>
