import actions from './actions'
import getters from './getters'

const state = {
  notifications: []
}

const module = {
  namespaced: true,
  getters,
  actions,
  state
}

export default module;