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
    return state.items.filter(item => item.product_id === id)
                      .reduce((acc, item, i) => {
                          acc[item.attribute_id] = {
                            product_id: item.product_id,
                            value: item.value,
                            attribute_id: item.attribute_id,
                            id: item.id
                          };
                          return acc;
                      }, {});
  },
  items: state => state.items
}