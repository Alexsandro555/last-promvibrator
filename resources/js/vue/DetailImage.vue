<template>
  <div class="content-right-product-left">
    <div class="content-right-product-img-big">
      <img :src="curImage" alt="img" class="product-img-big"/>
    </div>
    <div class="content-right-product-img-small">
      <div v-for="item in items" :key="item.id" class="product-img-small-block">
        <div class="product-img-small"  @click="selectSlide(item.id)"><span v-if="item.id === curKey" class="arrow-img-small"></span><img :src="'/storage/'+item.file"/></div>
      </div>
    </div>
    <popup-image v-if="elements.length>0" :modal="modal" :curKey="curKey" :elements="elements" @close="modal=false"/>
  </div>
</template>
<script>
  import axios from "axios/index"
  import PopupImage from '@file/vue/PopupImage'

  export default {
    props: {
      url: String,
    },
    data: function() {
      return {
        elements: [],
        items:[],
        curImage: '',
        curKey: 0,
        modal: true
      }
    },
    components: {
      PopupImage
    },
    mounted() {
      let that = this;
      axios.get(this.url, {}).then(function (response)
      {
        if(response.data.length > 0) {
          that.elements = response.data;
          that.elements.forEach(function (element) {
            let obj = {'id': element.id, 'file': element.config.files.small.filename};
            that.items.push(obj);
          });
          that.curImage = '/storage/' + that.elements[0].config.files.medium.filename
        }
      }).catch(function (error)
      {
        console.log(error);
      });
    },
    methods: {
      selectSlide: function (id, event) {
        this.curKey = id;
        let that = this;
        this.elements.forEach(function(element) {
          if(element.id === id) {
            that.curImage = '/storage/'+element.config.files.medium.filename;
          }
        });
      }
    }
  }
</script>