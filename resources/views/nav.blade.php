<nav class="navbar navbar-expand">
  <a href="/">BOOKSHELF-APP</a>
  <ul class="navbar-nav ml-auto">
    <!-- 未ログインユーザー用 -->
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    <!-- 未ログインユーザー用 -->
    @guest
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest
      
    <!-- ログイン済みユーザー用 -->
    @auth
    <li class="nav-item">
      <a class="nav-link" href=""><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth
    
    <!-- ログイン済みユーザー用 -->
    @auth
    <!-- ここからDropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href=''">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- ここまでDropdown -->
    @endauth
  </ul>
</nav>