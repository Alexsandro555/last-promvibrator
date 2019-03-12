@extends('layouts.master')

@section('title', $product->title.' - '.$product->price.'..ПРОМВИБРАТОР.РУ.')

@section('sidebar')
  <div class="content-left-menu"></div>
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    <div class="content-right-navtral">
      @foreach($breadcrumbs as $key => $breadcrumb)
        @if(!$loop->last)
          <a href="{{$breadcrumb->slug}}">{{$breadcrumb->title}}</a>
          <img src="{{asset('/css/images/arrow-right.png')}}" class="img-arrow"/>
        @else
          {{$breadcrumb->title}}
        @endif
      @endforeach
    </div>
    <h1 class="h1-product">{{$product->title}}</h1>
    <div class="content-right-product">
      @if($product->special)
        <div class="tab-li-stiker-hit"></div>
      @endif
      <leader-detail-image :url="'/product-images/{{$product->id}}'"></leader-detail-image>
      <div class="content-right-product-right">
        <div class="product-right-stock"><b>На складе:</b> {{$product->qty>0?"есть":"нет"}}</div>
        <div class="product-right-garant"><b>Гарантия:</b> 12 месяцев.</div>
        <div class="product-right-shopping">
          <b>Доставка:</b> <br>
          <a href="">Москва</a>&nbsp;&nbsp;&nbsp;
          <a href="">Московская область</a>&nbsp;&nbsp;&nbsp;
          <a href="">Другие города</a>
          <a href="">Самовывоз</a>
        </div>
        <div class="product-right-prise">
          <b>
            {{$product->price}}&#8381;
          </b><br>
          <input class="cart-col product_qty2" name="quantity" type="text" id="prod-{{$product->id}}" value="1">
          <div class="div-minus" @click.prevent="downQty({{$product->id}})">-</div>
          <div class="div-plus" @click.prevent="upQty({{$product->id}})">+</div>
        </div>
        <div class="product-right-buttom">
          <input class="cart-submit" type="submit" value="В корзину" @click.prevent="addCart({{$product->id}})">
          <input class="click-submit" type="submit" value="Купить в один клик" @click.prevent="addCartOneClick({{$product->id}})">
        </div>
      </div>
    </div>
    <h2 class="h2-product">Характиристики и описание</h2>
  </div>
  <a href=""><img src="{{asset('css/images/banner-sale.png')}}" alt="img" class="img-banner"></a>
@stop