export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/news"
    obj.module="news"
    obj.primary_key="id"
    obj.model="Modules\\News\\Entities\\News"
    return obj
  }
}