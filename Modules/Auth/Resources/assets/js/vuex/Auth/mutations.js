import {MUTATIONS} from '@auth/constants'

export default {
  [MUTATIONS.AUTH_REQUEST]: (state, payload) => {
    state.status = 'loading'
  },
  [MUTATIONS.AUTH_SUCCESS]: (state, token) => {
    state.status = 'success'
    state.token = token
  },
  [MUTATIONS.AUTH_ERROR]: (state, error) => {
    state.status = 'error'
  },
  [MUTATIONS.AUTH_LOGOUT]: (state, error) => {
    state.token = ''
  }
}