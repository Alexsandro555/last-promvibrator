import { GLOBAL } from "@/constants"

export default {
  items: state => state.items,
  state: state => state,
  module: state => state.module,
  getItemByKey: state => key => {
    return state.items.find( item => item.id == key)
  },
  uniqNotNil: state => keys => {
    return _.uniq(keys).filter(item => !_.isNil(item))
  },
  emptyKeys: (state,getters) => keys => {
    return getters.uniqNotNil(keys).filter( item => !state.items.map(itm => itm[getters.primary_key]).includes(item))
  },
  getModel: (state, getters, rootState, rootGetters) => (_.isNil(getters.config))?null:getters.config.model,
  primary_key: state => (_.isEmpty(state.config))?'id':(!_.isEmpty(state.config.primary_key))?state.config.primary_key:'id',
  transformByKey: (state, getters, rootState, rootGetters)  => (obj,key) => {
    if (!_.isObject(obj)) {obj=_.isNil(getters.items)?{}:getters.items.find(item => item[getters.primary_key]==obj)}

    if (_.isNil(getters.config.upLinks)) {return {}}
    var uplink=getters.config.upLinks.find(item => item.column==key)
    if (_.isNil(uplink)) {
      return {}
    }
    var link=rootGetters[uplink.module+'/items'].find(item => item[rootGetters[uplink.module+'/primary_key']]==_.get(obj,key))
    return (_.isNil(link))?{}:link
  },
  getByKey: (state, getters, rootState, rootGetters)  => (key,count) => {
    if (_.isNil(key)) {return [];}
    if (!_.isArray(key)&&_.isObject(key)&&!_.isString(key)) {
      let variable=state.items.filter(item => Object.keys(key).every(mykey => key[mykey]==item[mykey]))
      if (!_.isNil(count)) {count=parseInt(count,10)
        if (variable.length<count) {

          checkKey(getters.module,key)}}
      return variable
    }
    if (_.isArray(key)&&!_.isString(key)) {
      key=key.map(item => (getters.config.primary_type!='string')?parseInt(item):item)
      if (key.length==0) {return []}
      let variable=state.items.filter( item => key.includes(item.id))
      if (variable.length!=key.length) {
        if (!_.isNil(count)) checkKey(getters.module,key.filter(item => !variable.map( it => it.id).includes(item) ))}
      return variable}
    if (getters.config.primary_type!='string') {key=parseInt(key)}
    let variable=state.items.find( item => item.id == key)
    if (_.isNil(variable)) {
      // if (!_.isNil(count)) checkKey(getters.module,key)
      return []
    }
    return variable
  },
  [GLOBAL.GET_ITEM]: (state, commit) => (id) => {
    return state.items.find(item => item.id == id)
  },
  [GLOBAL.TRANSFORM_BY_KEY]: (state, getters, rootState, rootGetters) => (obj, key) => {
    if (!_.isObject(obj)) { obj=_.isNil(state.items)?{}:state.items.find(item => item[getters.primary_key]==obj) }
    if (_.isNil(getters.config.upLinks)) {return {}}
    var uplink=getters.config.upLinks.find(item => item.column==key)
    if (_.isNil(uplink)) {
      return {}
    }
    var link=rootGetters[uplink.module+'/items'].find(item => item[rootGetters[uplink.module+'/primary_key']]==_.get(obj,key))
    return (_.isNil(link))?{}:link
  }
}