import {ACTIONS, MUTATIONS} from '@auth/constants'
import {api} from '@auth/api/auth'
import axios from "axios/index";

export default {
  [ACTIONS.GET_USERNAME]: ({state, commit}) => {
    api.get(state.url).then(response => {
      commit('SET_VARIABLE', {module: 'Auth', variable: 'username', value: response})
    })
  },
  [ACTIONS.REGISTER]: ({state, commit}, data) => {
    return new Promise((resolve, reject) => {
      //commit(MUTATIONS.AUTH_REQUEST)
      api.post('/api/register', data).then(response => {
        const token = response.success.token
        localStorage.setItem('user-token', token)
        axios.defaults.headers.common['Authorization'] = token
        //commit(MUTATIONS.AUTH_SUCCESS, token)
        resolve(response)
      }).catch(error => {
        //commit(MUTATIONS.AUTH_ERROR, error)
        localStorage.removeItem('user-token')
        reject(error)
      })
    })
  },
  [ACTIONS.LOGIN]: ({state, rootState, dispatch, commit}, data) => {
    return new Promise((resolve, reject) => {
      commit(MUTATIONS.AUTH_REQUEST)
      api.post('/api/login', data).then(response => {
        const token = response.success.token
        if(token) {
          localStorage.setItem('user-token', token)
          commit(MUTATIONS.AUTH_SUCCESS, token)
          axios.defaults.headers.common['Authorization'] = 'Bearer '+token

          /*for(var key in rootState) {
            if(rootState[key].init) {
              dispatch(key+'/GLOBAL_LOAD', null, {root:true})
            }
            if(rootState[key].needFields) {
              dispatch(key+'/GLOBAL_INITIALIZATION', null, {root: true})
            }
          }*/
        }
        resolve(response)
      }).catch(error => {
        commit(MUTATIONS.AUTH_ERROR, error)
        localStorage.removeItem('user-token')
        reject(error)
      })
    })
  },
  [ACTIONS.AUTH_LOGOUT]: ({state, commit}) => {
    return new Promise((resolve, reject) => {
      localStorage.removeItem('user-token')
      commit(MUTATIONS.AUTH_LOGOUT)
      delete axios.defaults.headers.common['Authorization']
      resolve()
    })
  }
}