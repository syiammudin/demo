
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 import ECharts from 'vue-echarts' // refers to components/ECharts.vue in webpack

 // import ECharts modules manually to reduce bundle size
 import 'echarts/lib/chart/bar'
 import 'echarts/lib/component/tooltip'

 // If you want to use ECharts extensions, just import the extension package and it will work
 // Taking ECharts-GL as an example:
 // You only need to install the package with `npm install --save echarts-gl` and import it as follows
 import 'echarts-gl'

 // register component to use
 Vue.component('v-chart', ECharts)


import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
import VueRouter from 'vue-router'

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'
Vue.use(ElementUI, { locale });

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import store from './store'

import Index from './Index'
import router from './router'
import FormAttacheVendor from './pages/vendor/FormAttacheVendor'
import Decision from './pages/app/decision/Decision'
import DecisionVendor from './pages/app/decision/DecisionVendor'

Vue.router = router
Vue.use(VueRouter)

Vue.component('index', Index)
Vue.component('vendor', FormAttacheVendor)
Vue.component('decision', Decision)
Vue.component('decisionvendor', DecisionVendor)

const app = new Vue({
    el: '#app',
    router, store,
});
