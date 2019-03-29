import {ACTIONS} from '@product/constants'
import {api} from '@/api/main'

export default {
  [ACTIONS.SAVE_DATA]: ({getters, commit}, data) => {
    return new Promise((resolve, reject) => {
      api.patch({url: getters.config.load, data}).then(response => {
        commit('UPDATE_ARRAY_BY_KEY',{module:getters.config.module,variable:getters.config.items,key:getters.config.primary_key,value:response.sku}, { root: true })
        response.attribute_sku_options.forEach(option => {
          commit('UPDATE_ARRAY_BY_KEY',{module:'attribute_sku_options',variable:'items',key:'id',value:option}, { root: true })
        })
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  }
}