import {GETTERS} from '@product/constants'

export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attribute_values"
    obj.module="attribute_values"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\AttributeValues"
    return obj
  },
  [GETTERS.BY_PRODUCT_ID]: (state, commit) => (id) => {
    return state.items.filter(item => item.product_id == id)
  },
  items: state => state.items
}