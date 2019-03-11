<template>
  <div>
    <a v-if="visible" href="#" id="popup__toggle"
       @click="close">
      <div class="circlephone" style="transform-origin: center;">
      </div>
      <div class="circle-fill" style="transform-origin: center;">
      </div>
      <div class="img-circle" style="transform-origin: center;">
        <div class="img-circleblock" style="transform-origin: center;"></div>
      </div>
    </a>
    <!--Окно обратного звонка-->
    <div :class="{callbackwindow: true, callbackhidden: !visible}">
      <div v-if="visible" id="btn-cllback"
           @click="close">
        &nbsp;
      </div>
      <div class="callback-form">
        <br><br><br>
        <span class="callback-header">Форма обратной связи</span><br><br>
        <p>
          <input class="form-input-text" :value="form.fio" @input="errors.fio = ''; form.fio = $event.target.value"
                 type="text" placeholder=" *ФИО" name="fio"/>
          <span class="callback-error">{{errors.fio}}</span>
        </p>
        <p>
          <input class="form-input-text" :value="form.company_name"
                 @input="errors.company_name = ''; form.company_name = $event.target.value" type="text"
                 placeholder=" Название компании" name="company_name"/>
          <span class="callback-error">{{errors.company_name}}</span>
        </p>
        <p>
          <input class="form-input-text" :value="form.telephone"
                 @input="errors.telephone = ''; form.telephone = $event.target.value" type="text"
                 placeholder=" *Телефон" name="telephone"/>
          <span class="callback-error">{{errors.telephone}}</span>
        </p>
        <p>
          <input class="form-input-text" :value="form.email"
                 @input="errors.email = ''; form.email = $event.target.value" type="text" placeholder=" *Email"
                 name="email"/>
          <span class="callback-error">{{errors.email}}</span>
        </p>
        <p>
          <textarea class="form-input-textarea" :value="form.comment"
                    @input="errors.comment = ''; form.comment = $event.target.value" placeholder="Комментарий"
                    name="comment"></textarea>
        </p>
        <button @click="send" class="callback-sbmt">Отправить</button>
      </div>
    </div>
  </div>
</template>
<script>
  import {ValidationConvert} from '@initializer/vue/validations'
  import axios from 'axios'
  import {mapState} from 'vuex'

  export default {
    props: {},
    data: function () {
      return {
        isHidden: true,
        validationConvert: new ValidationConvert(),
        errors: {}
      }
    },
    computed: {
      ...mapState('callback', {visible: 'isVisible', form: 'form'})
    },
    methods: {
      send() {
        this.errors = {}
        this.validationConvert.ruleValidations({required: true, max: 50}).forEach(item => {
          let result = item(this.form.fio)
          if (result !== true) {
            this.errors = Object.assign({}, this.errors, {fio: result})
          }
          result = item(this.form.telephone)
          if (result !== true) {
            this.errors = Object.assign({}, this.errors, {telephone: result})
          }
        })
        this.validationConvert.ruleValidations({'regex': '^\\w+([.-]?\\w+)*@\\w+([.-]?\\w+)*(\\.\\w{2,3})+$'}).forEach(item => {
          let result = item(this.form.email)
          if (result !== true) {
            this.errors = Object.assign({}, this.errors, {email: result})
          }
        })
        if (_.isEmpty(this.errors)) {
          axios.post('/callback', this.form).then(response => {
            this.$store.commit('SET_VARIABLE', {module: 'callback', variable: 'form', value: {}})
          })
        }
      },
      close() {
        this.$store.commit('SET_VARIABLE', {module: 'callback', variable: 'isVisible', value: false})
        this.$store.commit('SET_VARIABLE', {module: 'callback', variable: 'form', value: {}})
      }
    }
  }
</script>

<style>
  .callbackwindow {
    position: fixed;
  / / background-color: #FFCA00;
    background-color: #f36c12;
    width: 20%;
    right: 0;
    height: 100%;
  / / min-height: 250 px;
    -webkit-transition: all 1s;
    -moz-transition: all 1s;
    -ms-transition: all 1s;
    -o-transition: all 1s;
    transition: all 1s;
    bottom: 0px;
  }

  #btn-cllback {
    position: absolute;
    right: 102%;
    top: 5px;
    width: 22px;
    height: 22px;
    background: rgba(0, 0, 0, 0) url(/images/close.png) no-repeat scroll 0 0;
    cursor: pointer;
    z-index: 2147483647;
  }

  .callbackhidden {
    right: -20%;
  }

  #popup__toggle {
    bottom: 25px;
    right: 10px;
    position: fixed;
    z-index: 999;
  }

  .img-circle {
    background-color: #29AEE3;
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
  }

  .circlephone {
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
    border: 2px solid #29AEE3;
    width: 150px;
    height: 150px;
    bottom: -25px;
    right: 10px;
    position: absolute;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    opacity: .5;
    -webkit-animation: circle-anim 2.4s infinite ease-in-out !important;
    -moz-animation: circle-anim 2.4s infinite ease-in-out !important;
    -ms-animation: circle-anim 2.4s infinite ease-in-out !important;
    -o-animation: circle-anim 2.4s infinite ease-in-out !important;
    animation: circle-anim 2.4s infinite ease-in-out !important;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all 0.5s;
  }

  .circle-fill {
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
    background-color: #29AEE3;
    width: 100px;
    height: 100px;
    bottom: 0px;
    right: 35px;
    position: absolute;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: circle-fill-anim 2.3s infinite ease-in-out;
    -moz-animation: circle-fill-anim 2.3s infinite ease-in-out;
    -ms-animation: circle-fill-anim 2.3s infinite ease-in-out;
    -o-animation: circle-fill-anim 2.3s infinite ease-in-out;
    animation: circle-fill-anim 2.3s infinite ease-in-out;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all 0.5s;
  }

  .img-circle {
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
    width: 72px;
    height: 72px;
    bottom: 14px;
    right: 49px;
    position: absolute;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    opacity: .7;
  }

  .img-circleblock {
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
    width: 72px;
    height: 72px;
    background-image: url(/images/mini5.png);
    background-position: center center;
    background-repeat: no-repeat;
    animation-name: tossing;
    -webkit-animation-name: tossing;
    animation-duration: 1.5s;
    -webkit-animation-duration: 1.5s;
    animation-iteration-count: infinite;
    -webkit-animation-iteration-count: infinite;
  }

  .img-circle:hover {
    opacity: 1;
  }

  @keyframes pulse {
    0% {
      transform: scale(0.9);
      opacity: 1;
    }
    50% {
      transform: scale(1);
      opacity: 1;
    }
    100% {
      transform: scale(0.9);
      opacity: 1;
    }
  }

  @-webkit-keyframes pulse {
    0% {
      -webkit-transform: scale(0.95);
      opacity: 1;
    }
    50% {
      -webkit-transform: scale(1);
      opacity: 1;
    }
    100% {
      -webkit-transform: scale(0.95);
      opacity: 1;
    }
  }

  @keyframes tossing {
    0% {
      transform: rotate(-8deg);
    }
    50% {
      transform: rotate(8deg);
    }
    100% {
      transform: rotate(-8deg);
    }
  }

  @-webkit-keyframes tossing {
    0% {
      -webkit-transform: rotate(-8deg);
    }
    50% {
      -webkit-transform: rotate(8deg);
    }
    100% {
      -webkit-transform: rotate(-8deg);
    }
  }

  @-moz-keyframes circle-anim {
    0% {
      -moz-transform: rotate(0deg) scale(0.5) skew(1deg);
      opacity: .1;
      -moz-opacity: .1;
      -webkit-opacity: .1;
      -o-opacity: .1;
    }
    30% {
      -moz-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .5;
      -moz-opacity: .5;
      -webkit-opacity: .5;
      -o-opacity: .5;
    }
    100% {
      -moz-transform: rotate(0deg) scale(1) skew(1deg);
      opacity: .6;
      -moz-opacity: .6;
      -webkit-opacity: .6;
      -o-opacity: .1;
    }
  }

  @-webkit-keyframes circle-anim {
    0% {
      -webkit-transform: rotate(0deg) scale(0.5) skew(1deg);
      -webkit-opacity: .1;
    }
    30% {
      -webkit-transform: rotate(0deg) scale(0.7) skew(1deg);
      -webkit-opacity: .5;
    }
    100% {
      -webkit-transform: rotate(0deg) scale(1) skew(1deg);
      -webkit-opacity: .1;
    }
  }

  @-o-keyframes circle-anim {
    0% {
      -o-transform: rotate(0deg) kscale(0.5) skew(1deg);
      -o-opacity: .1;
    }
    30% {
      -o-transform: rotate(0deg) scale(0.7) skew(1deg);
      -o-opacity: .5;
    }
    100% {
      -o-transform: rotate(0deg) scale(1) skew(1deg);
      -o-opacity: .1;
    }
  }

  @keyframes circle-anim {
    0% {
      transform: rotate(0deg) scale(0.5) skew(1deg);
      opacity: .1;
    }
    30% {
      transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .5;
    }
    100% {
      transform: rotate(0deg) scale(1) skew(1deg);
      opacity: .1;
    }
  }

  @-moz-keyframes circle-fill-anim {
    0% {
      -moz-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
    50% {
      -moz-transform: rotate(0deg) -moz-scale(1) skew(1deg);
      opacity: .2;
    }
    100% {
      -moz-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
  }

  @-webkit-keyframes circle-fill-anim {
    0% {
      -webkit-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
    50% {
      -webkit-transform: rotate(0deg) scale(1) skew(1deg);
      opacity: .2;
    }
    100% {
      -webkit-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
  }

  @-o-keyframes circle-fill-anim {
    0% {
      -o-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
    50% {
      -o-transform: rotate(0deg) scale(1) skew(1deg);
      opacity: .2;
    }
    100% {
      -o-transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
  }

  @keyframes circle-fill-anim {
    0% {
      transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
    50% {
      transform: rotate(0deg) scale(1) skew(1deg);
      opacity: .2;
    }
    100% {
      transform: rotate(0deg) scale(0.7) skew(1deg);
      opacity: .2;
    }
  }

  .callback-form {
    margin: 0 auto;
    width: 400px;
  }

  .callback-header {
    font-size: 2em;
    color: white;
  }

  .callback-sbmt {
    vertical-align: bottom;
    background-color: #e27232;
    padding: 5px 10px;
    text-decoration: none;
    display: inline-block;
  @include border-radius(20 px);
    color: white;
    font-size: 0.9em;
    text-transform: uppercase;
  }

  .callback-error {
    color: white;
  }
</style>