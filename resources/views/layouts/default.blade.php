<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '主页')</title>
    <link rel="shortcut icon" href="/images/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/unity.min.js"></script>

  </head>
  <body>

        @include('layouts._header')
        @include('shared.messages')
        <div class="container jumbotron">
            @yield('content')
            @include('layouts._footer')
        </div>

        <script src="/js/app.js"></script>
  </body>
</html>
