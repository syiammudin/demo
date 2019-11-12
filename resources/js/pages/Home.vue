<template >
<div>
    <div class="col-lg-12">
        <div class="alert alert-success" >
            Welcome {{ auth_name }} in Our Website
        </div>
    </div>
    <div class="col-lg-12">
        <!-- <admin v-if="role == 1" />
        <qsa v-if="role == 5 || role == 6" />
        <user v-if="role != 1" /> -->
        <!-- <charts /> -->
        <dashboard />
    </div>
</div>
</template>

<script>
// import admin from './dashboard/admin'
// import user from './dashboard/user'
// import charts from './dashboard/charts'
// import qsa from './dashboard/qsa'
import dashboard from './Demo/dashboard'
export default {
    components: { dashboard },
    data() {
        return {
            auth_name : AUTH_LOGIN_NAME, role : ROLE
        }
    }
}
</script>

<style lang="css">
.icons {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    top: -20px;
    right: 10px;
    z-index: 0;
    font-size: 90px;
    color: rgba(0,0,0,0.15);
}
</style>
