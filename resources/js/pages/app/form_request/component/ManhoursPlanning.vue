<template>
<div class="form-horizontal">
    <div class="form-group">
        <label class="label-control col-lg-3">Task Name</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.task_name" placeholder="Task Name" >
            <span v-if="err.task_name" > {{ err.task_name[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">Man Hours</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.man_hour" placeholder="Man Hours">
            <span v-if="err.man_hour" > {{ err.man_hour[0] }}</span>
        </div>
    </div>
    <div class="form-group">
        <label class="label-control col-lg-3">Man Powers</label>
        <div class="col-lg-9">
            <input type="text" class="form-control" v-model="input.man_power" placeholder="Man Powers">
            <span v-if="err.man_power" > {{ err.man_power[0] }}</span>
        </div>
    </div>

    <div class="line-dashed"> </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <el-button @click="id_manhours == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ id_manhours == null ? 'Add' : 'Update' }} </el-button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['id','id_manhours','index_manhours'],
    data() {
        return {
            url : BASE_URL + 'submit_componentManhoursPlanning' ,  attach : {} ,fileList : [] , err : [] ,
            input : {},

        }
    },
    mounted(){
        this.getData() ;
    },
    methods : {
        getData(){
            if(this.id_manhours != null){
                axios.get(this.url+'/'+this.id_manhours).then(res => {
                    this.input = res.data
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        save(){
            this.input.request_submittion_id = this.id
            axios.post(this.url, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                    this.input = {}
                    this.fileList = []
                    res.data.data.index = this.index_manhours
                    this.$emit('addManhoursPlanning', res.data.data )
                }else{
                    this.$alert(res.data.message, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                }
            })
            .catch((error) => {
                this.err = error.response.data.errors
            })
        },
        update(){
            this.input.request_submittion_id = this.id
            axios.put(this.url+'/'+this.id_manhours, this.input).then((res) => {
                if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Update  '+this.input.name+' Success'  });
                    this.input = {}
                    this.fileList = []
                    res.data.data.index = this.index_manhours
                    this.$emit('addManhoursPlanning', res.data.data )
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
