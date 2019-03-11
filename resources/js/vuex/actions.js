import {PRIVATE, GLOBAL} from '@/constants.js'
import { api } from '@/api/main.js'

export default {
  [GLOBAL.INITIALIZATION] : ({ state, dispatch, commit }) => {
    api.get('/initializer/fields/'+state.name).then(response => {
      commit('SET_ARRAY_VARIABLE', {variable: 'fields', value: response})
    })
  },
  [GLOBAL.LOAD]: ({commit, getters, dispatch, state}) => {
    return new Promise((resolve, reject) => {
      api.get(getters.config.load).then(response => {
        dispatch('set', response)
        commit('SET_VARIABLE',{variable: 'loading', value: false})
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.LOAD_RELATIONS]: ({commit, getters, dispatch}) => {
    var upLinkReady=[];
    return new Promise((resolve) => {
      for (var index in getters.config.upLinks) {
        upLinkReady[index]=dispatch(getters.config.upLinks[index].module+'/loadAllRelationsIfNotExists',null, {root:true})
      }
      Promise.all(upLinkReady).then(values => {
        resolve(values)
      })
    })
  },
  [GLOBAL.LOAD_ALL]: ({commit, getters, dispatch}) => {
    return new Promise((resolve, reject) => {
      api.get(getters.config.load).then(response => {
        dispatch('set',response)
        var upLoad=dispatch('loadUpLink',response)
        Promise.all([upLoad]).then(values => {
          resolve(response)
        })
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.ADD]: ({ commit, state, getters }, data) => {
    return new Promise((resolve, reject) => {
      api.post(getters.config.load+'/default', data).then(response => {
        commit('UPDATE_ARRAY_BY_KEY',{module:getters.config.module,variable:getters.config.items,key:getters.config.primary_key,value:response}, { root: true })
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  [GLOBAL.SAVE_DATA]: ({ commit, dispatch, state, getters }, data) => {
    return new Promise((resolve, reject) => {
      api.patch({data, url: getters.config.load}).then(response => {
        commit('UPDATE_ARRAY_BY_KEY',{module:getters.config.module,variable:getters.config.items,key:getters.config.primary_key,value:response}, { root: true })
        dispatch('successSaveNotification', response.message, {root: true})
        resolve(response)
      }).catch(error => {
          reject(error)
      })
    })
  },
  [GLOBAL.UPDATE_ITEM]: ({commit}, objField) => {
    commit('SET_VARIABLE',{module: ''})
  },
  [GLOBAL.DELETE]: ({ commit, state, getters }, id) => {
    api.delete({url: getters.config.load, id})
      .then(response => {
        commit(PRIVATE.DELETE, response)
      })
  },
  [GLOBAL.SAVE_DATA_MULTI]: ({ commit, dispatch, state }, data) => {
    return new Promise((resolve, reject) => {
      api.patch({data, url: state.url}).then(response => {
        dispatch('successSaveNotification', response.message, {root: true})
        response.forEach(element => {
          const isUpdated = state.items.find(item => item.id == element.id)
          if (isUpdated) {
            commit(GLOBAL.UPDATE, element)
          } else {
            commit(PRIVATE.ADD, element)
          }
        })
        resolve(response)
      })
    }).catch(error => {
      reject(error)
    })
  },
  loadUpLink: ({ dispatch, commit, getters, rootGetters },items) => {
    var upLinkReady=[];
    return new Promise((resolve) => {
      for (var index in getters.config.upLinks)
      {
        upLinkReady[index]=dispatch(getters.config.upLinks[index].module+'/loadIfNotExist',items.map(item => _.get(item,getters.config.upLinks[index].column)),{root:true})
      }
      Promise.all(upLinkReady).then(values => {
        resolve(values)
      })
    })
  },
  loadAllRelationsIfNotExists: ({dispatch, commit, getters, rootGetters}) => {
    return new Promise((resolve) => {
      if(!getters.items.length>0) {
        api.get(getters.config.load).then(response => {
          dispatch('set', response)
          resolve(response)
        })
      } else {
        resolve(getters.items)
      }
    })
  },
  loadIfNotExist: ({ dispatch, commit, getters, rootGetters },key) => {
    return new Promise((resolve) => {
      if (!_.isArray(key)) {key=[key]}
      var cuttedKey=key.filter(item => !getters.items.map(newitem => newitem[getters.primary_key]).includes(item))
      if (getters.emptyKeys(cuttedKey).length>0) {
        var obj={};
        obj[getters.primary_key] = getters.emptyKeys(cuttedKey)
        api.post(getters.config.load,obj).then(response => {
          dispatch('set',response)
          var upLoad=dispatch('loadUpLink',response)
          Promise.all([upLoad]).then(values => {
            resolve(key.map(item => getters.getByKey(item)))
          })
        })
      } else {resolve(key.map(item => getters.getByKey(item)))}
    })
  },
  set: ({ dispatch, commit, getters, rootGetters },items) => {
    if (items.length>0) {
      commit('UPDATE_ARRAY_BY_KEY',{module:getters.config.module,variable:getters.config.items,key:getters.config.primary_key,value:items}, { root: true })
    }
  }
}