<template>
    <!-- Page Sidebar -->
    <div class="page-sidebar " style="width:280px;">
        <!-- Site header  -->
        <header class="site-header">
          <br>
          <!-- <div class="site-logo"><router-link class="title" :to="{ name   : 'home' }"><h2><strong><img :src="baseURL+'images/logo_fix.png'" alt=""> </strong></h2> </router-link></div> -->
          <div class="sidebar-collapse hidden-xs" ><a @click="HideUser()" class="sidebar-collapse-icon" href="#" ><i class="icon-menu"></i></a></div>
          <div class="text-center nameUser" style=" margin-right:-60px;" v-if="user == true">
            <div class="col-md-12">
              <img width="44" class="img-circle avatar" alt=""  :src="baseURL+'images/default.png'">
              <br>
              <span class="nameUser" style="font-size:12pt;">{{ name }}</span> <br>
              <!-- <span class="nameUser">{{ id_number  }}</span> -->
              <br>
            </div>
          </div>

          <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>

        </header>

        <!-- /site header -->
        <ul id="side-nav" class="main-menu navbar-collapse collapse">
            <li ><router-link class="title" :to="{ name : 'home' }"><i class="icon-home"></i><span class="title"> Home </span> </router-link></li>
            <!-- <li v-if="role == 2 && role_request != 5 || role == 3 && role_request != 5"><router-link class="title" :to="{ name : 'request' }"><i class="icon-docs"></i><span class="title">Request </span> </router-link></li> -->
            <li class="has-sub"><a href="#"><i class="icon-layout"></i><span class="title">Request List</span></a>
                <ul class="nav collapse">
                    <!-- <li v-if="role_request == 1 || role == 1 || role == 5 || role == 6"><router-link class="title" :to="{ name : 'aircraft_request' }"><i class="icon-docs"></i><span class="title"> List Aircraft Request</span>  <span v-if="role == 3" class="badge badge-secondary pull-right"></span> </router-link></li>
                    <li v-if="role_request == 2 || role_request == 3 || role == 1 || role == 5 || role == 6"><router-link class="title" :to="{ name : 'component_request' }"><i class="icon-docs"></i><span class="title"> List Component Request</span> <span v-if="role == 3" class="badge badge-secondary pull-right"></span> </router-link></li>
                    <li v-if="role_request == 3 || role == 1 || role == 5 || role == 6"><router-link class="title" :to="{ name : 'engine_requests' }"><i class="icon-docs"></i><span class="title"> List Engine Request</span>  <span v-if="role == 3" class="badge badge-secondary pull-right"></span> </router-link></li>
                    <li v-if="role_request == 4 || role == 1 || role == 5 || role == 6"><router-link class="title" :to="{ name : 'special_request' }"><i class="icon-docs"></i><span class="title"> List Special Request</span>  <span v-if="role == 3" class="badge badge-secondary pull-right"></span> </router-link></li>
                    <li v-if="role_request == 5 || role == 1 || role == 5 || role == 6"><router-link class="title" :to="{ name : 'vendor_management' }"><i class="icon-docs"></i><span class="title">Vendor Management </span> <span v-if="role == 3" class="badge badge-secondary pull-right"></span>  </router-link></li> -->
                    <li ><router-link class="title" :to="{ name : 'medicalclaim' }"><i class="icon-docs"></i><span class="title">Medical Claim </span> <span v-if="role == 3" class="badge badge-secondary pull-right"></span>  </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'nda' }"><i class="icon-docs"></i><span class="title">NDA </span> <span v-if="role == 3" class="badge badge-secondary pull-right"></span>  </router-link></li>
                    <!-- {{ $store.state.Notif }} -->
                </ul>
            </li>

            <!-- aproval start -->
            <!-- <li v-if="role == 5 || role == 6" class="has-sub"><a href="#"><i class="icon-layout"></i><span class="title">List Need Approval</span></a>
                <ul class="nav collapse">
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'aproval_aircraft' }"><i class="icon-docs"></i><span class="title"> Approval Aircraft</span> <span v-if="role == 4" class="badge badge-secondary pull-right"></span></router-link></li>
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'aproval_component' }"><i class="icon-docs"></i><span class="title"> Approval Component</span> <span v-if="role == 4" class="badge badge-secondary pull-right"></span></router-link></li>
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'aproval_engine' }"><i class="icon-docs"></i><span class="title"> Approval Engine</span> <span v-if="role == 4" class="badge badge-secondary pull-right"></span></router-link></li>
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'aproval_special' }"><i class="icon-docs"></i><span class="title"> Approval Special</span> <span v-if="role == 4" class="badge badge-secondary pull-right"></span></router-link></li>
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'aproval_vendor' }"><i class="icon-docs"></i><span class="title"> Approval Vendor</span> <span v-if="role == 4" class="badge badge-secondary pull-right"></span></router-link></li>
                </ul>
			       </li> -->
            <!-- approval end  -->

            <!-- capability_lists -->
            <!-- <li v-if="role == 5 || role == 6" class="has-sub"><a href="#"><i class="icon-layout"></i><span class="title">Capability List</span></a>
                <ul class="nav collapse">
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'vendor_capability' }"><i class="icon-docs"></i><span class="title"> Vendor Capability List</span> </router-link></li>
                    <li v-if="role == 5 || role == 6"><router-link class="title" :to="{ name : 'component_capability' }"><i class="icon-docs"></i><span class="title"> Component Capability List</span> </router-link></li>
                </ul>
            </li> -->
            <!-- end CapabilityList -->

            <li v-if="role == 1" class="has-sub"><a href="#"><i class="icon-layout"></i><span class="title">Master Data</span></a>
                <ul class="nav collapse">
                    <li><router-link class="title" :to="{ name : 'line_maintenance' }"><i class="icon-docs"></i><span class="title">Line Maintenance</span> </router-link></li>
                    <li><router-link class="title" :to="{ name : 'base_maintenance' }"><i class="icon-docs"></i><span class="title">Base Maintenance</span> </router-link></li>
                    <li><router-link class="title" :to="{ name : 'workshop' }"><i class="icon-docs"></i><span class="title">Workshop</span> </router-link></li>
                    <li><router-link class="title" :to="{ name : 'aircraft_type' }"><i class="icon-docs"></i><span class="title">Aircraft Type</span> </router-link></li>
                    <li><router-link class="title" :to="{ name : 'master_request' }"><i class="icon-docs"></i><span class="title">Master Request</span> </router-link></li>
                    <li><router-link class="title" :to="{ name : 'type_supplier' }"><i class="icon-docs"></i><span class="title">Type Supplier</span> </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'part_number' }"><i class="icon-docs"></i><span class="title">Part Number</span> </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'questionare' }"><i class="icon-docs"></i><span class="title">Questionnaire</span> </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'ndt_method' }"><i class="icon-docs"></i><span class="title">NDT Methods</span> </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'for_rating' }"><i class="icon-docs"></i><span class="title">For Rating</span> </router-link></li>
                    <li ><router-link class="title" :to="{ name : 'customer_aircraft' }"><i class="icon-docs"></i><span class="title">Customer Aircraft</span> </router-link></li>
                    <!-- <li><router-link class="title" :to="{ name : 'unit_of_measures' }"><i class="icon-docs"></i><span class="title">Unit of Unit of Measure</span> </router-link></li> -->
                </ul>
            </li>
            <li v-if="role == 1"><router-link class="title" :to="{ name : 'user' }"><i class="icon-user"></i><span class="title">User </span> </router-link></li>
            <li v-if="role == 1"><router-link class="title" :to="{ name : 'app_config' }"><i class="icon-cog"></i><span class="title">App Config</span> </router-link></li>
        </ul>
  </div>
  <!-- /page sidebar -->
</template>
<script>
  export default {
    data() {
      return {
        baseURL: BASE_URL, auth_id : AUTH_LOGIN_ID , role_request: ROLE_REQUEST , role : ROLE, name : AUTH_LOGIN_NAME, id_number : AUTH_LOGIN_ID_NUMBER, user : true
      }
    },
    mounted() {
        // if(this.role == 3 || this.role == 4){
        //     setInterval(() => {
        //         this.$store.commit('getNotif');
        //     }, 1000);
        // }
    },
    methods : {
        HideUser(){
          if(this.user == true){
            this.user = false
          }else{
            this.user = true
          }
        }
    }
  }
</script>
