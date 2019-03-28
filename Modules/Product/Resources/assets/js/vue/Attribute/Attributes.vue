<template>
  <div>
    <v-card>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex xs2>
          </v-flex>
          <v-flex xs8 align-end flexbox v-if="attributes.lenght!==0">
            <br>
            <div v-if="attributes.length>0">
              <v-form ref="form">
                <template v-for="(attribute, index) in attributes">
                  <v-container grid-list-md>
                    <v-layout col wrap>
                      <v-text-field
                        v-if="attribute.attribute_type_id==2"
                        :name="attribute.url_key"
                        :label="attribute.title"
                        :value="form[attribute.id]?form[attribute.id].value:null"
                        @input="updateAttribute($event, attribute.id)">
                      </v-text-field>
                      <v-text-field
                        v-else-if="attribute.attribute_type_id==7"
                        :name="attribute.url_key"
                        :label="attribute.title"
                        :value="form[attribute.id]?form[attribute.id].value:null"
                        @input="updateAttribute($event, attribute.id)"
                        prefix="₽">
                      </v-text-field>
                      <v-text-field
                        v-else-if="attribute.attribute_type_id==3"
                        :name="attribute.url_key"
                        :label="attribute.title"
                        @input="updateAttribute($event, attribute.id)"
                        :value="form[attribute.id]?form[attribute.id].value:null">
                      </v-text-field>
                      <v-text-field
                        v-else-if="attribute.attribute_type_id==4"
                        :name="attribute.url_key"
                        :label="attribute.title"
                        @input="updateAttribute($event, attribute.id)"
                        :value="form[attribute.id]?form[attribute.id].value:null">
                      </v-text-field>
                      <v-checkbox
                        v-else-if="attribute.attribute_type_id==1"
                        :name="attribute.url_key"
                        :label="attribute.title"
                        @change="updateAttribute($event, attribute.id)"
                        :value="form[attribute.id]?form[attribute.id].value:null">
                      </v-checkbox>
                      <v-select
                        v-else-if="attribute.attribute_type_id==8"
                        :name="attribute.url_key"
                        :items="attribute.attribute_list_value"
                        :label="attribute.title"
                        :id="attribute.url_key"
                        no-data-text="Нет данных"
                        @input="updateAttribute($event, attribute.id)"
                        :value="form[attribute.id]?form[attribute.id].value:null"
                        item-text="title"
                        item-value="id"
                        single-line>
                      </v-select>
                      <v-menu
                        v-else-if="attribute.attribute_type_id==5"
                        v-model="menu"
                        transition="scale-transition"
                        :nudge-left="40"
                        :close-on-content-click="false"
                        full-width>
                        <v-text-field
                          slot="activator"
                          :label="attribute.title"
                          :value="form[attribute.id]?form[attribute.id].value:null"
                          prepend-icon="event"
                          readonly>
                        </v-text-field>
                        <v-date-picker
                          :allowed-dates="v => v>=dateFns.format(Date.now(),'YYYY-MM-DD')"
                          v-model="date"
                          locale="ru-ru"
                          @change="updateDate({date, id: attribute.id})">
                        </v-date-picker>
                      </v-menu>
                    </v-layout>
                  </v-container>
                </template>
                <v-flex xs12 text-xs-left>
                  <v-btn :disabled="isSending || !attributes.length>0" large color="primary" @click.prevent="onSave()">Сохранить атрибуты</v-btn>
                </v-flex>
              </v-form>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card>
  </div>
</template>
<script>
  import {mapActions, mapGetters} from 'vuex'
  import {ACTIONS, GETTERS} from '@product/constants'
  import {GLOBAL} from '@/constants'

  export default {
    props: {
      attributes: {
        type: Array,
        default: []
      },
      id: {
        type: Number,
        required: true
      }
    },
    computed: {
      form() {
        return this.attributesValues(Number(this.id));
      },
      ...mapGetters('attribute_values', {attributesValues: GETTERS.BY_PRODUCT_ID}),
    },
    data: function() {
      return {
        valid: false,
        selectedRules: [
          v => this.selectRequired(v),
        ],
        requiredRules: [
          v => this.required(v)
        ],
        menu: false,
        date: null,
        changed: [],
        isSending: false
      }
    },
    methods: {
      ...mapActions('attribute_values', {save: ACTIONS.SAVE_DATA}),
      selectRequired(v) {
        return !!v || 'Необходимо выбрать значение'
      },
      required(v) {
        return !!v || 'Обязательное для заполнения'
      },
      getValue(id) {
        const value = this.attributesValues.find(item => item.attribute_id == id)
        return value?value.value:null
      },
      updateAttribute(value, id) {
        if(this.form[id]) {
          this.form[id] = Object.assign(this.form[id], {value})
        }
        else {
          this.form[id] = {id: null, attribute_id: id, product_id: this.id, value}
        }
      },
      updateDate({date, id}) {
        this.updateAttribute(date, id)
        this.menu = false
      },
      onSave() {
        if(this.$refs.form.validate()) {
          this.isSending = true
          let result = []
          for(let val in this.form) {
            result.push(this.form[val])
          }
          this.save({product_id: this.id, attributes: result}).then(response => {
            this.isSending = false
          })
        }
      }
    }
  }
</script>