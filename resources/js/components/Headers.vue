<template>
    <!-- Main header -->
    <div class="main-header row">
      <div class="col-sm-12 col-xs-7">
        <!-- User info -->
        <ul class="user-info pull-right">
          <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">{{ name }} <span class="caret"></span></a>
            <!-- User action menu -->
            <ul class="dropdown-menu">
              <li><router-link class="title" :to="{ name : 'my_profile' }"><i class="icon-user"></i>My profile</router-link></li>
              <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout" ></i>Logout</a></li>
            </ul>
            <!-- /user action menu -->
          </li>
        </ul>
        <!-- /user info -->

      </div>
    </div>
    <!-- /main header -->
</template>

<script>
export default {
    data() {
        return{
             name : AUTH_LOGIN_NAME
        }
    },
}
</script>

<style lang="css">
</style>
