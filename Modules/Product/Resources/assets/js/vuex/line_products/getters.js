export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/line_products"
    obj.module="line_products"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\LineProduct"
    obj.upLinks=state.relations
    return obj
  },
  items: state => state.items
}