import { ACTIONS } from '@product/constants'
import { api } from '@/api/main'

export default {
  [ACTIONS.LOAD_ALL]: ({getters}) => {
    api.get(getters.config.load).then(response => {
      console.log(response)
    })
  }
}