export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/products"
    obj.module="products"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\Product"
    obj.upLinks=state.relations
    return obj
  },
  items: state => state.items
}