<header class="navbar-fixed-top">
  <nav class="navbar navbar-default">
    <ul class="nav navbar-nav navbar-left">
      <li><img src="/images/icon.ico" alt="主页" /></li>
      <li>电镀模拟系统</li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::check())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('users.show', Auth::user()->id) }}"><img src="/images/glyphicons-196-info-sign.png" alt="info"/>  个人中心</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><img src="/images/glyphicons-82-refresh.png" alt="info"/>  编辑资料</a></li>
            <li role="separator" class="divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <img src="/images/glyphicons-64-power.png" alt="info"/>
                <button class="btn btn-blcok btn-danger" type="submit" name="button">退出</button>
              </form>
            </li>
          </ul>
        </li>
      @endif
      <li><a href="{{ route('help') }}">帮助</a></li>
    </ul>
  </nav>
</header>
