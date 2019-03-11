@extends('layouts.master')

@section('menu')
  <div class="menu-wrapper wrapper">
    <div class="abs-position">
      <left-menu :prop-toggle="false"></left-menu>
    </div>
  </div>
@endsection

@section('content')
  <div class="content">
    <div class="wrapper content__product-margin">
      <div class="breadcrumbs">
        <div class="wrapper">
          <v-flex xs12 text-xs-left>
            {{ Breadcrumbs::render() }}
          </v-flex>
        </div>
      </div>
      <v-flex xs12 text-xs-left class="top-20 bottom-20">
        <p class="headsite">
          <span>{{$lineProduct->title}}</span><br>
        </p>
        @foreach($lineProduct->products->chunk(5) as $chunkProducts)
          <v-layout row wrap>
            @foreach($chunkProducts as $product)
              <div class="product-wrapper">
                <div class="product">
                  <div class="product-image-wrapper">
                    <div class="product-image">
                      @if($product->files->count()>0)
                        @foreach($product->files as $fileRecord)
                          @foreach($fileRecord->config as $files)
                            @foreach($files as $key => $file)
                              @if($key == 'medium')
                                <img src="/storage/{{$file['filename']}}"/>
                              @endif
                            @endforeach
                          @endforeach
                          @break
                        @endforeach
                      @else
                        <img src="{{asset('images/no-image-medium.png')}}"/>
                      @endif
                    </div>
                  </div>
                  <div class="product__title">
                    <a href="/catalog/detail/{{$product->url_key}}">
                      {{str_limit($product->title, $limit = 27, $end="...")}}
                    </a>
                  </div>
                  <v-layout row wrap>
                    <v-flex xs8 text-xs-center>
                      <span class="product-old-price">{{$product->price}} руб.</span><br>
                      <span class="product-price-wrapper">
                                                        <span class="product-price">{{$product->price}}</span> руб.
                                                    </span>
                    </v-flex>
                    <v-flex xs4>
                      <img src="{{asset('images/btn-sale.png')}}"/>
                    </v-flex>
                  </v-layout>
                </div>
              </div>
            @endforeach
          </v-layout>
        @endforeach
      </v-flex>
    </div>
  </div>
@endsection