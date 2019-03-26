export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attribute_units"
    obj.module="attribute_units"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\AttributeUnit"
    return obj
  },
  items: state => state.items
}