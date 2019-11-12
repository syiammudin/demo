<template>
<div>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-3">To Vendor</label>
            <div class="col-md-9">
                <input type="text" class="form-control" v-model="input.email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Message</label>
            <div class="col-md-9">
                <textarea name="name" rows="8" cols="80" class="form-control" v-model="input.message"></textarea>
            </div>
        </div>
        <div class="line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button type="button" class="btn btn-primary" @click="send()"> <i class="fa fa-send-o"></i> Send Email</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props : ['data'],
    data(){
        return{
            input : {}, url : BASE_URL + 'submit_vendor'
        }
    },
    created(){
        console.log(this.data)
        this.input = this.data
        this.input.email = this.data.contact_email
    },
    methods : {
        send(){
            const loading = this.$loading({ lock: true, text: 'Loading', spinner: 'el-icon-loading', background: 'rgba(0, 0, 0, 0.7)' });
            axios.post(this.url+'/sendemail', this.input).then((res) => {
                console.log(res.data)
                this.$message({  type: 'success', message: 'Message Succes Sended'  });
                this.$emit('endMessage')
                loading.close() ;
            })
            .catch((err) => {
                loading.close() ;

            })
        }
    }
}
</script>

<style lang="css">
</style>
