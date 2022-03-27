require('./bootstrap');
import App from './App.vue'
import router from './router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
window.Vue = require('vue').default;
const app = new Vue({
    router,
    components: { App }
}).$mount('#app')
