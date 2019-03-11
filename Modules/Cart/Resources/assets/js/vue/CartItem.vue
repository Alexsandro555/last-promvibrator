<template>
    <tr>
        <td class="center">
            <img :src="cartItem.options.filename" height="40px"/>
        </td>
        <td style="max-width: 100px;">
            <span>{{cartItem.options.type}}</span><br>
            {{cartItem.name}}
        </td>
        <td class="center">
            <div class="tab-li-button">
                <input class="cart-col product_qty2" name="quantity[]" type="text" disabled :value="cartItem.qty">
                <div @click="downQty(cartItem.rowId)" class="div-minus">-</div>
                <div @click="upQty(cartItem.rowId)" class="div-plus">+</div>
            </div>
        </td>
        <td class="center cart-table-rub">{{cartItem.price}}</td>
        <td class="center">{{cartItem.options.article}}</td>
        <td class="center cart-table-del"><a href="#" @click.prevent="cartDelete(cartItem.rowId)"><img :src="'/../images/cart-table-del.png'"/></a></td>
    </tr>
</template>
<script>
    import { ACTIONS } from "@cart/constants";
    import { mapActions } from 'vuex'

    export default {
        props: {
            cartItem: Object,
        },
        data: function() {
            return {}
        },
        methods: {
            ...mapActions('cart',{ delete: ACTIONS.DELETE, upQty: ACTIONS.UP_QTY, downQty: ACTIONS.DOWN_QTY, cartDelete: ACTIONS.DELETE})
        }
    }
</script>
<style scoped>
    .center {
        text-align: center;
    }
    .div-minus {
        background-color: #dadada;
        border: 1px solid #c2c2c2;
        border-radius: 0 0 3px 3px;
        cursor: pointer;
        height: 16px;
        line-height: 14px;
        position: absolute;
        right: 33px;
        text-align: center;
        bottom: 0px;
        width: 22px;
    }
    .div-plus {
        background-color: #dadada;
        border: 1px solid #c2c2c2;
        border-radius: 3px 3px 0 0;
        cursor: pointer;
        height: 16px;
        line-height: 14px;
        position: absolute;
        right: 33px;
        text-align: center;
        top: 0px;
        width: 22px;
    }
    .cart-col{
        background: rgba(0, 0, 0, 0) url("/images/col.png") no-repeat scroll 0 0;
        border: medium none;
        color: #4f4f4f;
        font-weight: 600;
        height: 35px;
        margin-left: 10px;
        text-align: center;
        width: 49px;
    }
    .tab-li-button{
        margin-top: 16px;
        position: relative;
    //text-align: center;
    }
</style>