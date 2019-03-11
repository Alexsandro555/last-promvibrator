import {ACTIONS} from '@product/constants'
import {api} from '@/api/main'

export default {
  [ACTIONS.SAVE_DATA]: ({getters}, data) => {
    api.patch({url: getters.config.load, data}).then(response => {

    })
  }
}