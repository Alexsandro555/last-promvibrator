export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attribute_types"
    obj.module="attribute_types"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\AttributeType"
    return obj
  },
  items: state => state.items
}