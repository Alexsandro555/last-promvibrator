<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="{{asset('css/images/favicon.ico')}}" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="{{asset('css/normalize-2.1.2.css')}}">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,300italic,400italic,800italic,600italic,700italic' rel='stylesheet' type='text/css'>
  <link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('view.style')
  <title>@yield('title')</title>
</head>
<body>
<div class="wraper" id="app">
  <header class="header">
    <div class="header-top">
      <div class="header-top-a">
        <a href="/">Главная</a>
        <a href="/akzia.php">Акция</a>
        <a href="/order.php">Заказ</a>
        <a href="">Партнеры</a>
        <a href="/contacts.html">Контакты</a>
      </div>
      <div class="header-top-b">
        <a class="header-top-b-l" href="/admin">Личный кабинет</a>
        <cart-widget>
          <template slot-scope="slotProps">
            <span>
              <a class="header-top-b-c" @click.prev="showCartModal" href="#">
                  <span v-if="slotProps.count>0">@{{slotProps.count}} товар(ов), @{{slotProps.total}} руб.</span>
                  <span v-else>Корзина пуста</span>
              </a>
            </span>
          </template>
        </cart-widget>
      </div>
    </div>
    <div class="header-center">
      <a class="header-logo" href="/"></a>
      <div id="basket"></div>
      <div class="header-center-phone"><span>+7 (495)</span> 123-33-21</div>
      <div class="header-center-time">Промышленные<br />площадочные<br>вибраторы</div>
      <a class="header-center-callback2"  href="mailto:info@oooleader.ru">info@oooleader.ru</a>
      <div id="callback_fixel" style="display:none;"></div>
      <div id="callback" style="display:none;">
        <div class="callback_close"></div>
        <strong>Обратный звонок</strong>
        <input class="callback-phone" name="Name" type="text" value="" placeholder="Телефон">
        <input class="callback-name" name="Name" type="text" value="" placeholder="Ваше имя">
        <input class="callback-submit" type="submit" value="Отправить">
      </div>

      <div class="header-center-search">
        <span class="span-big">Поиск по каталогу:</span><br>
        <input name="name" type="text" @keyup.enter="search" v-model="searchText"><br>
        <span class="span-small">Например: </span> MVE 60/3
      </div>
    </div>
    <div class="header-menu">
      <a class="header-menu-a-a" href="/mve/">Площадочные<br>вибраторы OLI</a>
      <a class="header-menu-a-b" href="/pnevmo/">Пневматические<br>вибраторы</a>
      <a class="header-menu-a-c" href="/aeration/">Системы<br />виброаэрации </a>
      <a class="header-menu-a-d" href="/concrete/">Глубинные<br />вибраторы</a>
      <a class="header-menu-a-e" href="/hydro/">Гидравлические<br />вибраторы</a>
      <a class="header-menu-a-f">Виброрейки</a>
      <a class="header-menu-a-h">Виброплощадки</a>
      <a class="header-menu-a-j">Трамбовки</a>
    </div>
  </header>
  <div class="content">
    <div class="content-left">
      @yield('sidebar')
    </div>
    <div class="content-right">
      @yield('content')
    </div>
    <cart-modal></cart-modal>
  </div>
  <footer class="footer">
    <div class="footer-top">
      <div class="footer-top-block-a">
        <div class="footer-top-block-title">О магазине</div>
        <a href="">Доставка и оплата</a><br>
        <a href="">Возврат</a><br>
        <a href="">Статьи</a><br>
        <a href="/contacts.html">Контакты</a><br>
      </div>

      <div class="footer-top-block-b">
        <div class="footer-top-block-title">Каталог</div>
        @foreach($productCategories as $productCategory)
          <a href="/{{$productCategory->url_key}}/">{{$productCategory->title}}</a><br>
        @endforeach
      </div>

      <div class="footer-top-block-c">
        <div class="footer-top-block-title">Мы в соц сетях</div>
        <a class="footer-top-block-с-a" href="">В контакте</a><br>
        <a class="footer-top-block-с-b" href="">Однокласники</a><br>
        <a class="footer-top-block-с-c" href="">Facebook</a><br>
      </div>
      <a class="logo-bottom" href=""><img src="{{asset('css/images/logo-bottom.png')}}" alt="logo"></a>
    </div>
    <div class="footer-bottom">
      <div class="footer-bottom-copy">&copy; 2019 Promvibrator.ru</div>
      <div class="footer-bottom-menu">
        <a href="/">Главная</a>
        <a href="/order.php">Заказ</a>
        <a href="">Партнеры</a>
        <a href="/contacts.html">Контакты</a>
      </div>
      <div class="footer-bottom-phone">+7 (495) 123-33-21</div>
      <a class="footer-bottom-callback" @click.prev="showCallback" href="#">заказать звонок</a>
    </div>
  </footer>
  <callback/>
</div>
<script src="{{asset('js/main.js')}}" type="application/javascript"></script>
@yield('view.scripts')
</body>
</html>