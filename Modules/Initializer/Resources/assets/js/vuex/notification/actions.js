import axios from 'axios'

export default {
  successSaveNotification: {
    root: true,
    handler({dispatch}, message = 'Данные успешно сохранены') {
      var notification=new Object();
      notification.timeout=10;
      notification.title='Успешно!'
      notification.type='info'
      notification.text= message
      dispatch('addNotification',notification)
    }
  },
  errorNotification: {
    root: true,
    handler({dispatch}, message = 'Произошла ошибка') {
      var notification=new Object();
      notification.timeout=10;
      notification.title='Ошибка!'
      notification.type='error'
      notification.text= message
      dispatch('addNotification',notification)
    }
  },
  initNotification({ dispatch, commit, getters, rootGetters },payload) {
    var notification=new Object();
    notification.timeout=10;
    notification.title='Вход в систему'
    notification.type='info'
    notification.text='Добро пожаловать в CRM систему'
    dispatch('addNotification',notification)
  },
  addNotification({ dispatch, commit, getters, rootGetters },notification) {
    notification.value=true
    commit('ADD_TO_ARRAY', { module:'notification',variable: 'notifications',value: notification }, { root: true })
    if (notification.timeout)
    {
      setTimeout(() => {
        dispatch('delNotification',notification)
      }, notification.timeout*1000)
    }
  },
  delNotification({ dispatch, commit, getters, rootGetters },notification) {
    commit('CHANGE_VALUE_IN_ARRAY',{module:'notification',variable: 'notifications',object: notification,key: 'value',value: false }, { root: true })
  },
  clearNotifications({ dispatch, commit, getters, rootGetters }) {
    if ((getters.getNotificationsVisible.length==0)&&(getters.notifications.length>0))
    {
      commit('REMOVE_FROM_ARRAY_BY_KEY_VALUE',{module:'notification',variable: 'notifications',key: 'value',value: false }, { root: true })
    }
  }
}