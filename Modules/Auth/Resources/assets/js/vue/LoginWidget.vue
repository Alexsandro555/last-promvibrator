<template>
  <div>
    <div v-if="username">
      <a class="login-widget" href="/admin">{{username}}</a>
    </div>
    <div v-else>
      <a href="#" @click.stop="onShowLoginWindow" class="header-menu__auth-btn">Вход на сайт</a>
      <a href="#" @click.stop="onShowRegWindow" class="header-menu__auth-btn">Регистрация</a>
    </div>
  </div>
</template>
<script>
  import { mapMutations, mapState } from 'vuex'

  export default {
    computed: {
      ...mapState('Auth', ['showRegWindow', 'username'])
    },
    methods: {
      ...mapMutations('Auth', {setState: 'SET_VARIABLE'}),
      onShowLoginWindow() {
        this.setState({module: 'Auth', variable: 'showLoginWindow', value: true})
      },
      onShowRegWindow() {
        this.setState({module: 'Auth', variable: 'showRegWindow', value: true})
      }
    }
  }
</script>

<style>
  .login-widget {
    color: #1e88d7;
    text-decoration: none;
    line-height: 54px;
    margin-right: 25px;
  }
</style>