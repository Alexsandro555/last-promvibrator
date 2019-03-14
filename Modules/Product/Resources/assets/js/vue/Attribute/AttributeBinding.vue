<template>
  <v-container>
    <v-layout align-center justify-center full-height wrap row>
      <v-flex>
        <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
        <v-card v-else>
          <v-card-title>
            <h1>Привязка атрибутов</h1>
          </v-card-title>
          <v-card-text>
            <v-form ref="form" lazy-validation v-model="validRemainAttr">
              <v-select
                name="product_category_id"
                :items="productCategories"
                label="Категория продукта"
                no-data-text="Нет данных"
                item-text="title"
                @change="changeProductCategories"
                item-value="id"
                :rules="getRules({required: true})"
                required
                :error-messages="messages.product_category_id"
                v-model="form.product_category_id"
                single-line>
              </v-select>
              <v-select
                name="type_product_id"
                :items="getTypeProducts"
                label="Типы продукта"
                item-text="title"
                no-data-text="Нет данных"
                @change="changeTypeProducts"
                item-value="id"
                v-model="form.type_product_id"
                single-line>
              </v-select>
              <v-select
                name="line_product_id"
                :items="getLineProducts"
                label="Линейки продукции"
                item-text="title"
                no-data-text="Нет данных"
                item-value="id"
                v-model="form.line_product_id"
                single-line>
              </v-select>
              <v-select
                label="Атрибуты"
                :items="getRemainsAttributes"
                v-model="form.selectedRemainAttr"
                multiple
                :menu-props="{maxHeight: '400'}"
                item-text="title"
                item-value="id"
                no-data-text="Нет данных"
                persistent-hint
                chips
                :rules="getRules({selected: true})"
                required>
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-select>
              <v-btn large color="primary" :disabled="!validRemainAttr || isSending" @click.prevent="onSaveAttributes()">Сохранить</v-btn>
            </v-form>
            <v-form ref="formProductCategoryAttr" lazy-validation v-model="validProdCatAttr">
              <v-select
                label="Атрибуты категории продукции"
                :items="getProductCategoryAttributes"
                v-model="formProductCategoryAttributes"
                multiple
                :menu-props="{maxHeight: '400'}"
                item-text="title"
                item-value="id"
                no-data-text="Нет данных"
                attach
                chips
                :rules="getRules({selected: true})"
                required>
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-select>
              <v-btn large color="primary" :disabled="!validProdCatAttr" @click.prevent="onRemoveProductCategoryAttributes">Исключить атрибуты</v-btn>
            </v-form>
            <v-form ref="formTypeProdAttr" lazy-validation v-model="validTypeProdAttr">
              <v-select
                label="Атрибуты типа продукции"
                :items="getTypeProductAttributes"
                v-model="formTypeProductAttributes"
                multiple
                :menu-props="{maxHeight: '400'}"
                item-text="title"
                item-value="id"
                no-data-text="Нет данных"
                persistent-hint
                chips
                :rules="getRules({selected: true})"
                required>
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-select>
              <v-btn large color="primary" :disabled="!validTypeProdAttr" @click.prevent="onRemoveTypeProductAttributes">Исключить атрибуты</v-btn>
            </v-form>
            <v-form ref="formLineProdAttr" lazy-validation v-model="validLineProdAttr">
              <v-select
                label="Атрибуты линейки продукции"
                :items="getLineProductAttributes"
                v-model="formLineProductAttributes"
                multiple
                :menu-props="{maxHeight: '400'}"
                item-text="title"
                item-value="id"
                no-data-text="Нет данных"
                persistent-hint
                chips
                :rules="getRules({selected: true})"
                required>
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-select>
              <v-btn large color="primary" :disabled="!validLineProdAttr" @click.prevent="onRemoveLineProductAttributes">Исключить атрибуты</v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import {ACTIONS} from "@product/constants"
  import {GLOBAL} from "@/constants"
  import {mapState, mapActions, mapGetters} from "vuex"
  import {ValidationConvert} from '@/vue/Validations'

  export default {
    data() {
      return {
        loader: false,
        validationConvert: new ValidationConvert(),
        form: {
          product_category_id: null,
          type_product_id: null,
          line_product_id: null,
          selectedRemainAttr: null
        },
        validProdCatAttr: false,
        formProductCategoryAttributes: null,
        validTypeProdAttr: false,
        formTypeProductAttributes: null,
        validLineProdAttr: false,
        formLineProductAttributes: null,
        validRemainAttr: false,
        isSending: false

      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.loader = true
        let init = vm.initialization()
        let productCategories = vm.loadProductCategories()
        let typeProducts = vm.loadTypeProducts()
        let lineProducts = vm.loadLineProducts()
        let attributes = vm.loadAttributes()
        let load = vm.load()
        Promise.all([init,productCategories,typeProducts,lineProducts,attributes,load]).then(result => {
          vm.loader = false
        })
      })
    },
    computed: {
      ...mapState('product_categories', {productCategories: state => state.items}),
      ...mapState('type_products', {typeProducts: state => state.items}),
      ...mapState('line_products', {lineProducts: state => state.items}),
      ...mapGetters('attributables', {attributables: 'items', transformByKey: 'transformByKey'}),
      ...mapState('attributes', {attributes: state => state.bindAttributes, allAttributes: state => state.items}),
      ...mapGetters('product_categories', {getProdCategoriesModel: 'getModel'}),
      ...mapGetters('type_products', {getTypeProductModel: 'getModel'}),
      ...mapGetters('line_products', {getLineProductModel: 'getModel'}),
      ...mapState('initializer', ['messages']),
      getTypeProducts() {
        return this.form.product_category_id?this.typeProducts.filter(item => item.product_category_id == this.form.product_category_id):[]
      },
      getLineProducts() {
        return this.form.type_product_id?this.lineProducts.filter(item => item.type_product_id == this.form.type_product_id):[]
      },
      getProductCategoryAttributes() {
        return this.attributables.filter(item => item.attributable_id == this.form.product_category_id && item.attributable_type == this.getProdCategoriesModel).map(item => {
          return Object.assign(item, this.transformByKey(item, 'attribute_id'))
        })
      },
      getTypeProductAttributes() {
        return this.attributables.filter(item => item.attributable_id == this.form.type_product_id && item.attributable_type == this.getTypeProductModel).map(item => {
          return Object.assign(item, this.transformByKey(item, 'attribute_id'))
        })
      },
      getLineProductAttributes() {
        return this.attributables.filter(item => item.attributable_id == this.form.line_product_id && item.attributable_type == this.getLineProductModel).map(item => {
          return Object.assign(item, this.transformByKey(item, 'attribute_id'))
        })
      },
      getSelAttributesIds() {
        return this.getProductCategoryAttributes.concat(this.getTypeProductAttributes).concat(this.getLineProductAttributes).map(item => item.attribute_id)
      },
      getRemainsAttributes() {
        return this.allAttributes.filter(item => !this.getSelAttributesIds.includes(item.id))
      }
    },
    watch: {
      getProductCategoryAttributes(val) {
        this.formProductCategoryAttributes = val.map(item => item.attribute_id)
      },
      getTypeProductAttributes(val) {
        this.formTypeProductAttributes = val.map(item => item.attribute_id)
      },
      getLineProductAttributes(val) {
        this.formLineProductAttributes = val.map(item => item.attribute_id)
      }
    },
    methods: {
      changeProductCategories() {
        this.form.type_product_id = null
        this.form.line_product_id = null
      },
      changeTypeProducts() {
        this.form.line_product_id = null
      },
      onSaveAttributes() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.form).then(response => {
            this.isSending = false
            this.form.selectedRemainAttr = null
          })
        }
      },
      onRemoveProductCategoryAttributes() {
        if (this.$refs.formProductCategoryAttr.validate()) {
          let data = {
            'attr': this.formProductCategoryAttributes,
            'product_category_id': this.form.product_category_id
          }
          this.isSending = true
          this.removeBindAttributes(data).then(response => {
            this.isSending = false
          })
        }
      },
      onRemoveTypeProductAttributes() {
        if (this.$refs.formTypeProdAttr.validate()) {
          this.isSending = true
          let data = {
            'attr': this.formTypeProductAttributes,
            'type_product_id': this.form.type_product_id
          }
          this.removeBindAttributes(data).then(response => {
            this.isSending = false
          })
        }
      },
      onRemoveLineProductAttributes() {
        if (this.$refs.formLineProdAttr.validate()) {
          this.isSending = true
          let data = {
            'attr': this.formLineProductAttributes,
            'line_product_id': this.form.line_product_id
          }
          this.removeBindAttributes(data).then(response => {
            this.isSending = false
          })
        }
      },
      getRules(validations) {
        return validations ? this.validationConvert.ruleValidations(validations) : []
      },
      ...mapActions('product_categories', {loadProductCategories: GLOBAL.LOAD_ALL}),
      ...mapActions('type_products', {loadTypeProducts: GLOBAL.LOAD_ALL}),
      ...mapActions('line_products', {loadLineProducts: GLOBAL.LOAD_ALL}),
      ...mapActions('attributables', {load: GLOBAL.LOAD, save: GLOBAL.SAVE_DATA, removeBindAttributes: ACTIONS.REMOVE_BIND_ATTRIBUTES}),
      ...mapActions('attributes', {
        initialization: GLOBAL.INITIALIZATION,
        loadAttributes: GLOBAL.LOAD_ALL
      }),
    }
  }
</script>