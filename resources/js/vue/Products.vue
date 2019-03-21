<template>
  <div>
    <ul class="content-right-tab-ul content-right-tab-ul-a">
      <li v-for="product in products">
        <div v-if="product.special" class="tab-li-stiker-hit"></div>
        <div v-if="product.onsale" class="tab-li-stiker-sale"></div>
        <div class="tab-li-title">
          <a :href="'/'+product.product_category.url_key+'.php?id='+product.old_id">{{product.title}}</a>
        </div>
        <div class="tab-li-img">
          <a :href="'/'+product.url_key">
            <img v-if="product.files.length>0" :src="'/storage/'+product.files[0].config.files.medium.filename" alt="">
            <img v-else src="/../css/images/no-image-medium.png"/>
          </a>
        </div>
        <div class="tab-li-info">
          Атрибуты тут
        </div>
        <div class="tab-li-price">
          {{product.price}}&#8381;
        </div>
        <div class="tab-li-button">
          <input class="cart-submit" type="submit" value="В корзину" @click.prev="addCart(product.id)" >
          <input class="cart-col product_qty2" name="Name" type="text" value="1">
          <div class="div-minus" @click.prevent="downQty(product.id)">-</div>
          <div class="div-plus" @click.prevent="upQty(product.id)">+</div>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
  export default {
    props: {
      products: {
        type: Array,
        default: []
      }
    }
  }
</script>