export default {
  config: () => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/product_categories"
    obj.module="product_categories"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\ProductCategory"
    return obj
  },
  items: state => state.items
}