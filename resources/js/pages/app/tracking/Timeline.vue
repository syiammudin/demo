<template>
<div class="">
    <div class="row">
        <div class="col-lg-12  z-index-41">
            <div class="panel panel-default  ">
                <div class="panel-heading no-border clearfix">
                    <div class="col-md-6">
                        <h1 class="page-title">Timeline Tracking</h1>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-danger" @click="$router.go(-1)"><i class="fa fa-reply-all"></i> Back </button>
                    </div>
                </div>
                <div class="panel-body">
                    <el-steps :active="track" :finish-status="track == 6 ? 'error' : 'success'" >
                      <el-step title="Submit" v-if="track >= 1"  description="User"></el-step>
                      <el-step title="Accept" v-if="track >= 2"  description="Manager"></el-step>
                      <el-step title="Accept" v-if="track >= 3 && track != 6"  description="Genereal Manager" ></el-step>
                      <el-step title="Approve" v-if="track >= 4"  description="QSA" ></el-step>
                      <el-step title="Approve" v-if="track >= 5"  description="GM QSA" ></el-step>
                      <el-step title="Reject" v-if="track >= 6"  description="GM QSA" ></el-step>

                      <!-- <el-step title="Processing" description="User" v-if="track == 0"></el-step> -->
                      <el-step title="Processing" description="Manager" v-if="track == 1"></el-step>
                      <el-step title="Processing" description="General Manager" v-if="track == 2"></el-step>
                      <el-step title="Processing" description="QSA" v-if="track == 3"></el-step>
                      <el-step title="Processing" description="GM QSA" v-if="track == 4"></el-step>

                      <el-step title="Step 1" v-if="track == 0" description="User"></el-step>
                      <el-step title="Step 2" v-if="track < 1" description="Manager"></el-step>
                      <el-step title="Step 3" v-if="track < 2" description="General Manager"></el-step>
                      <el-step title="Step 4" v-if="track < 3" description="QSA"></el-step>
                      <el-step title="Step 5" v-if="track < 4" description="GM QSA"></el-step>
                    </el-steps>
                </div>
                <div class="line-dashed"></div>
                <div class="panel-heading no-border clearfix">
                    <h1 class="page-title">Histories</h1>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Status </th>
                                <th># </th>
                                <th>Note </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, n) in data" :key="n">
                                <td :class="d.status == 6 ? 'text-danger' : d.status == 5 ? 'text-success' : ''">{{ n+1 }}</td>
                                <td :class="d.status == 6 ? 'text-danger' : d.status == 5 ? 'text-success' : ''">{{ d.created_at }}</td>
                                <td :class="d.status == 6 ? 'text-danger' : d.status == 5 ? 'text-success' : ''">
                                    {{ $store.state.Status.find(st => st.id === parseInt(d.status)).status }}
                                    <!-- <a :href="base_url+'detailHistory/'+d.id" target="_blank" v-if='d.status == 6' class="bg-danger">
                                     </a> -->
                                    <span  v-if='d.status != 6'>{{ $store.state.Status.find(st => st.id === parseInt(d.status)).status }}
                                    </span>
                                </td>
                                <td :class="d.status == 6 ? 'text-danger' : d.status == 5 ? 'text-success' : ''">{{ d.name }}</td>
                                <td :class="d.status == 6 ? 'text-danger' : d.status == 5 ? 'text-success' : ''"><pre>{{ d.note }}</pre></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            url : BASE_URL + 'tracking_timeline' , track : 0, data : [], base_url : BASE_URL, role_request : ROLE_REQUEST

        }
    },
    computed: {
        Status() { return this.$store.state.Status } ,
        idRequest(){ return this.type }
    },
    created(){
        this.$store.commit('getStatus');
        this.getData() ;
    },
    props: ['type'] ,
    methods : {
        getData() {
            axios.get(this.url+'/'+this.idRequest).then((res) => {
                this.track = parseInt(res.data.status)
                this.data = res.data.request_history
            })
            .catch((err) => {

            })
        },
        back(){
            if(this.role_request == 1){
                this.$router.push('/aircraft_request');
            }
            if(this.role_request == 2){
                this.$router.push('/component_request');
            }
            if(this.role_request == 3){
                this.$router.push('/engine_request');
            }
            if(this.role_request == 4){
                this.$router.push('/special_request');
            }
        }
    }
}
</script>

<style lang="css">

</style>
