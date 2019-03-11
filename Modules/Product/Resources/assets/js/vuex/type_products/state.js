import module_actions from './actions.js'
import standart_actions from '@/vuex/actions.js'
import module_mutations from './mutations.js'
import standart_mutations from '@/vuex/mutations.js'
import module_getters from './getters.js'
import standart_getters from '@/vuex/getters'

var actions = Object.assign({}, module_actions, standart_actions)
var getters = Object.assign({}, module_getters, standart_getters)
var mutations = Object.assign({}, module_mutations, standart_mutations)

const state = {
  name: 'TypeProduct',
  items: [],
  fields: [],
  loading: true,
  typeFiles: ['image-type-product'],
  relations: [{column:'product_category_id',module:'product_categories'}, {column: 'tnved_id', module: 'tnveds'}]
}

const module = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}

export default module;

