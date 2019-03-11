import * as actions from './actions'
import mutations from './mutations'
import getters from './getters'
import searchModules from './searchModules'

let modules = {
  ...searchModules
}

export default function() {
  return {
    modules,
    mutations,
    getters
  }
}