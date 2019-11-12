<template>
<div class="form-horizontal">
    <div class="form-group">
        <label class="label-control col-lg-3">Part Number</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.part_number" placeholder="Part Number" >
            <span v-if="err.part_number" > {{ err.part_number[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">Part Name</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.part_name" placeholder="Part Name">
            <span v-if="err.part_name" > {{ err.part_name[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">Available</label>
        <div class="col-lg-9">
            <el-select  v-model="input.available"  clearable placeholder="Select here" >
                <el-option label="Yes" value="Yes"> </el-option>
                <el-option label="No" value="No"> </el-option>
            </el-select>
            <span v-if="err.available" > {{ err.available[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="component_type == 'TCA' && input.available == 'No'">
        <label class="label-control col-lg-3">Alternate PN</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.alternate_pn" placeholder="Alternate PN">
            <span v-if="err.alternate_pn" > {{ err.alternate_pn[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="component_type == 'TCA' && input.available == 'No'">
        <label class="label-control col-lg-3">Alternate Name</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.alternate_name" placeholder="Alternate Name">
            <span v-if="err.alternate_name" > {{ err.alternate_name[0] }}</span>
        </div>
    </div>
    <div class="form-group" v-if="input.available == 'No'">
        <label class="label-control col-lg-3">Remark</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.remark" placeholder="Remark  ">
            <span v-if="err.remark" > {{ err.remark[0] }}</span>
        </div>
    </div>
    <div class="form-group">
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
        </div>
    </div>
    <div class="line-dashed"> </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <!-- <el-button @click="save()" round icon="fa fa-plus" type="success"> Add </el-button> -->
            <el-button @click="id_special == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ id_special == null ? 'Add' : 'Update' }} </el-button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['id','component_type', 'id_special', 'index_special'],
    data() {
        return {
            url : BASE_URL + 'submit_component_special_tool' ,  attach : {} ,fileList : [] , err : [] ,
            input : {},

        }
    },
    mounted(){
        this.getDataPNSpecialTool()
    },
    methods : {
        getDataPNSpecialTool(){
          if(this.id_special != null){
            axios.get(this.url+'/'+this.id_special).then((res) => {
              this.input = res.data
            })
            .catch((err) => {
              console.log(err);
            })
          }
        },
        update(){
            axios.put(this.url+'/'+this.id_special, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Update '+this.input.name+' Success'  });
                    this.input = {}
                    this.fileList = []
                    res.data.data.index = this.index_special
                    this.$emit('addSpecial', res.data.data)
                }else{
                    this.$alert(res.data.message, 'Warning', {
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch((err) => {

            })
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
                this.input.attachment = file.response.file
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {
                        if(res.data.status == 1){
                            this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                            this.input = {}
                            this.attachment = ''

                        }else{
                            this.$alert(res.data.message, 'Warning', {
                              confirmButtonText: 'OK',
                            });
                        }
                    })
                }
            }
        },
        handleRemove(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                this.input.attachment = undefined
            })
            .catch((err) => {

            })
        },
        save(){
            this.input.request_submittion_id = this.id
            if(this.input.available == "No" && this.input.attachment == undefined){
                this.$alert("Please Attacht Equivalent If your Available No", 'Warning', {
                  confirmButtonText: 'OK',
                });
            }
            if(this.input.available == "Yes" || this.input.available == "No" && this.input.attachment != undefined){
                axios.post(this.url, this.input).then((res) => {
                    if(res.data.status == 1){
                        this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                        this.input = {}
                        this.fileList = []
                        this.$emit('addSpecial', res.data.data)
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
}
</script>

<style lang="css">
</style>
