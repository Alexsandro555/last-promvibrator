export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/skus"
    obj.module="skus"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\Sku"
    obj.upLinks=[]
    return obj
  },
  items: state => state.items
}