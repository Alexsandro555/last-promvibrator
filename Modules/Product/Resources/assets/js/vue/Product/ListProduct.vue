<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-card>
          <v-card-title>
            <h1>Продукция</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="getProducts"
                          :loading="loading"
                          :search="search"
                          :rows-per-page-items="[10, 20, 50, { 'text': '$vuetify.dataIterator.rowsPerPageAll', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">{{ props.item.product_category.title }}</td>
                <td class="text-xs-left">{{ props.item.type_product.title }}</td>
                <td class="text-xs-left">{{ props.item.line_product.title }}</td>
                <td>{{props.item.sort}}</td>
                <td class="justify-center layout px-0">
                  <v-btn @click="goToPage(props.item)" icon class="mx-0">
                    <v-icon>find_in_page</v-icon>
                  </v-btn>
                  <v-btn icon class="mx-0" @click="$router.push({name: 'edit-product', params: {id: props.item.id.toString()}})">
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
            <v-btn @click="addProduct" color="primary" class="text-left mb-2">
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
  import {mapActions, mapState, mapGetters} from 'vuex'

  export default {
    props: {},
    data: function () {
      return {
        headers: [
          {
            text: '#',
            align: 'left',
            sortable: false,
            value: 'id'
          },
          {
            text: 'Наименование',
            value: 'title',
            sortable: false
          },
          {
            text: 'Категория',
            value: 'product_category.title',
            sortable: false
          },
          {
            text: 'Тип продукта',
            value: 'type_product.title',
            sortable: false
          },
          {
            text: 'Линейка продукта',
            value: 'line_product.title',
            sortable: false
          },
          {
            text: 'Сорт',
            value: 'sort',
            sortable: true,
            align: 'right',
            width: '10'
          },
          {
            text: 'Действия',
            value: 'title',
            align: 'center',
            sortable: false
          }
        ],
        search: ''
      }
    },
    computed: {
      ...mapState('products', ['items', 'loading']),
      ...mapGetters('products', {transformByKey: 'transformByKey'}),
      getProducts() {
        return this.items.map(item => {
          return Object.assign(
            item,
            {type_product: this.transformByKey(item, 'type_product_id')},
            {line_product: this.transformByKey(item, 'line_product_id')},
            {product_category: this.transformByKey(item, 'product_category_id')}
          )
        })
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.loadRelations().then(response => {
          vm.load().then(response => {
            vm.$store.commit('SET_VARIABLE',{module: 'products', variable: 'loading', value: false}, {root: true})
          })
        })
        vm.loadAttributables()
        vm.loadAttributes()
        vm.loadAttributeValues()
        vm.loadSkus()
      })
    },
    methods: {
      addProduct() {
        this.add({'title': 'По-умолчанию'}).then(response => {
            this.$router.push({name: 'edit-product', params: {id: response.id.toString()}})
          })
      },
      goToPage(item) {
        let url = '/Product/detail/'
        url = url + item.url_key
        window.open(url, '_blank')
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      },
      ...mapActions('products', { add: GLOBAL.ADD, delete: GLOBAL.DELETE, load: GLOBAL.LOAD, loadAll: GLOBAL.LOAD_ALL, loadRelations: GLOBAL.LOAD_RELATIONS }),
      ...mapActions('attributables', {loadAttributables: GLOBAL.LOAD}),
      ...mapActions('attributes', {loadAttributes: GLOBAL.LOAD}),
      ...mapActions('attribute_values', {loadAttributeValues: GLOBAL.LOAD}),
      ...mapActions('skus', {loadSkus: GLOBAL.LOAD})
    }
  }
</script>