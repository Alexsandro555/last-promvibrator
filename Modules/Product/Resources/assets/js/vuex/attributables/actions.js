import {ACTIONS} from '@product/constants'
import {api} from '@product/api/Attributables'

export default {
  [ACTIONS.REMOVE_BIND_ATTRIBUTES]: ({commit, dispatch, getters}, data) => {
    return new Promise((resolve, reject) => {
      api.delete({url: getters.config.load, data}).then(response => {
        commit('UPDATE_ARRAY_BY_KEY',{module:getters.config.module,variable:getters.config.items,key:getters.config.primary_key,value:response.attributable}, { root: true })
        //commit('UPDATE_ARRAY_BY_KEY',{module:'attribute_values',variable:'items',key:'id',value:response.attribute_values}, { root: true })
        commit('SET_ARRAY_VARIABLE2', {module:'attribute_values',variable:'items',key:'id',value:response.attribute_values}, { root: true })
        dispatch('successSaveNotification', 'Успешно исключено!', {root: true})
        resolve(response)
      })
    })
  }
}