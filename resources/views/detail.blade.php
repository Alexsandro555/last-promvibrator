@extends('layouts.master')

@section('content')
  <div class="content">
    <div class="wrapper detail content__product-margin">
      <div class="breadcrumbs">
        <div class="wrapper">
          <v-flex xs12 text-xs-left>
            {{ Breadcrumbs::render() }}
          </v-flex>
        </div>
      </div>
      <v-layout row wrap>
        <v-flex xs3>
          <left-menu></left-menu>
        </v-flex>
        <v-flex xs9>
          <v-layout row wrap>
            <v-flex xs5>
              <detail-image :stock="{{$product->special?$product->special:'false'}}" :url="'/files/product-image/{{$product->id}}'"/>
            </v-flex>
            <v-flex xs7 class="detail__info" text-xs-left>
              <h1>{{$product->title}}</h1>
              <span style="line-height: 1.2">{{$product->vendor}} описание</span><br>
              <img src="{{asset('images/heading.png')}}"/><br><br>
              <div class="detail__price">
                <span class="detail__old-price">{{$product->price}} руб.</span><br>
                <span class="detail__price--current">{{$product->price}}</span> руб.<br>
              </div>
              <div>
                <v-layout row wrap>
                  <div class="figure-button__wrapper">
                    <div class="figure-button__wrapper-2">
                      <a class="figure-button" @click="addCart({{$product->id}})" href="#">
                        Заказать
                        <img src="{{asset('images/btn-sale-image.png')}}" align="center"/>
                      </a>
                    </div>
                  </div>
                  <div class="button-ask-sale__wrapper">
                    <div class="button-ask-sale__wrapper-2">
                      <a class="button-ask-sale" href="#">Узнать скидку</a>
                    </div>
                  </div>
                </v-layout>
              </div>
              <br><br>
              <p>
                {{str_limit(strip_tags($product->description), $limit = 27, $end="...")}}
              </p>

            </v-flex>
          </v-layout>
          <div class="detail__advanced-info">
            <v-tabs slider-color="yellow" class="detail__characteristics">
              <v-tab key="description">Опсание</v-tab>
              <v-tab key="characteristics">Тех. характеристики</v-tab>
              <v-tab key="advantages">Преимущества</v-tab>
              <v-tab key="video">Видео</v-tab>
              <v-tab-item key="description">
                <div class="detail__characteristics-description">
                  <h2>Описание</h2>
                  <img src="{{asset('images/yellow-line.png')}}"/><br>
                  {{$product->description}}
                </div>
              </v-tab-item>
              <v-tab-item key="characteristics">
                <div class="detail__characteristics-characteristics">
                  <h2>Характеристики</h2>
                  <img src="{{asset('images/yellow-line.png')}}"/><br>
                  <v-layout row wrap>
                    @foreach($product->attributes->chunk(9) as $chunkAttributes)
                      <dl class="detail__characteristics-characteristics-attributes">
                        @foreach($chunkAttributes as $attribute)
                          <dt>{{$attribute->title}}</dt>
                          <dd class="detail__characteristics--value">{{$attribute->pivot->value}}</dd>
                        @endforeach
                      </dl>
                    @endforeach
                  </v-layout>
                </div>
              </v-tab-item>
              <v-tab-item key="advantages">
                <div class="detail__characteristics-advantages">

                </div>
              </v-tab-item>
              <v-tab-item key="video">
                <div class="detail__characteristics-video">

                </div>
              </v-tab-item>
            </v-tabs>
          </div>
        </v-flex>
      </v-layout>
    </div>
  </div>
  <div class="best-sale">
    <div class="wrapper">
      <v-flex xs12 text-xs-left class="bottom-20">
        <v-layout row wrap>
          <v-flex xs9>
            <p class="headsite_best-sale">
              <span>Смотрите также</span><br>
              популярные продукты
            </p>
          </v-flex>
          <v-flex xs3 text-xs-right>
            <a href="#" class="content-button">Смотреть каталог</a>
          </v-flex>
        </v-layout>
        <v-layout row wrap>
          <div class="product-wrapper">
            <div class="product">
              <div class="product-image-wrapper">
                <div class="product-image">
                  <img src="{{asset('images/product-image.png')}}"/>
                </div>
              </div>
              <div class="product__title">
                <a href="#">Название электродвигателя</a>
              </div>
              <v-layout row wrap>
                <v-flex xs8 text-xs-center>
                  <span class="product-old-price">25 366.00 руб.</span><br>
                  <span class="product-price-wrapper">
                                                        <span class="product-price">22 366.00</span> руб.
                                                    </span>
                </v-flex>
                <v-flex xs4>
                  <img src="{{asset('images/btn-sale.png')}}"/>
                </v-flex>
              </v-layout>
            </div>
          </div>
          <div class="product-wrapper">
            <div class="product">
              <div class="product-image-wrapper">
                <div class="product-image"></div>
              </div>
            </div>
          </div>
        </v-layout>
      </v-flex>
    </div>
  </div>
  <div class="SEO">
    <div class="wrapper">
      <v-flex xs12 text-xs-left class="bottom-20 top-20">
        <p class="headsite">
          <span>Заголовок SEO</span><br>
        </p>
        <p>
          Современная приводная техника пришла на смуну устаревшим моделям, которые уже свое отработали.
        </p>
      </v-flex>
    </div>
  </div>
@endsection