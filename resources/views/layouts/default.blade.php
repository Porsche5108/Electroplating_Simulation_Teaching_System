<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '主页')</title>
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
      @include('layouts._header')
        <div class="container jumbotron">
            @yield('content')
        </div>
      @include('layouts._footer')
  </body>
</html>