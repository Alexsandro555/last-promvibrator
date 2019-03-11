export default {
  notifications: state => state.notifications,
  getNotificationsVisible: state => state.notifications.filter(item => item.value),
}