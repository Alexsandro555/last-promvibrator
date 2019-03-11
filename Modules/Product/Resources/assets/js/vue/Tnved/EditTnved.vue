<template>
  <v-container>
    <v-layout wrap row>
      <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
      <v-flex v-if="!loader">
        <v-card>
          <v-card-title>
            <h1>Редактирование Tnved</h1>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-layout row wrap>
                <v-flex>
                  <v-form ref="form" lazy-validation v-model="valid">
                    <v-text-field
                      name="id"
                      label="Код ТНВЭД"
                      v-model="form.id"
                      :counter="255"
                      :rules="getRules({required: true})"
                      :error-messages="messages.id"
                      required>
                    </v-text-field>
                    <v-text-field
                      name="title"
                      label="Наименование"
                      v-model="form.title"
                      :counter="255"
                      :rules="getRules({required: true, max: 255})"
                      :error-messages="messages.title"
                      required>
                    </v-text-field>
                    <v-checkbox
                      label="Актив."
                      v-model="form.active"
                      :error-messages="messages.active">
                    </v-checkbox>
                    <v-flex text-xs-left>
                      <v-btn large :class="{primary: valid, 'red lighten-3': !valid}" :disabled="isSending"
                             @click.prevent="onSubmit">Сохранить
                      </v-btn>
                    </v-flex>
                  </v-form>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {mapActions, mapState, mapGetters, mapMutations} from 'vuex'
  import {ACTIONS, GLOBAL} from '@/constants'
  import {ValidationConvert} from '@/vue/Validations'

  export default {
    props: {
      id: {
        type: String,
        required: true
      },
    },
    data: function () {
      return {
        valid: false,
        loader: true,
        isSending: false,
        validationConvert: new ValidationConvert()
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.init(to.params.id)
        vm.loader = false
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.init(to.params.id)
      this.loader = false
      next()
    },
    computed: {
      ...mapState('tnveds', ['items']),
      ...mapState('initializer', ['messages']),
      ...mapGetters('tnveds', {getItem: GLOBAL.GET_ITEM}),
      form() {
        return _.pick(this.getItem(Number(this.id)), ['id', 'title', 'active'])
      }
    },
    methods: {
      ...mapActions('tnveds', {
        save: GLOBAL.SAVE_DATA
      }),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      updateField(objField) {
        Object.assign(this.form, objField)
      },
      init(id) {
        this.resetError();
        if (this.items.length == 0) {
          this.$router.push({name: 'product-tnved-list'})
        }
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.form).then(response => {
            this.isSending = false
          })
        }
      },
      getRules(validations) {
        return validations ? this.validationConvert.ruleValidations(validations) : []
      }
    }
  }
</script>