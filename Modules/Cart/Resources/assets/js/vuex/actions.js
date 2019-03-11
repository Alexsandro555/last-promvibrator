import { ACTIONS, PRIVATE } from "@cart/constants"
import { cartApi } from "@cart/api/cart"

export default {
    [ACTIONS.LOAD]: ({commit}) => {
        cartApi.get().then(response => {
            commit(PRIVATE.SET_CART, response.cart)
            commit(PRIVATE.SET_TOTAL_AND_COUNT, {count: response.count, total: response.total})
        }).catch(err => {})
    },
    [ACTIONS.ADD_CART]: ({commit}, data) => {
        cartApi.patch(data).then(response => {
            commit(PRIVATE.SET_CART, response)
        }).catch(err => {})
    },
    [ACTIONS.UP_QTY]: ({commit, state}, id) => {
        commit(PRIVATE.UP_QTY, id)
        let qty = state.cart.find(item => item.rowId === id).qty
        cartApi.setQty({id,qty})
            .then(response => {})
            .catch(err => {})
    },
    [ACTIONS.DOWN_QTY]: ({commit, state}, id) => {
        commit(PRIVATE.DOWN_QTY, id)
        let qty = state.cart.find(item => item.rowId === id).qty
        cartApi.setQty({id,qty})
            .then(response => {})
            .catch(err => {})
    },
    [ACTIONS.DELETE]: ({commit}, rowId) => {
        commit(PRIVATE.DELETE, rowId)
        cartApi.delete(rowId)
            .then(response => {})
            .catch(error => {})
    }
}