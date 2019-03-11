<template>
    <tr>
        <td>
            <img class="cart-img" :src="cartItem.options.filename"/>
        </td>
        <td>
            <a :href="cartItem.options.slug" class="cart-table-title">{{cartItem.name}}</a><br>
            <span v-if="cartItem.options.article">арт. {{cartItem.options.article}}</span>
        </td>
        <td class="cart-table-counter">
            <div class="detail-counter">
                <div @click="downQty(cartItem.rowId)"  class="detail-counter__left"><img src="images/detail-cart-arr-down.png"/></div>
                <div class="detail-counter__center">{{cartItem.qty}}</div>
                <div @click="upQty(cartItem.rowId)" class="detail-counter__right"><img src="images/detail-cart-arr-up.png"/></div>
            </div>
        </td>
        <td class="cart-table-td-price"><span class="cart-table-price"> {{cartItem.price}}</span><span class="cart-table-rub"> руб.</span></td>
        <td class="cart-table-del"><a href="#" @click.prevent="cartDelete(cartItem.rowId)"><img src="images/cart-table-del.png"/></a></td>
    </tr>
</template>
<script>
    import { mapActions } from 'vuex'
    import { ACTIONS } from '@cart/constants.js'

    export default {
        name: 'CartElement',
        props: {
            cartItem: Object,
        },
        data: function() {
            return {}
        },
        methods: {
            ...mapActions('cart', {downQty: ACTIONS.DOWN_QTY, upQty: ACTIONS.UP_QTY, cartDelete: ACTIONS.DELETE})
        }
    }
</script>