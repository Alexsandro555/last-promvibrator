import axios from 'axios'
import router from '@/vue/router/vue_router'

export default {
  namespaced: true,
  state: {
    messages: {},
    message: '',
    darkColor: true
  },
  actions: {
    init({commit, dispatch}) {
      axios.interceptors.response.use(response => {
          return response;
        },
        error => {
          let errorType = error.response.status
          switch (errorType) {
            case 419:
              router.push({name: 'login'})
              break;
            case 401:
              commit('SET_ERROR', error.response.data.error)
              router.push({name: 'login'});
              break;
            case 422:
              commit('SET_ERRORS', error.response.data.errors)
              break;
            default:
              dispatch('errorNotification', error.response.data.message, {root: true})
          }
          return Promise.reject(error.response);
        })
    },
    resetError({commit}) {
      commit('RESET_ERROR')
    }
  },
  getters: {},
  mutations: {
    SET_ERROR: (state, payload) => {
      state.message = payload
    },
    SET_ERRORS: (state, payload) => {
      state.messages = Object.assign({}, payload)
    },
    RESET_ERROR: (state) => {
      state.messages = {}
      state.message = ''
    }
  }
}