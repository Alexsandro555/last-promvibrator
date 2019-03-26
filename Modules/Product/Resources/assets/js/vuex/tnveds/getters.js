export default {
  config: () => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/tnveds"
    obj.module="tnveds"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\Tnved"
    return obj
  },
  items: state => state.items
}