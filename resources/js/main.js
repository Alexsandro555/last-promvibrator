import './bootstrap'

import Vue from 'vue'
window.Vue = Vue

//===========Vuex==========================================
import Vuex from 'vuex'
Vue.use(Vuex)
import { mapActions, mapMutations } from 'vuex'

// Cart
import CartWidget from '@cart/vue/Widget'
Vue.component('cart-widget',CartWidget)
import CartModal from '@cart/vue/CartModal'
Vue.component('cart-modal', CartModal)
import CartPage from '@cart/vue/Cart'
Vue.component('cart-page', CartPage)
import CartOrder from '@cart/vue/CartOrder'
Vue.component('cart-order', CartOrder)
import cart from '@cart/vuex/store'
import {ACTIONS, MUTATIONS} from '@cart/constants'

// Обратный звонок
import Callback from '@callback/vue/callbacks/Callback.vue'
import callback from '@callback/vuex/callbacks/state'
Vue.component('callback', Callback)

// DetailImage
import DetailImage from '@file/vue/DetailImage'
Vue.component('detail-image', DetailImage)

// Products
import Products from '@/vue/Products'
Vue.component('products', Products)

import mutations from "./vuex/mutations";
import getters from "./vuex/getters";
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
      const count = document.getElementById('prod-'+id).value
      this.addCartItem({id, count})
      document.getElementById('prod-'+id).value = 1;
      this.showCartModal()
    },
    upQty(id) {
      let element = document.getElementById('prod-'+id);
      element.value = Number(element.value) + 1;
    },
    downQty(id) {
      let element = document.getElementById('prod-'+id);
      let qty =  Number(element.value);
      if(qty>1) {
        element.value = qty - 1;
      }
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