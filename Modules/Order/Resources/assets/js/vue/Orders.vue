<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
        <v-card v-if="!loader">
          <v-card-title>
            <h1>Заказы</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :search="search"
                          :rows-per-page-items="[10, 20, 50, { 'text': '$vuetify.dataIterator.rowsPerPageAll', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
                <template slot="items" slot-scope="props">
                  <tr @click="props.expanded = !props.expanded">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.number }}</td>
                    <td class="text-xs-left">{{ props.item.user.name }}</td>
                    <!--<td class="justify-center layout px-0">
                      <v-btn @click="goToPage(props.item)" icon class="mx-0">
                        <v-icon>find_in_page</v-icon>
                      </v-btn>
                      <v-btn icon class="mx-0" @click="$router.push('/Product/Edit/'+props.item.id)">
                        <v-icon color="teal">edit</v-icon>
                      </v-btn>
                      <v-btn :disabled="props.item.url_key === 'po-umolchaniyu'" icon class="mx-0"
                             @click="deleteItem(props.item)">
                        <v-icon color="pink">delete</v-icon>
                      </v-btn>
                    </td>-->
                    <td class="text-xs-left">{{ props.item.user.email }}</td>
                    <td class="text-xs-left">{{ props.item.user.company_name }}</td>
                    <td class="text-xs-left">{{ props.item.user.telephone }}</td>
                    <td class="text-xs-left">{{ props.item.note }}</td>
                  </tr>
                </template>
                <template slot="expand" slot-scope="props">
                  <v-card flat>
                    <v-card-text>
                      <tr v-for="product in props.item.products">
                        <td>{{ product.id }}</td>
                        <td class="text-xs-left">{{ product.title }}</td>
                        <td class="text-xs-left">{{ product.price }}</td>
                      </tr>
                    </v-card-text>
                  </v-card>
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
          <!--<v-card-actions>
            <v-btn @click="add" color="primary" class="text-left mb-2">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-actions>-->
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import axios from 'axios'

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
            text: 'Номер заказа',
            value: 'number',
            sortable: true
          },
          {
            text: 'ФИО',
            value: 'user.title',
            sortable: true
          },
          {
            text: 'Email',
            value: 'user.email',
            sortable: true
          },
          {
            text: 'Название компании',
            value: 'user.company_name',
            sortable: true
          },
          {
            text: 'Телефон',
            value: 'user.telephone',
            sortable: true
          },
          {
            text: 'Примечание',
            value: 'note',
            sortable: false
          }
        ],
        search: '',
        loader: true,
        items: []
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.load()
      })
    },
    computed: {
    },
    methods: {
      load() {
        axios.get('/order/items').then(response => {
          this.items = response.data
          this.loader = false
        })
      },
      /*addProduct() {
        this.add()
          .then(response => {
            this.$router.push({name: 'edit-Product', params: {id: response.id.toString()}})
          })
          .catch(error => {
          })
      },*/
      goToPage(item) {
        let url = '/Product/detail/'
        url = url + item.url_key
        window.open(url, '_blank')
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      }
    }
  }
</script>