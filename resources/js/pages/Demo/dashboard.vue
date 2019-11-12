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

        <div class="col-lg-12" v-if="role != 2">
            <div class="row">
                <div class="col-lg-3 col-md-6 z-index-50 " v-if="role_request != 2">
                    <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                        <div class="panel-heading clearfix" style="background-color : #808080 ;" >
                            <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign
                              Medical Claim
                            </div>
                        </div>
                        <!-- panel body -->
                        <router-link class="title" :to="{ name : 'medicalclaim' }">
                            <div class="panel-body">
                                <div class="stack-order">
                                    <div v-if="role == 3">
                                        <h1 class="no-margins">{{ Medical.filter(f => f.status == 1).length }}</h1>
                                    </div>
                                    <div v-if="role == 4">
                                        <h1 class="no-margins">{{ Medical.filter(f => f.status == 2).length }}</h1>
                                    </div>
                                    <small>Request</small>
                                </div>
                                <div class="icons"> <i class="fa fa-pencil"></i> </div>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 z-index-50 " v-if="role_request != 2">
                  <div class="panel minimal panel-default" style="background-color : gainsboro ;">
                    <div class="panel-heading clearfix" style="background-color : #808080 ;" >
                      <div class="panel-title" style="color : white ; font-weight: : bold ;">Waiting Assign
                        NDA
                      </div>
                    </div>
                    <!-- panel body -->
                    <router-link class="title" :to="{ name : 'nda' }">
                      <div class="panel-body">
                        <div class="stack-order">
                          <div v-if="role == 3">
                            <h1 class="no-margins">{{ nda.filter(f => f.status == 1).length }}</h1>
                          </div>
                          <div v-if="role == 4">
                            <h1 class="no-margins">{{ nda.filter(f => f.status == 2).length }}</h1>
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

    </div>
</template>

<script>

export default {

    data(){
        return {
            data : [], url : BASE_URL, role : ROLE, role_request : ROLE_REQUEST, component_type : COMPONENT_TYPE,
            aproval : '', assign : '', dataComponent : [],
            Medical : [], nda : []
        }
    },
    mounted(){
        this.getNDA()
        this.getMedical()

    },
    methods : {
        getMedical(){
          axios.get(this.url+'MedicalClaim/1').then((res) => {
            this.Medical = res.data
          })
        },
        getNDA(){
          axios.get(this.url+'Nda/1').then((res) => {
            this.nda = res.data
          })
        }
    }
}
</script>

<style lang="css">
</style>
