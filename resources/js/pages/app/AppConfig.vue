<template>
<div class="">
    <div class="col-lg-12  z-index-41">
        <div class="panel panel-default  ">
            <div class="panel-heading no-border clearfix">
                <h1 class="page-title">App Config</h1>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="label-control col-lg-3">Street </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.street">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">City </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Countr </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.country">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Po Box </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.po_box">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Zip Code </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.zip_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Phone </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Fax </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" v-model="input.fax">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Email </label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" v-model="input.email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label-control col-lg-3">Background </label>
                        <div class="col-lg-9">
                            <div class="col-lg-12">
                                <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="onUpload"
                                    :on-change="handleChange"
                                    :on-remove="handleRemove"
                                    :file-list="fileList"
                                    :before-upload="beforeAvatarUpload"
                                    list-type="picture"
                                    >
                                    <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                                </el-upload>
                            </div>
                        </div>
                    </div>

                    <div class="line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <button class="btn btn-primary" @click="save()" >Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            url : BASE_URL + 'submit_app_config', input : {} , baseURL : BASE_URL,
            fileList : []
        }
    },
    mounted(){
        this.getData()
    },
    methods : {
        save(){
            const loading = this.$loading({  lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.put(this.url+'/'+1, this.input).then((res) => {
                if(res.data.status == 1){
                     this.$message({ type: 'success', message: 'Update Success' });
                }else{
                    this.$message({ type: 'danger', message: 'Update Failed' });
                }
                loading.close()
            })
            .catch((err) => {
                loading.close()
            })
        },
        getData(){
            axios.get(this.url+'/'+1).then((res) => {
                this.input = res.data
                this.fileList = [{name: this.input.background, url: this.baseURL+'uploads/WebConfig/'+ this.input.background, response : { file : this.input.background }  }]
            })
            .catch((err) => {
            })
        },
        onUpload(response, file, fileList){
            this.input.background = response.file
        },
        handleChange(file, fileList){
            if(file.response){
                if(fileList.length >= 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleRemove(file, fileList){
            console.log(file);
            if(file.response ){
                axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                    console.log(res.data);
                })
                .catch((err) => {

                })
            }

        },
        beforeAvatarUpload(file){

            const isJPG = file.type === 'image/jpeg';
            const isPNG = file.type === 'image/png';

            if (!isJPG && !isPNG) {
              this.$message.error('Type File must be JPG or PNG format!');
            }

            return isJPG || isPNG;
        }
    }
}
</script>



<style lang="css">
</style>
