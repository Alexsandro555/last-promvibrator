<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
        <v-card v-if="!loader">
          <v-card-title>
            <h1>Обратные звонки</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :search="search"
                          :rows-per-page-items="[10, 20, 50, { 'text': 'Все', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.company_name }}</td>
                <td class="text-xs-left">{{ props.item.telephone }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.comment }}</td>
              </template>
              <template slot="no-data">
                <v-alert :value="true" color="error" icon="warning">
                  Извините, нет данных для отображения :(
                </v-alert>
              </template>
              <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По ключевой фразе "{{ search }}" ничего не найдено.
              </v-alert>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {ACTIONS, GLOBAL} from "@/constants";
  import {mapActions, mapState, mapGetters} from 'vuex'

  export default {
    props: {},
    data: function () {
      return {
        headers: [
          {
            text: '#',
            align: 'left',
            sortable: true,
            value: 'id'
          },
          {
            text: 'ФИО',
            value: 'name',
            sortable: true
          },
          {
            text: 'Название компании',
            value: 'company_name',
            sortable: true
          },
          {
            text: 'Телефон',
            value: 'telephone',
            sortable: true
          },
          {
            text: 'Email',
            value: 'email',
            sortable: true
          },
          {
            text: 'Комментарий',
            value: 'comment',
            sortable: true
          }
        ],
        search: '',
        loader: true
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.load().then(response => {
          vm.initialization()
          vm.loader = false
        })
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.load().then(response => {
        this.loader = false
      })
      next()
    },
    computed: {
      ...mapState('Callback', ['items']),
    },
    methods: {
      ...mapActions('Callback', {
        load: GLOBAL.LOAD,
        initialization: GLOBAL.INITIALIZATION
      })
    }
  }
</script>