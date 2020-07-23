<nav class="navbar navbar-expand">
  <!-- 未ログインユーザー用 -->
  @guest
    <a href="/">BOOKSHELF-APP</a>
  @endguest

  <!-- ログイン済みユーザー用 -->
  @auth('user')
    <a href="/">BOOKSHELF-APP</a>
  @endauth

  <!-- ログイン済み管理者用 -->
  @auth('admin')
    <a href="{{ route('admin.index') }}">BOOKSHELF-APP</a>
  @endauth

  <ul class="navbar-nav ml-auto">
    <!-- 未ログインユーザー用 -->
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth('admin')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('books.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth
    <!-- ログイン済みユーザー用 -->
    @auth('user')
    <!-- ここからDropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
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

   <!-- ログイン済み管理者用 -->
    @auth('admin')
    <li class="content_list mb-2 mt-2">
      <form id="logout-button" method="POST" action="{{ route('admin.logout') }}">
        <button form="logout-button" type="submit">ログアウト</button>
        @csrf
      </form>
    </li>
    @endauth

  </ul>
</nav>