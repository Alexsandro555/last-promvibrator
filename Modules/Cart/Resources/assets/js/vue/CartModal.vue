<template>
    <div id="baskets">
        <modal-window v-if="modal" @close="closeModal" :width="800">
            <div class="callback_close" @click="closeModal"></div>
            <table width="100%" class="cart-table">
                <thead class="cart-header">
                    <tr>
                        <th class="center" colspan="6">
                            Корзина товаров
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Наименование товара</th>
                        <th>Количество</th>
                        <th>Стоимость</th>
                        <th>Артикул</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody cellpadding="0" cellspacing="0">
                    <cart-item v-for="cartItem in cart" :key="cartItem.rowId" :cart-item="cartItem"></cart-item>
                </tbody>
                <tfoot>
                <tr valign="middle">
                    <td colspan="1"></td>
                    <td colspan="3" align="right">
                        Общая стоимость с НДС 20%:
                    </td>
                    <td colspan="2" align="center">{{totalCart}}₽</td>
                </tr>
                </tfoot>
            </table>
            <br>
            <center>
                <a href="/order" class="cart-submit">Оформить</a>
            </center>
            <br>
        </modal-window>
    </div>
</template>
<script>
    import { mapGetters, mapActions, mapState, mapMutations } from 'vuex'
    import { GETTERS, ACTIONS, MUTATIONS } from "@cart/constants"
    import ModalWindow from "./ModalWindow"
    import CartItem from "./CartItem"

    export default {
        props: { },
        data: function() {
            return {
            }
        },
        mounted() {
            this.load()
        },
        computed: {
            ...mapState('cart', ['cart', 'modal']),
            ...mapGetters('cart', {totalCart: GETTERS.TOTAL_CART, QtyCart: GETTERS.QTY_CART}),
        },
        components: {
            ModalWindow,
            CartItem
        },
        methods: {
            closeModal() {
                this.close();
            },
            ...mapActions('cart',{ load: ACTIONS.LOAD }),
            ...mapMutations('cart',{ close: MUTATIONS.CLOSE_CART_MODAL })
        }
     }
</script>

<style>

</style>