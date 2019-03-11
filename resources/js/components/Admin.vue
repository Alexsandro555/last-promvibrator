<template>
  <div>
    <v-navigation-drawer clipped app v-model="drawer">
      <v-list>
        <template v-for="(item, i) in items">
          <v-layout row v-if="item.heading" align-center :key="i">
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{item.heading}}
              </v-subheader>
            </v-flex>
          </v-layout>
          <v-divider dark v-else-if="item.divider" class="my-3" :key="i"></v-divider>
          <v-list-tile v-else :key="i" @click="$router.push(item.path)">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title class="grey--text">
                {{item.text}}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar absolute app clipped-left>
      <v-toolbar-side-icon @click.native="drawer = !drawer"></v-toolbar-side-icon>
      <span class="title ml-3 mr-5" @click="goMainPage()">Лидер</span>
      <v-text-field solo-inverted flat label="Поиск" prepend-icon="search"></v-text-field>
      <v-btn light @click.stop="exit">Выход</v-btn>
      <v-btn light @click.stop="goToSite">На главную</v-btn>
      <v-btn light @click.stop="changeColor">Сменить цвет</v-btn>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content>
    <notifications/>
  </div>
</template>
<script>
  import {mapActions, mapState} from 'vuex'
  import {ACTIONS} from '@auth/constants'

  export default {
    props: {},
    data() {
      return {
        drawer: null,
        items: [
          {divider: true},
          {heading: 'Управление продуктами'},
          {
            text: 'Категории продуктов',
            path: '/categories'
          },
          /*{
            text: 'ТНВЭД',
            path: '/tnved'
          },*/
          {
            text: 'Типы продуктов',
            path: '/types'
          },
          {
            text: 'Линейки продукции',
            path: '/lines'
          },
          {
            text: 'Производители',
            path: '/producer'
          },
          {
            text: 'Еденицы измерения атрибутов',
            path: '/attributes-unit'
          },
          {
            text: 'Группы атрибутов',
            path: '/attributes-group'
          },
          {
            text: 'Атрибуты',
            path: '/attributes'
          },
          {
            text: 'Привязка атрибутов',
            path: '/binding'
          },
          {
            text: 'Продукция',
            path: '/'
          },
          {divider: true},
          {heading: 'Работа с сайтом'},
          {
            text: 'Статьи',
            path: '/articles'
          },
          {
            text: 'Новости',
            path: '/news'
          },
          {
            text: 'Страницы',
            path: '/pages'
          }
        ]
      }
    },
    computed: {

    },
    methods: {
      ...mapActions('Auth', {logout: ACTIONS.AUTH_LOGOUT}),
      ...mapState('initializer', ['darkColor']),
      exit() {
        this.logout().then(() => {
          window.location.href='/'
        })
      },
      changeColor() {
        this.$root.chengeColor()
      }
    }
  }
</script>