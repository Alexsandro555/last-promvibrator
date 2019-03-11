<template>
  <v-container fluid fill-height>
    <v-layout justify-center align-center>
      <v-card width="600px">
        <v-responsive dark height="100px" class="register-head">
        <v-flex xs11 offset-xs1 class="left">
          <br>
          <span class="display-1">Регистрация</span>
        </v-flex>
      </v-responsive>
        <v-card-title>
        <v-flex xs12>
          <v-form ref="form" lazy-validation v-model="valid">
            <v-text-field
              name="name"
              label="Имя"
              v-model="form.name"
              :rules="nameRules"
              :error-messages="messages.name"
              :counter="255"
              required>
            </v-text-field>
            <v-text-field
              name="email"
              label="E-mail"
              v-model="form.email"
              :rules="emailRules"
              :counter="255"
              :error-messages="messages.email"
              required>
            </v-text-field>
            <v-text-field
              name="password"
              label="Пароль"
              :append-icon="e3 ? 'visibility' : 'visibility_off'"
              @click:append="() => (e3 = !e3)"
              :type="e3 ? 'password' : 'text'"
              min="8"
              v-model="form.password"
              :rules="passwordRules"
              :error-messages="messages.password"
              :counter="255"
              required>
            </v-text-field>
            <v-text-field
              name="password-confirm"
              label="Подтверждение пароля"
              :append-icon="e3 ? 'visibility' : 'visibility_off'"
              @click:append="() => (e3 = !e3)"
              :type="e3 ? 'password' : 'text'"
              min="8"
              v-model="form.password_confirmation"
              :rules="confirmRules"
              :counter="255"
              required>
            </v-text-field>
          </v-form>
        </v-flex>
      </v-card-title>
        <v-card-actions>
          <v-btn color="blue darken-4" dark @click.stop="onRegister">Зарегистрироваться</v-btn>
        </v-card-actions>
    </v-card>
    </v-layout>
  </v-container>
</template>
<script>
  import { mapActions, mapState, mapMutations } from 'vuex'
  import {ACTIONS} from '@auth/constants'
  import axios from 'axios'

  export default {
    props: { },
    data() {
      return {
        valid: false,
        form: {
          name: '',
          email: '',
          password: '',
          password_confirmation: ''
        },
        nameRules: [
          v => !!v || 'Обязательно для заполнения',
          v => v && v.length <= 255 || 'Длина не должна превышать 255 символов'
        ],
        emailRules: [
          v => !!v || 'E-mail обязательный для заполнения',
          v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail должен иметь правильный формат'
        ],
        passwordRules: [
          v => !!v || 'Пароль обязательный для заполнения',
          v => v && v.length >=6 || 'Пароль должен иметь не менее 6 символов'
        ],
        confirmRules: [
          v => !!v || 'Обязательно для заполнения',
          v => v == this.form.password || 'Пароли не совпадают'
        ],
        e3: true,
        show: true
      }
    },
    computed: {
      ...mapState('Auth', ['showRegWindow']),
      ...mapState('initializer', ['messages'])
    },
    methods: {
      ...mapMutations('Auth', {setState: 'SET_VARIABLE'}),
      ...mapActions('Auth', {register: ACTIONS.REGISTER}),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      onRegister() {
        if(this.$refs.form.validate()) {
          this.register(this.form).then(response => {
            this.$refs.form.reset()
            this.resetError()
            this.$router.push({name: 'login'})
          })
        }
      }
    }
  }
</script>
<style>
  .register-head {
    background-color: #0e47a1;
    color: white;
  }
</style>