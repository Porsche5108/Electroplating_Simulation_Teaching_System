<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '主页')</title>
    <link rel="shortcut icon" href="/images/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>

        @include('layouts._header')
        <div class="container jumbotron">
            @include('shared.messages')
            @yield('content')
            @include('layouts._footer')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/app.js"></script>

  </body>
</html>
