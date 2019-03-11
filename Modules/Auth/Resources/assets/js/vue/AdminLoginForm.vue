<template>
  <v-container fluid fill-height>
    <v-layout justify-center align-center>
      <v-card width="600px">
        <v-responsive dark height="100px" class="register-head">
          <v-flex xs11 offset-xs1 class="left">
            <br>
            <span class="display-1">Вход</span>
          </v-flex>
        </v-responsive>
        <v-card-title>
          <v-flex xs12>
            <v-alert v-if="errorMessage" type="error" :value="true">
              {{errorMessage}}
            </v-alert>
            <v-form ref="form" lazy-validation v-model="valid">
              <v-text-field
                name="email"
                label="E-mail"
                v-model="form.email"
                :rules="emailRules"
                :counter="255"
                required></v-text-field>
              <v-text-field
                name="password"
                label="Пароль"
                :append-icon="e3 ? 'visibility' : 'visibility_off'"
                @click:append="() => (e3 = !e3)"
                :type="e3 ? 'password' : 'text'"
                min="8"
                v-model="form.password"
                :rules="passwordRules"
                :counter="255"
                required></v-text-field>
            </v-form>
          </v-flex>
        </v-card-title>
        <v-card-actions>
          <v-btn color="blue darken-4" dark @click.stop="onSubmit">Войти</v-btn>
          <v-btn color="blue lighten-4" light @click="$router.push({name: 'registration'})">Регистрация</v-btn>
        </v-card-actions>
      </v-card>
    </v-layout>
  </v-container>
</template>
<script>
  import {ACTIONS} from '@auth/constants'
  import {mapState, mapMutations, mapActions} from 'vuex'

  export default {
    props: {},
    data: function () {
      return {
        e3: true,
        valid: false,
        form: {
          email: '',
          password: '',
        },
        emailRules: [
          v => !!v || 'E-mail обязательный для заполнения',
          v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail должен иметь правильный формат'
        ],
        passwordRules: [
          v => !!v || 'Пароль обязательный для заполнения',
          v => !!v && v.length >= 6 || 'Пароль должен иметь не менее 6 символов'
        ],
        flagError: false,
        arrErrors: [],
        resultMessage: '',
        show: true
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {vm.resetError()})
    },
    computed: {
      ...mapState('Auth', ['showLoginWindow']),
      ...mapState('initializer', {errorMessage: 'message'})
    },
    methods: {
      ...mapMutations('Auth', {setState: 'SET_VARIABLE'}),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      ...mapActions('Auth', {login: ACTIONS.LOGIN}),
      onSubmit() {
        this.login(this.form).then(response => {
          this.$refs.form.reset()
          this.resetError()
          this.$router.push({name: 'list-product'})
        })
      }
    }
  }
</script>