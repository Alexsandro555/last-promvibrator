import {ADD_CART} from '../../../../../../resources/assets/js/store/mutations'
import module_mutations from './mutations'

const mutations = Object.assign({},module_mutations,ADD_CART)

export default {
    namespaced: true,
    state: {
        count: 0,
        total: 0
    },
    mutations,
    actions: {
        add({ commit }, req) {
            axios.post('/cart/add', {id: req.id}).then((response) => {
                commit('ADD_CART', response.data)
            }).catch((error) => {
                console.log(error)
            })
        },
        current({commit}) {
            axios.get('/cart/current').then(response => {
                commit('CURRENT', response.data)
            }).catch(error => {
                console.log(error)
            })
        }
    }
}