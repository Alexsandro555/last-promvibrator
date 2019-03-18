<template>
  <div>
    <slot :count="count" :cart="cart" :total="total"></slot>
  </div>
</template>
<script>
  import { mapState, mapGetters } from 'vuex'
  import CartElement from './CartElement.vue'
  import { GETTERS } from '@cart/constants.js'

  export default {
    computed: {
      ...mapState('cart', ['count', 'total', 'cart']),
      ...mapGetters('cart', {total: GETTERS.TOTAL_CART})
    },
  }
</script>
