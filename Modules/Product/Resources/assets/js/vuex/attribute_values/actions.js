import { GLOBAL } from "@/constants";
import { ACTIONS, PRIVATE } from "@product/constants"
import { api } from "@/api/main.js";
import axios from "axios/index";

export default {
    [ACTIONS.SAVE_DATA]: ({commit, state, getters, dispatch},data) => {
      axios.patch(getters.config.load, data).then(response => response.data).then(response => {
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
        dispatch('successSaveNotification', response.message, {root: true})
      })
    }
}