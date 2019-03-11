import module_actions from './actions.js'
import standart_actions from '@/vuex/actions.js'
import module_mutations from './mutations.js'
import standart_mutations from '@/vuex/mutations.js'
import module_getters from './getters.js'

var actions = Object.assign({}, module_actions, standart_actions)
var getters = Object.assign({}, module_getters)
var mutations = Object.assign({}, module_mutations, standart_mutations)

const state = {
  name: 'Callback',
  items: [],
  item: {},
  form: {
    fio:'',
    company_name: '',
    telephone: '',
    email: '',
    comment: ''
  },
  url: 'callback',
  fields: [],
  isVisible: false,
  model: 'Modules\\Callback\Entities\Callback::class'
}

const module = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}

export default module;
