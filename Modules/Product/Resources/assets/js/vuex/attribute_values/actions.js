import { GLOBAL } from "@/constants";
import { ACTIONS, PRIVATE } from "@product/constants"
import { api } from "@/api/main.js";
import axios from "axios/index";

export default {
    [ACTIONS.SAVE_DATA]: ({commit, state, getters, dispatch},data) => {
      axios.patch(getters.config.load, data).then(response => response.data).then(response => {
        console.log(new Date())
        commit('SET_ARRAY_VARIABLE', {variable: 'items', value: response})
        console.log(new Date())
        dispatch('successSaveNotification', response.message, {root: true})
      })
    }
}