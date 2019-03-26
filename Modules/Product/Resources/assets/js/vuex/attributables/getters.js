export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/attributables"
    obj.module="attributables"
    obj.primary_key="attributable_id"
    obj.model="Modules\\Product\\Entities\\Attributables"
    obj.upLinks=state.relations
    return obj
  },
  items: state => state.items
}