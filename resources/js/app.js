
require('./bootstrap');

window.Vue = require('vue');
window.token = localStorage.getItem("e-shop-sss");
//import vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import routes from './routes'

//import vform
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

//vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from './index'
const store = new Vuex.Store(
    storeData
)

//moment js
import moment from 'moment'
Vue.filter('shortLength', (text, lenght, suffix) => {
    return text.substring(0, lenght) + suffix;
})
Vue.filter('postTime', (value) => {
    return moment(value).fromNow();
})

//toast alart
import Swal from 'sweetalert2'
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Swal = Swal;
  window.Toast = Toast;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const  app = () => import(/* webpackChunkName: "app" */ './components/app.vue')

const router = new VueRouter({
    mode: 'hash',
    routes

});


new Vue({
    router,
    store,
    render: h => h(app)
}).$mount('#app');
