@extends('layouts.master')

@section('title', $product->title.' - '.$product->price.'..ПРОМВИБРАТОР.РУ.')

@section('sidebar')
  <div class="content-left-menu"></div>
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content product-details">
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
      <detail-image :url="'/product-images/{{$product->id}}'"></detail-image>
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
    <div class="tabs">
      <ul>
        @foreach($groups as $group)
          <li><a href="#tabs-group-{{$group->id}}">{{$group->title}}</a></li>
        @endforeach
        <li><a href="#tabs-1">Описание</a></li>
      </ul>
      @foreach($groups as $group)
        <div class="tabs-content" id="tabs-group-{{$group->id}}">
          @foreach($product->attributes->filter(function($attribute, $key) use (&$group){
              return $attribute->attribute_group_id == $group->id;
          })->sortBy('sort')->chunk(10) as $chunkAttributes)
            <div class="tabs__characteristics">
              <dl class="tabs__characteristics-attributes">
                @foreach($chunkAttributes as $attribute)
                  @if($attribute->attribute_type_id == 3)
                    <dt>{{$attribute->title}}</dt><dd class="tabs__characteristics--value">{{$attribute->pivot->integer_value}} {{$attribute->attribute_unit?$attribute->attribute_unit->title:""}}</dd>
                  @endif
                  @if($attribute->attribute_type_id == 4)
                    <dt>{{$attribute->title}}</dt><dd class="tabs__characteristics--value">{{$attribute->pivot->double_value}} {{$attribute->attribute_unit?$attribute->attribute_unit->title:""}}</dd>
                  @endif
                  @if($attribute->attribute_type_id == 5)
                    <dt>{{$attribute->title}}</dt><dd class="tabs__characteristics--value">{{$attribute->pivot->date_value}} {{$attribute->attribute_unit?$attribute->attribute_unit->title:""}}</dd>
                  @endif
                  @if($attribute->attribute_type_id == 7)
                    <dt>{{$attribute->title}}</dt><dd class="tabs__characteristics--value">{{$attribute->pivot->decimal_value}} {{$attribute->attribute_unit?$attribute->attribute_unit->title:""}}</dd>
                  @endif
                @endforeach
              </dl>
            </div>
          @endforeach
        </div>
      @endforeach
      <div id="tabs-1">
        @if($product->description)
          {{strip_tags($product->description)}}
        @elseif($product->lineProduct && $product->lineProduct->description)
          {{$product->lineProduct->description}}
        @elseif($product->typeProduct && $product->typeProduct->description)
          {{$product->typeProduct->description}}
        @elseif($product->productCategory && $product->productCategory->description)
          {{$product->productCategory->description}}
        @endif
      </div>
    </div>
  </div>
  <a href=""><img src="{{asset('css/images/banner-sale.png')}}" alt="img" class="img-banner"></a>
@stop

@section('view.scripts')
  <script src="{{asset('js/jquery-ui.min.js')}}"></script>
  <script>
    $('.tabs').tabs(
      {
        active: 0
      }
    );
  </script>
@endsection