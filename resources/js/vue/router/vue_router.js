import VueRouter from 'vue-router'
import Vue from "vue";
import { routes } from './routes'

Vue.use(VueRouter)

const ifAuthenticated = (to, from, next) => {
  if(!!localStorage.getItem('user-token')) {
    next()
    return
  }
  next('/login')
}

const router = new VueRouter({
  routes
})

export default router