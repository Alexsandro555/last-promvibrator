<template>
  <div class="cart" ref="cart">
    <h1>Корзина</h1>
    <div>
      <div style="background-color: white">
        <table class="cart-table">
          <thead>
          <th class="center">фото</th>
          <th>наименование</th>
          <th class="center">кол-во</th>
          <th class="center">цена</th>
          <th class="center">удалить</th>
          </thead>
          <tbody>
          <cart-element v-for="cartItem in cart" :key="cartItem.rowId" :cart-item="cartItem"></cart-element>
          <tr class="cart-table__total">
            <td colspan="2"></td>
            <td colspan="3"><span>Итого: <span>{{total}}</span> руб.</span></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
  import { mapState, mapGetters } from 'vuex'
  import CartElement from './CartElement.vue'
  import { GETTERS } from '@cart/constants.js'

  export default {
    props: {},
    data: function() {
      return { }
    },
    mounted() {
      //console.log(this.$refs.cart.el)
    },
    computed: {
      ...mapState('cart', ['count', 'total', 'cart']),
      ...mapGetters('cart', {total: GETTERS.TOTAL_CART})
    },
    components: {
      CartElement
    }
  }
</script>

<style scoped>
  .center {
    text-align: center;
  }
</style>