@extends('layouts.master')

@section('menu')
  <div class="menu-wrapper wrapper">
    <div class="abs-position">
      <left-menu></left-menu>
    </div>
  </div>
@endsection

@section('content')
  <div class="content">
    <div class="wrapper content-wrapper">
      <v-layout row wrap>
        <v-flex xs2>
          <div class="left-banner">
            <div class="left-banner__content text-xs-left">
                            <span>
                                Мотор-<br>
                                редукторы<br>
                            </span>
              двигатели и<br>
              компоненты<br>
              <p>
                <a href="#">Подробнее</a>
              </p>

            </div>
            <img class="left-banner__img-ugl" src="{{asset('images/left-banner-layout-ugl.png')}}"/>
          </div>
        </v-flex>
        <v-flex xs10 text-xs-left class="bottom-20">
          <div class="content__left-our-products">
            <v-layout row wrap>
              <v-flex xs9>
                <p class="headsite">
                  <span>Наша продукция</span><br>
                  кто мы и что предлагаем
                </p>
              </v-flex>
              <v-flex xs3 text-xs-right>
                <a href="#" class="content-button content-button--margin">Смотреть каталог</a>
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              @foreach($ourProducts as $ourProduct)
                <div class="product-wrapper">
                  <div class="product">
                    <div class="product-image-wrapper">
                      <div class="product-image">
                        @if($ourProduct->files->count()>0)
                          @foreach($ourProduct->files as $fileRecord)
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
                      <a href="/catalog/detail/{{$ourProduct->url_key}}">
                        {{str_limit($ourProduct->title, $limit = 27, $end="...")}}
                      </a>
                    </div>
                    <v-layout row wrap>
                      <v-flex xs8 text-xs-center>
                        <span class="product-old-price">{{$ourProduct->price}} руб.</span><br>
                        <span class="product-price-wrapper">
                                                        <span class="product-price">{{$ourProduct->price}}</span> руб.
                                                    </span>
                      </v-flex>
                      <v-flex xs4>
                        <img class="btn-sale" @click="addCart({{$ourProduct->id}})" src="{{asset('images/btn-sale.png')}}"/>
                      </v-flex>
                    </v-layout>
                  </div>
                </div>
              @endforeach
            </v-layout>
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
              <span>Лучшие продажи</span><br>
              популярные продукты
            </p>
          </v-flex>
          <v-flex xs3 text-xs-right>
            <a href="#" class="content-button">Смотреть каталог</a>
          </v-flex>
        </v-layout>
        <v-layout row wrap>
          @foreach($specialProducts as $specialProduct)
            <div class="product-wrapper">
              <div class="product">
                <div class="product-image-wrapper">
                  <div class="product-image">
                    @if($specialProduct->files->count()>0)
                      @foreach($specialProduct->files as $fileRecord)
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
                  <a href="/catalog/detail/{{$specialProduct->url_key}}">
                    {{str_limit($specialProduct->title, $limit = 27, $end="...")}}
                  </a>
                </div>
                <v-layout row wrap>
                  <v-flex xs8 text-xs-center>
                    <span class="product-old-price">{{$specialProduct->price}} руб.</span><br>
                    <span class="product-price-wrapper">
                                                        <span class="product-price">{{$specialProduct->price}}</span> руб.
                                                    </span>
                  </v-flex>
                  <v-flex xs4>
                    <img class="btn-sale" @click="addCart({{$specialProduct->id}})" src="{{asset('images/btn-sale.png')}}"/>
                  </v-flex>
                </v-layout>
              </div>
            </div>
          @endforeach
        </v-layout>
      </v-flex>
    </div>
  </div>
  <div class="about">
    <div class="wrapper about__content">
      <v-layout row wrap>
        <v-flex xs3>
          <p class="about__brands">
            Наши бренды
          </p>
          <div class="brands--wrapper">
            <div class="brands text-xs-center">
              <img src="{{asset('images/brands-images.png')}}"/>
            </div>
          </div><br>
          <p class="about__social">
            Мы в соцсетях
          </p>
          <a href="#">
            <img src="{{asset('images/about-social-f.png')}}"/>
          </a>
          <a href="#">
            <img src="{{asset('images/about-social-t.png')}}"/>
          </a>
          <a href="#">
            <img src="{{asset('images/about-social-ok.png')}}"/>
          </a>
          <a href="#">
            <img src="{{asset('images/about-social-vk.png')}}"/>
          </a>
          <a href="#">
            <img src="{{asset('images/about-social-y.png')}}"/>
          </a>
        </v-flex>
        <v-flex xs6 text-xs-left class="about__info">
          <p class="about__head">
            <span>О компании</span><br>
            особенности покупки в нашем магазине
          </p>
          <p>
            Мы понимаем, что нашим клиентам очень важно соблюдать сроки сдачи работ.<br>
            Поэтому отгрузка товара осуществляется в течение одного рабочего дня с <br>
            момента поступления оплаты.
          </p>
          <p>
            Узнать подробнее об условиях доставки Вы можете при оформлении заказа у<br>
            нашего специалиста по телефону <span class="about__telephone">+7 (495) 780 47 96</span><br>
            или сделать запрос по электронной почте
          </p>
          <v-list class="about__list">
            <v-list-tile>Оплата производится по безналичному расчету.</v-list-tile>
            <v-list-tile>Возможна оплата наличными при доставке на объект Заказчика.</v-list-tile>
          </v-list>
        </v-flex>
        <v-flex xs3 text-xs-center>
          <div text-xs-center>
            <div class="product-wrapper">
              <div class="product__lable-sale">
                Акция!
              </div>
              <img class="product__label--img" src="{{asset('images/label-sale.png')}}"/>
              <div class="product text-xs-center" >

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
                    <img class="btn-sale" src="{{asset('images/btn-sale.png')}}"/>
                  </v-flex>
                </v-layout>
              </div>
            </div>
          </div>
        </v-flex>
      </v-layout>
    </div>
  </div>
  <div class="news">
    <div class="wrapper news__content">
      <v-layout row wrap>
        <v-flex xs8 text-xs-left>
          <v-layout row wrap>
            <v-flex xs8>
              <p class="about__head">
                <span>Новости индустрии</span><br>
                и нашей компании
              </p>
            </v-flex>
            <v-flex xs3 text-xs-right>
              <a href="/news/list" class="content-button">Все новости</a>
            </v-flex>
          </v-layout>
          <v-layout row wrap>
            @foreach($news as $oneNews)
              <v-flex xs3 class="news__block">
                <span class="news__number">{{$oneNews->id}}<span class="news__date">{{$oneNews->updated_at->format('d.m')}}</span></span><br>
                <a class="news__link" href="/news/{{$oneNews->url_key}}">{{$oneNews->title}}</a><br>
                {{str_limit(strip_tags($oneNews->content), $limit = 57, $end="...")}}
              </v-flex>
            @endforeach
          </v-layout>
        </v-flex>
        <v-flex xs4>
          <div class="news__big-image">
            <img src="{{asset('images/big-electric-motor.png')}}"/>
          </div>
        </v-flex>
      </v-layout>
    </div>
  </div>
@endsection