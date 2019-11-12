<template>
    <div class="row">

        <!--
        <div class="col-lg-2 col-md-6 z-index-50 " v-if="role == 4">
            <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                <div class="panel-heading clearfix" style="background-color : #808080 ;" >
                    <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign</div>
                </div>
                <router-link class="title" :to="{ name : aproval }">
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 2).length }}</h1>
                            <h1 class="no-margins" v-else></h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-pencil"></i> </div>
                    </div>
                </router-link>
            </div>
        </div> -->

        <div class="col-lg-12" v-if='role == 3 || role == 4'>
            <div class="row">
                <div class="col-lg-3 col-md-6 z-index-50 " v-if="role_request != 2">
                    <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                        <div class="panel-heading clearfix" style="background-color : #808080 ;" >
                            <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign
                              {{ role_request == 1 ? 'Aircraft' : role_request == 3 ? 'Engine' : role_request == 4 ? 'Special' : 'Vendor Management' }}
                              Request
                            </div>
                        </div>
                        <!-- panel body -->
                        <router-link class="title" :to="{ name : assign }">
                            <div class="panel-body">
                                <div class="stack-order">
                                    <div v-if="role == 3">
                                        <h1 class="no-margins" v-if='role_request != 5'>{{ data.filter(ar => ar.master_request_id == role_request && ar.status == 1).length }}</h1>
                                        <h1 class="no-margins" v-else>{{ data.filter(ar => ar.status == 1).length }}</h1>
                                    </div>
                                    <div v-if="role == 4">
                                        <h1 class="no-margins" v-if='role_request != 5'>{{ data.filter(ar => ar.master_request_id == role_request && ar.status == 2).length }}</h1>
                                        <h1 class="no-margins" v-else>{{ data.filter(ar => ar.status == 2).length }}</h1>
                                    </div>
                                    <small>Request</small>
                                </div>
                                <div class="icons"> <i class="fa fa-pencil"></i> </div>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 z-index-50 " v-if="role_request == 2 || role_request == 3">
                    <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                        <div class="panel-heading clearfix" style="background-color : #808080 ;" >
                            <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign Component Request</div>
                        </div>
                        <!-- panel body -->
                        <router-link class="title" :to="{ name : 'component_request' }">
                            <div class="panel-body">
                                <div class="stack-order">
                                    <div v-if="role == 3">
                                        <h1 class="no-margins">{{ dataComponent.filter(ar => ar.status == 1).length }}</h1>
                                    </div>
                                    <div v-if="role == 4">
                                        <h1 class="no-margins">{{ dataComponent.filter(ar => ar.status == 2).length }}</h1>
                                    </div>
                                    <small>Request</small>
                                </div>
                                <div class="icons"> <i class="fa fa-pencil"></i> </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 z-index-50 " v-if='(role == 3 && role_request != 2 ) || (role == 4 && role_request != 2 )|| (role ==2 && role_request == 3)'>
            <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                {{ role_request == 1 ? 'Aircraft' : role_request == 3 ? 'Engine' : role_request == 4 ? 'Special' : 'Vendor Management' }}
            </div>
        </div>

        <div v-if='(role == 2 || role == 3 || role == 4) && role_request != 2'>
            <div class="col-lg-2 col-md-6 z-index-50 " >
                <div class="panel minimal panel-default" style="background-color : orange ;">
                    <div class="panel-heading clearfix" style="background-color : #FF6347 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">User Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if='role_request != 5'>{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 1).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => (parseInt(ar.status)+1) == 1).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : powderblue ;">
                    <div class="panel-heading clearfix" style="background-color : #006298 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Manager Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 2).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 2).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : powderblue ;">
                    <div class="panel-heading clearfix" style="background-color : #006298 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;"> GM Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 3).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 3).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">QSA Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && (parseInt(ar.status)+1 == 4 || parseInt(ar.status)+1 == 9) ).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 4 &&  parseInt(ar.status)+1 == 8).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">GM QSA Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 5).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 5).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Approved</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 6).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 6).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : pink ;">
                    <div class="panel-heading clearfix" style="background-color : #DC143C ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Rejected </div>
                    </div>
                    <!-- panel body -->
                    <router-link class="title" :to="{ name : customLink(role_request) }">
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" v-if="role_request != 5">{{ data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 7).length + data.filter(ar => ar.master_request_id == role_request && parseInt(ar.status)+1 == 8).length }}</h1>
                            <h1 class="no-margins" v-else>{{ data.filter(ar => parseInt(ar.status)+1 == 7).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </router-link>
                </div>
            </div>
        </div>

        <!-- khusus untuk component -->
        <div class="col-lg-12 z-index-50 " v-if='(role_request == 2 || role_request == 3) && role_request != 5'>
            <div class="panel minimal panel-default" style="background-color : gainsboro ;">
              <span v-if="role_request == 3">Engine</span> Component
            </div>
        </div>

        <div v-if='role_request == 2 || role_request == 3' >
            <div class="col-lg-2 col-md-6 z-index-50 " >
                <div class="panel minimal panel-default" style="background-color : orange ;">
                    <div class="panel-heading clearfix" style="background-color : #FF6347 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">User Proses</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 1).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : powderblue ;">
                    <div class="panel-heading clearfix" style="background-color : #006298 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Manager Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 2).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : powderblue ;">
                    <div class="panel-heading clearfix" style="background-color : #006298 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">GM Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 3).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">QSA Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 4 || parseInt(ar.status)+1 == 9).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">GM QSA Task</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 5).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : limegreen ;">
                    <div class="panel-heading clearfix" style="background-color : #006400 ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Approved</div>
                    </div>
                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 6).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : pink ;">
                    <div class="panel-heading clearfix" style="background-color : #DC143C ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Rejected </div>
                    </div>
                    <!-- panel body -->
                    <router-link class="title" :to="{ name : customLink(role_request) }">
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 7).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </router-link>
                </div>
            </div>
            <!-- <div class="col-lg-2 col-md-6 z-index-50 ">
                <div class="panel minimal panel-default" style="background-color : pink ;">
                    <div class="panel-heading clearfix" style="background-color : #DC143C ;" >
                        <div class="panel-title" style="color : white ; font-weight: : bold ;">Rejected By GM QSA</div>
                    </div>
                    <router-link class="title" :to="{ name : customLink(role_request) }">
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins" >{{ dataComponent.filter(ar => parseInt(ar.status)+1 == 9).length }}</h1>
                            <small>Request</small>
                        </div>
                        <div class="icons"> <i class="fa fa-plane"></i> </div>
                    </div>
                </router-link>
                </div>
            </div> -->
        </div>

    </div>
</template>

<script>

export default {

    data(){
        return {
            data : [], url : BASE_URL, role : ROLE, role_request : ROLE_REQUEST, component_type : COMPONENT_TYPE,
            aproval : '', assign : '', dataComponent : []
        }
    },
    mounted(){
        this.component()
        this.getData()
        if(this.role_request == 1){
            this.aproval = 'aproval_aircraft'
            this.assign = 'aircraft_request'
        }
        if(this.role_request == 2){
            this.aproval = 'aproval_component'
            this.assign = 'component_request'
        }
        if(this.role_request == 3){
            this.aproval = 'aproval_engine'
            this.assign = 'engine_requests'
        }
        if(this.role_request == 4){
            this.aproval = 'aproval_special'
            this.assign = 'special_request'
        }
        if(this.role_request == 5){
            this.aproval = 'vendor_management'
            this.assign = 'vendor_management'
        }

    },
    methods : {
        component(){
            axios.get(this.url+'/dashboard/component/12').then((res) => {
                this.dataComponent = res.data
                console.log(res.data);
            })
            .catch((error) => {
                console.log(err);
            })
        },
        getData(){
            axios.get(this.url+'/dashboard').then((res) => {
                this.data = res.data
                console.log(res.data);
            })
            .catch((error) => {
                console.log(err);
            })
        },
        customLink(d) {
            if(d == 1){
                return 'aircraft_request';
            }
            if(d == 2){
                return 'component_request';
            }
            if(d == 3){
                return 'engine_requests';
            }
            if(d == 4){
                return 'special_request'
            }
            if(d == 5){
                return 'vendor_management'
            }
        },
    }
}
</script>

<style lang="css">
</style>
