<template>
    <div class="row">
        <div v-show="requestlist" v-for="(d, i) in data" :key="i"  class="z-index-41">
            <div class="col-lg-6" v-if="d.id == role_request || role_request == 3 && d.id == 2" >
                <div class="panel panel-default">
                    <div class="panel-heading no-border clearfix">
                        <div class="panel figure">
                            <img :src="base_url+'picture/'+d.picture" alt="" class="img-responsive" >
                        </div>
                        <h2><strong><span v-if="role_request == 3 && d.id == 2">Engine</span>  {{ d.title }}</strong></h2>
                        <p>{{ d.description }}</p>
                        <hr>
                        <!-- <button type="button" @click='createrequest(d)' class="btn btn-primary">t </button> -->
                        <router-link :to="d.id == 2 || d.id == 1 ? { name: d.link, params: { type : '0' } } : { path: d.link+'/'+d.title+'/add' }" class="btn btn-primary"> Create Request</router-link>
                        <router-link :to="d.id == 2 ? { path: d.link+'/change' } : { path: d.link+'/'+d.title+'/change' } " class="btn btn-success"> Change Request</router-link>
                        <router-link :to="d.id == 2 ? { path: d.link+'/delete' } : { path: d.link+'/'+d.title+'/delete' } " class="btn btn-danger "> Delete </router-link>
                    </div>
                </div>
            </div>
        </div>
        <!-- <aircraft v-show='showrequest' :type='type' @simpan="simpan"></aircraft> -->
    </div>
</template>
<script>

export default {
    mounted(){
        this.getData() ;
    },
    data() {
        return{
             data : [],
             base_url : BASE_URL,
             url : BASE_URL + 'MasterRequest',
             role_request: ROLE_REQUEST ,
             type : '' , showrequest : false , requestlist : true

        }
    },
    methods : {
        simpan(){
            this.requestlist = true
            this.showrequest = false
        },
        createrequest(data){
            this.type = data
            this.requestlist = false
            this.showrequest = true
        },
        getData(){
            axios.get(this.url ).then((res) =>{
                this.data = res.data
                console.log(res.data)
            })
            .catch((err) => {
                console.log(err)
            })
        },
    }
}
</script>

<style lang="css">
.figure {
    height:225px;
    overflow:hidden;
}

.figure > img {
    display:block;
    margin:0 auto;
}
</style>
