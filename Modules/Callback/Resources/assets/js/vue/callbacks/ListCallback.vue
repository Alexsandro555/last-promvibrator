<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-card>
          <v-card-title>
            <h1>Обратные звонки</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :search="search"
                          :loading="loading"
                          :rows-per-page-items="[10, 20, 50, { 'text': '$vuetify.dataIterator.rowsPerPageAll', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.name }}</td>
                <td class="text-xs-left">{{ props.item.company_name }}</td>
                <td class="text-xs-left">{{ props.item.telephone }}</td>
                <td class="text-xs-left">{{ props.item.email }}</td>
                <td class="text-xs-left">{{ props.item.comment }}</td>
                <!--<td class="justify-center layout px-0">
                  <v-btn icon class="mx-0" @click="$router.push('/callbacks/edit/'+props.item.id)">
                    <v-icon color="teal">edit</v-icon>
                  </v-btn>
                  <v-btn :disabled="props.item.url_key === 'po-umolchaniyu'" icon class="mx-0"
                         @click="deleteItem(props.item)">
                    <v-icon color="pink">delete</v-icon>
                  </v-btn>
                </td>-->
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
          <!--<v-card-actions>
            <v-btn @click="addCallback" color="primary" dark class="text-left mb-2">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-actions>-->
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
    computed: {
      ...mapState('callbacks', ['items', 'loading']),
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.initialization()
        vm.loadRelations().then(response => {
          vm.load().then(response => {
            vm.$store.commit('SET_VARIABLE', {module: 'callbacks', variable: 'loading', value: false}, {root: true})
          })
        })
      })
    },
    methods: {
      addCallback() {
        this.add({'title': 'По-умолчанию'})
          .then(response => {
            this.$router.push({name: 'edit-callbacks', params: {id: response.id.toString()}})
          })
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      },
      ...mapActions('callbacks', {
        load: GLOBAL.LOAD,
        add: GLOBAL.ADD,
        delete: GLOBAL.DELETE,
        initialization: GLOBAL.INITIALIZATION,
        loadRelations: GLOBAL.LOAD_RELATIONS
      })
    }
  }
</script>