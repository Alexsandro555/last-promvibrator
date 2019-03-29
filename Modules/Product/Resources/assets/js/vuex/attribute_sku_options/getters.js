export default {
  config: (state, getters, rootState, rootGetters) => {
    let obj=new Object()
    obj.items='items'
    obj.load='/api/attribute_sku_options'
    obj.module='attribute_sku_options'
    obj.primary_key='id'
    obj.model='Modules\\Product\\Models\\AttributeSkuOption'
    obj.upLinks=[{column:'sku_id',module:'Sku'},{column:'attribute_id',module:'Attribute'}]
    return obj
  },
  items: state => state.items
}