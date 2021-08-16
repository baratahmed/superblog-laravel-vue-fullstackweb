/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor'
// global register
Vue.use(Editor);

import Vuex from 'vuex'
Vue.use(Vuex)
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import storeData from './store/index.js'
const store = new Vuex.Store(
    storeData
)

import {filter} from './filter'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/admin/AdminMaster.vue').default);
Vue.component('front-master', require('./components/front/FrontMaster.vue').default);
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

import Swal from 'sweetalert2'
window.Swal = Swal
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.toast = toast




import {routes} from './routes'
import Vue from 'vue';

const router = new VueRouter({
    routes,
    mode: 'hash',
})

const app = new Vue({
    el: '#app',
    router,
    store,
});
