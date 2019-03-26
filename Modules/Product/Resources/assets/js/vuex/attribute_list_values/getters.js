export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attribute_list_values"
    obj.module="attribute_list_values"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\AttributeListValue"
    return obj
  },
  items: state => state.items
}