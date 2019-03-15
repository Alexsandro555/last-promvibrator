/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

/**
 * Initialize main libraries
 */
//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)
//==========Vee-validate===================================
import ru from 'vee-validate/dist/locale/ru';
import VeeValidate, { Validator } from 'vee-validate'
//Vue.use(VeeValidate)
//Validator.localize('ru', ru)
//==========Vuetify========================================
import Vuetify from 'vuetify'
// Импорт CSS-файлов, которые могут потребоваться
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

import dateFns from 'date-fns'
// объявление глобальной библиотеки
Vue.mixin(
  {
    data() { return { dateFns } },
  }
)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import createStore from './vuex/states.js'
import { mapActions, mapMutations, mapState } from 'vuex'

import Notifications from '@/vue/Notifications.vue'
Vue.component('notifications', Notifications)

const store = new Vuex.Store(createStore())

import router from './vue/router/vue_router'

const token = localStorage.getItem('user-token')
if (token) {
  axios.defaults.headers.common['Authorization'] = 'Bearer '+token
}

const app = new Vue({
  el: '#app',
  router,
  store,
  created() {
    store.dispatch('initializer/init')
  },
  computed: {
    ...mapState('initializer', ['darkColor']),
  },
  data() {
    return {
      dark: true
    }
  },
  methods: {
    chengeColor() {
      this.dark = !this.dark
    }
  }
});
