export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/type_products"
    obj.module="type_products"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\TypeProduct"
    obj.upLinks=state.relations
    return obj
  },
  items: state => state.items
}