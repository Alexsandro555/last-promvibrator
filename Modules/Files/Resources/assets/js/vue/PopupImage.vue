<template>
  <div>
    <modal-window v-if="modal" @close="closeModal" :width="width" :height="height" :left="left" :top="top">
      <div class="callback_close" @click="closeModal"></div>
      <img @click="next" v-if="isNext" class="popup-next" :style="{ 'top': height/2 + 'px'}" src="../../images/popup-next.png"/>
      <img @click="prev" v-if="isPrev" class="popup-prev" :style="{ 'top': height/2 + 'px'}" src="../../images/popup-prev.png"/>
      <div class="popup-content" :style="{height: height + 'px', width: width + 'px' }" >
          <img class="popup-image" :src="`/storage/${this.curImage}`"/>
      </div>
    </modal-window>
  </div>
</template>
<script>
  import ModalWindow from "@initializer/vue/ModalWindow.vue"

  export default {
    props: {
      width: {
        type: Number,
        default: 600
      },
      height: {
        type: Number,
        default: 500
      },
      left: {
        type: Number,
        default: 150
      },
      top: {
        type: Number,
        default: 120
      },
      elements: {
        type: Array,
        default: []
      },
      curKey: {
        type: Number,
        required: true
      },
      modal: {
        type: Boolean,
        required: true
      }
    },
    data: function () {
      return {
        images: [],
        index: this.curKey
      }
    },
    computed: {
      curImage() {
        return this.elements.find(element => element.id === this.index).config.files.main.filename
      },
      isPrev() {
        return this.index !== this.elements[0].id
      },
      isNext() {
        return this.index !== this.elements[this.elements.length-1].id
      }
    },
    watch: {
      curKey(val) {
        this.index = val
      }
    },
    components: {
      ModalWindow
    },
    methods: {
      closeModal() {
        this.$emit('close')
      },
      next() {
        this.elements.forEach((element, index) => {
          if(element.id === this.index) {
            if(this.elements[index + 1]) {
              this.index = this.elements[index + 1].id
            }
          }
        })
      },
      prev() {
        this.elements.forEach((element, index) => {
          if(element.id === this.index) {
              if(this.elements[index - 1]) {
                this.index = this.elements[index - 1].id
              }
          }
        })
      }
    }
  }
</script>

<style>
  .popup-content {
    display: flex;
    justify-content: center;
  }

  .popup-image {
    align-self: center;
  }

  .popup-next {
    cursor: pointer;
    height: 22px;
    position: absolute;
    right: -34px;
    width: 22px;
    z-index: 2147483647;
  }

  .popup-prev {
    cursor: pointer;
    height: 22px;
    position: absolute;
    left: -34px;
    width: 22px;
    z-index: 2147483647;
  }

  .popup-image-content {
    display: inline-block;
    vertical-align: middle;
    height: 100%;
  }
</style>