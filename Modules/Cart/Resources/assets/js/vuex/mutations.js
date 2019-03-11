import { PRIVATE, MUTATIONS } from "@cart/constants";

export default {
    [PRIVATE.SET_CART]: (state, payload) => {
        state.cart = payload
    },
    [PRIVATE.SET_TOTAL_AND_COUNT]: (state, payload) => {
        const {total, count} = payload
        state.total = total
        state.count = count
    },
    [MUTATIONS.CLOSE_CART_MODAL]: (state) => {
        state.modal = false
    },
    [PRIVATE.UP_QTY]: (state, payload) => {
        state.cart.forEach(item => {
            if(item.rowId === payload) {
                item.qty = Number(item.qty) + 1
            }
        })
    },
    [PRIVATE.DOWN_QTY]: (state, payload) => {
        state.cart.forEach(item => {
            if(item.rowId === payload) {
                if(Number(item.qty)>1) {
                    item.qty = Number(item.qty) - 1
                }
            }
        })
    },
    [PRIVATE.DELETE]: (state, payload) => {
        state.cart = state.cart.filter(item => item.rowId !== payload)
    },
    [MUTATIONS.SHOW_MODAL]: (state) => {
        state.modal = true
    }
}