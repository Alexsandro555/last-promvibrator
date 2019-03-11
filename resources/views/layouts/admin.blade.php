<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div id="app" v-cloak>
    <span class="v-cloak--block"></span>
    <v-app class="v-cloak--hidden leader">
      <v-container pa-0 fluid grid-list-xs text-xs-center>
        <v-layout column wrap>
          @yield('content')
        </v-layout>
      </v-container>
      <!--<dialog-registration/>-->
    </v-app>
  </div>
  <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
  <script src="{{mix('/js/main.js')}}" type="application/javascript"></script>
  @yield('view.scripts')
</body>
</html>