@extends('layouts.master')

@section('title', "ПРОМВИБРАТОР.РУ. Площадочные вибраторы, глубинные вибраторы и пневматические вибраторы - результаты поиска")

@section('sidebar')
  @include('sidebar_menu',['elements' => $productCategories])
  @include('sidebar',['articles' => $articles])
@stop

@section('content')
  <div id="content">
    @if($products->isNotEmpty())
      <h1>Результаты поиска</h1>
      <ul class="content-right-tab-ul content-right-tab-ul-a">
        @foreach($products as $product)
          <li>
            <div class="tab-li-stiker-hit"></div>
            @if($product->onsale)
              <div class="tab-li-stiker-sale"></div>
            @endif
            <div class="tab-li-title">
              <a href="/{{$product->productCategory->url_key}}.php?id={{$product->old_id}}">{{$product->title}}</a>
            </div>
            <div class="tab-li-img">
              <a href="/{{$product->url_key}}">
                @foreach($product->files as $file)
                  @foreach($file->config as $filesItem)
                    @foreach($filesItem as $key=>$fileItem)
                      @if($key === "medium")
                        <img src="{{asset('/storage/'.$fileItem["filename"])}}" alt="">
                      @endif
                    @endforeach
                  @endforeach
                @endforeach
              </a>
            </div>
            <div class="tab-li-info">
              <?php $counter=1; ?>
              @foreach($product->attributes as $attribute)
                @if($attribute->pivot->value)
                  {{$attribute->title}}: <b> {{$attribute->pivot->value}}</b><br/>
                  <?php $counter++; if($counter>3) break;?>
                @endif
              @endforeach
            </div>
            <div class="tab-li-price">
              {{$product->price}}&#8381;
            </div>
            <div class="tab-li-button">
              <input class="cart-submit" type="submit" value="В корзину" @click.prevent="addCart({{$product->id}})">
              <input class="cart-col product_qty2" name="Name" id="prod-{{$product->id}}" type="text" value="1">
              <div class="div-minus" @click.prevent="downQty({{$product->id}})">-</div>
              <div class="div-plus" @click.prevent="upQty({{$product->id}})">+</div>
            </div>
          </li>
        @endforeach
    </ul>
    <div class="content-links">
      {{ $products->links() }}
    </div>
    @else
      <h1>По вашему запросу ничего не найдено</h1>
    @endif

  </div>
@endsection