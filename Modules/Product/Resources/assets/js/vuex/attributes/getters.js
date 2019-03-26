export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attributes"
    obj.module="attributes"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\Attributes"
    obj.upLinks=state.relations
    return obj
  },
  items: state => state.items
}