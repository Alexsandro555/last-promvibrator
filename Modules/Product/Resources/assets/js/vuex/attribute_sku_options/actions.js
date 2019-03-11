import { GLOBAL } from "@/constants";
import { ACTIONS, PRIVATE } from "@product/constants"
import { api } from '@/api/main.js'
import axios from 'axios'

export default {
    [ACTIONS.SAVE_DATA]: ({commit, state},data) => {
      /*api.path({url: state.url, data}).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
      })*/
      axios.patch(state.url, data).then(response => response.data).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
      })
    }
}