<template>
    <!-- <div class="page-container sidebar-collapsed can-resize"> -->
    <div class="page-container">
        <navigationMenu></navigationMenu>
        <div class="main-container gray-bg">
            <headers></headers>
            <!-- Main content -->
            <div class="main-content" >
                <router-view></router-view>

                <!-- Footer -->
                <footer class="animatedParent animateOnce z-index-10">
                    <div class="footer-main animated fadeInUp slow">&copy; 2019 <strong>QAPPS</strong> Admin Theme by <a target="_blank" href="#/">LAMJAYA GLOBAL SOLUSI</a> </div>
                </footer>
                <!-- /footer -->
            </div>
            <!-- /main content -->
        </div>
    </div>
</template>
<script>
  import navigationMenu from './components/Menues.vue'
  import headers from './components/Headers.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      navigationMenu, headers
    }
  }
</script>

<style scoped>
    .main-content{
        min-height:1200px;
    }
</style>
