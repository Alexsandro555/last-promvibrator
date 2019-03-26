export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/producers"
    obj.module="producers"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\Producer"
    return obj
  },
  items: state => state.items
}