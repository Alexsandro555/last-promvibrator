import module_actions from './actions.js'
import standart_actions from '@/vuex/actions.js'
import mutations from './mutations.js'
import module_getters from './getters.js'

var actions=Object.assign({}, module_actions)
var getters=Object.assign({}, module_getters)

const state = {
    count: 0,
    total: 0,
    cart: [],
    modal: false
}

const module = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

export default module;