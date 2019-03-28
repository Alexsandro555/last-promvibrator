import { GLOBAL } from "@/constants";
import { ACTIONS, PRIVATE } from "@product/constants"
import { api } from "@/api/main.js";

export default {
    [ACTIONS.SAVE_DATA]: ({commit, state, getters, dispatch},data) => {
      return new Promise((resolve, reject) => {
        api.patch({url: getters.config.load, data}).then(response => {
          //commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
          dispatch('successSaveNotification', response.message, {root: true})
          resolve(response)
        })
      })
    }
}