<template>
    <v-flex xs6 text-align-left class="cart__info">
        <span class="cart__gold">{{count}}</span> товара на<br>
        <span class="cart__gold">{{total}}</span> руб.
    </v-flex>
</template>
<script>
    import { ACTIONS, MUTATIONS, GETTERS } from "@cart/constants"
    import { mapState, mapActions, mapMutations, mapGetters } from 'vuex'
    export default {
        props: {},
        data: function() {
            return {
            }
        },
        mounted() {
            this.load()
        },
        computed: {
            ...mapGetters('cart', {total: GETTERS.TOTAL_CART, count: GETTERS.QTY_CART}),
        },
        methods: {
            ...mapActions('cart',{load: ACTIONS.LOAD}),
            ...mapMutations('cart', {show: MUTATIONS.SHOW_MODAL})
        }
     }
</script>