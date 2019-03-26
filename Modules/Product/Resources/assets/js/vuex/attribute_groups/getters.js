export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attribute_groups"
    obj.module="attribute_groups"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\AttributeGroup"
    return obj
  },
  items: state => state.items
}