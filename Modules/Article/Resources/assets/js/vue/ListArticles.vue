<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-card>
          <v-card-title>
            <h1>Статьи</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :loading="loading"
                          :search="search"
                          :rows-per-page-items="[10, 20, 50, { 'text': '$vuetify.dataIterator.rowsPerPageAll', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="justify-center layout px-0">
                  <v-btn icon class="mx-0" @click="$router.push({name: 'edit-articles', params: {id: props.item.id.toString()}})">
                    <v-icon color="teal">edit</v-icon>
                  </v-btn>
                  <v-btn :disabled="props.item.url_key === 'po-umolchaniyu'" icon class="mx-0"
                         @click="deleteItem(props.item)">
                    <v-icon color="pink">delete</v-icon>
                  </v-btn>
                </td>
              </template>
              <template v-if="loading" slot="no-data">
                <br>
                <v-progress-circular indeterminate :size="100" color="primary"></v-progress-circular>
                <br>
                <br>
              </template>
              <template v-if="!loading" slot="no-data">
                <v-alert :value="true" color="error" icon="warning">
                  Извините, нет данных для отображения :(
                </v-alert>
              </template>
              <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По ключевой фразе "{{ search }}" ничего не найдено.
              </v-alert>
            </v-data-table>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="addArticle" color="primary" class="text-left mb-2">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import { ACTIONS } from "@product/constants"
  import {GLOBAL} from "@/constants";
  import {mapActions, mapState} from 'vuex'

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
            text: 'Наименование',
            value: 'title',
            sortable: true
          },
          {
            text: 'Действия',
            value: 'title',
            sortable: false
          }
        ],
        search: ''
      }
    },
    computed: {
      ...mapState('articles', ['items', 'loading']),
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.initialization()
        vm.loadRelations().then(response => {
          vm.load().then(response => {
            vm.$store.commit('SET_VARIABLE',{module: 'articles', variable: 'loading', value: false}, {root: true})
          })
        })
      })
    },
    methods: {
      addArticle() {
        this.add({'title': 'По-умолчанию'}).then(response => {
          this.$router.push({name: 'edit-articles', params: {id: response.id.toString()}})
        })
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      },
      ...mapActions('articles', { add: GLOBAL.ADD, delete: GLOBAL.DELETE, load: GLOBAL.LOAD, loadAll: GLOBAL.LOAD_ALL, initialization: GLOBAL.INITIALIZATION, loadRelations: GLOBAL.LOAD_RELATIONS })
    }
  }
</script>