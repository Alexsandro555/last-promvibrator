<template>
  <div class="content-right-product-left">
    <div class="content-right-product-img-big">
      <img v-if="images.length>0" :src="'/storage/'+curImage" @click.prev="selectImage" alt="img" class="product-img-big"/>
      <img v-else src="css/images/no-image-medium.png"/>
    </div>
    <div class="content-right-product-img-small">
      <div v-for="image in images" :key="image.id" class="product-img-small-block">
        <div class="product-img-small"  @click.prev="selectSlide(image.id)">
          <span v-if="image.id === curKey" class="arrow-img-small"></span>
          <img :src="'/storage/'+image.config.files.small.filename"/>
        </div>
      </div>
    </div>
    <popup-image v-if="images.length>0" :modal="modal" :cur-key="curKey" :elements="images" @close="closeModal($event)"/>
  </div>
</template>
<script>
  import PopupImage from '@file/vue/PopupImage'

  export default {
    props: {
      images: {
        type: Array,
        default: []
      }
    },
    data: function () {
      return {
        curImage: this.images[0].config.files.main.filename,
        curKey: this.images[0].id,
        modal: false
      }
    },
    components: {
      PopupImage
    },
    methods: {
      selectSlide(id, event) {
        this.curKey = id;
        this.images.forEach(image => {
          if(image.id === id) {
            this.curImage = image.config.files.main.filename;
          }
        })
      },
      selectImage() {
        this.modal = true;
      },
      closeModal(id) {
        this.modal=false
        this.curKey = id
        this.images.forEach(image => {
          if(image.id === this.curKey) {
            this.curImage = image.config.files.main.filename;
          }
        })
      }
    }
  }
</script>

