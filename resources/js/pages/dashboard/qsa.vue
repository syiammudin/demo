<template >
<div >
    <div v-for="(r, i) in RoleRequest" class="col-lg-3 col-md-6 z-index-50 " :key="i" :v-if="role == 5 || role == 6">
        <div class="panel minimal panel-default" :style="'background-color :'+ bodyColor(r.id) ">
            <div class="panel-heading clearfix" :style="'background-color : '+ headColor(r.id)" >
                <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign </div>
            </div>
            <router-link class="title" :to="{ name : customLink(r.id) }">
                <div class="panel-body">
                    <div class="stack-order">
                        <div v-if="role == 5">
                            <h1 class="no-margins" v-if="r.id != 5">{{ data.filter(d => d.master_request_id == r.id && d.status == 3 ).length + data.filter(d => d.master_request_id == r.id && d.status == 8 ).length}}</h1>
                            <h1 class="no-margins" v-else>{{ dataVendor.filter(ar => ar.status == 3).length + dataVendor.filter(ar => ar.status == 8).length }} </h1>
                        </div>
                        <div v-if="role == 6">
                            <h1 class="no-margins" v-if="r.id != 5">{{ data.filter(d => d.master_request_id == r.id && d.status == 4 ).length }}</h1>
                            <h1 class="no-margins" v-else>{{ dataVendor.filter(ar => ar.status == 4).length }}</h1>
                        </div>
                        <small>{{ r.name }}</small>
                    </div>
                    <div class="icons"> <i class="fa fa-pencil"></i> </div>
                </div>
            </router-link>
        </div>
    </div>


</div>
</template>

<script>
export default {
    computed: {
        RoleRequest() { return this.$store.state.RoleRequest } ,
    },
    created() {
        this.$store.commit('getRoleRequest');
    },
    data(){
        return {
            data : [], url : BASE_URL, role : ROLE, role_request : ROLE_REQUEST,
            aproval : '', assign : '', dataVendor : []
        }
    },
    mounted(){
        this.getData()
        this.getDataVendor()
    },
    methods : {
        getData(){
            axios.get(this.url+'/dashboard').then((res) => {
                this.data = res.data
                console.log(res.data);
            })
            .catch((error) => {
                console.log(err);
            })
        },
        getDataVendor(){
            axios.get(this.url+'/dashboard?type=vendor').then((res) => {
                this.dataVendor = res.data
                console.log(res.data);
            })
            .catch((error) => {
                console.log(err);
            })
        },
        customLink(d) {
            if(d == 1){
                return 'aproval_aircraft';
            }
            if(d == 2){
                return 'aproval_component';
            }
            if(d == 3){
                return 'aproval_engine';
            }
            if(d == 4){
                return 'aproval_special'
            }
            if(d == 5){
                return 'aproval_vendor'
            }
        },
        headColor(d) {
            if(d == 1){
                return '#FF0000';
            }
            if(d == 2){
                return '#006298';
            }
            if(d == 3){
                return '#84BD00';
            }
            if(d == 4){
                return 'brown'
            }
            if(d == 5){
                return 'indigo'
            }
        },
        bodyColor(d) {
            if(d == 1){
                return '#FFDAB9';
            }
            if(d == 2){
                return 'powderblue';
            }
            if(d == 3){
                return '#98FB98';
            }
            if(d == 4){
                return '#FFE4E1'
            }
            if(d == 5){
                return '#D8BFD8'
            }
        },
    }
}
</script>

<style lang="css" scoped>
</style>
