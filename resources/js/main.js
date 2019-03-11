import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)

//==========Vuetify========================================
import Vuetify from 'vuetify'
// Импорт CSS-файлов, которые могут потребоваться
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
import createStore from "./vuex/states";
Vue.use(Vuetify)

import LeftMenu from '@/vue/LeftMenu'
Vue.component('left-menu', LeftMenu)

import DetailImage from '@file/vue/DetailImage'
Vue.component('detail-image', DetailImage)

import { mapActions, mapMutations } from 'vuex'
import {ACTIONS, MUTATIONS} from '@cart/constants'

import CartWidget from '@cart/vue/Widget'
import mutations from "./vuex/mutations";
import getters from "./vuex/getters";
Vue.component('cart-widget',CartWidget)

import CartModal from '@cart/vue/CartModal'
Vue.component('cart-modal', CartModal)

import CartPage from '@cart/vue/Cart'
Vue.component('cart-page', CartPage)


// Обратный звонок
import Callback from '@callback/vue/Callback.vue'
import callback from '@callback/vuex/callbacks/state'
Vue.component('callback', Callback)

import cart from '@cart/vuex/store'
const store = new Vuex.Store({
  modules: {
    cart,
    callback
  },
  mutations,
  getters
  }
)

const app = new Vue({
  el: '#app',
  data: {
    searchText: '',
  },
  store,
  methods: {
    addCart(id) {
      const count = 1
      this.addCartItem({id, count})
      this.showCartModal()
    },
    search() {
      const text = this.searchText.replace('/','_')
      window.location.href='/find/'+ text
      this.searchText = ''
    },
    showCallback() {
      this.$store.commit('SET_VARIABLE', {module: 'callback', variable: 'isVisible', value: true})
    },
    ...mapActions('cart',{addCartItem: ACTIONS.ADD_CART}),
    ...mapMutations('cart', {showCartModal: MUTATIONS.SHOW_MODAL})
  }
})