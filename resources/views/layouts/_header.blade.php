<header>
      <ul>
        <li class="col-md-3">
          <a href="{{ route('home') }}">
            <img id="logo" src="images/icon.ico" alt="主页" />
          </a>
          <span id="sitename" >电镀模拟系统</span>
        </li>
      <li class="col-md-9">
<!--
        <div class="navbar-toggle ">
          @if (false)
            <li>
              <span class=caret>{{ $user->name }}</span>

            </li>
          @endif
        </div>
-->
            <div>
              <a href="{{ route('help') }}">
                帮助
              </a>
            </div>
        </li>
      </ul>
</header>