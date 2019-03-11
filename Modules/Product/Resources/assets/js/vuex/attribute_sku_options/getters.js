export default {
  config: (state, getters, rootState, rootGetters) => {
    let obj=new Object()
    obj.items='items'
    obj.load='/sku-options'
    obj.module='SkuOptions'
    obj.primary_key='id'
    obj.model='Modules\\Product\\Models\\AttributeSkuOption'
    obj.upLinks=[{column:'sku_id',module:'Sku'},{column:'attribute_id',module:'Attribute'}]
    return obj
  }
}