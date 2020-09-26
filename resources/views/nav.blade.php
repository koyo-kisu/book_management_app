<nav class="navbar navbar-expand">
  @if(auth('admin'))
    <a href="{{ route('books.index') }}">BOOKSHELF-APP</a>
  @elseif(auth('user'))
    <a href="/">BOOKSHELF-APP</a>
  @else
    <a href="/">BOOKSHELF-APP</a>
  @endif

  <ul class="navbar-nav ml-auto">
    @auth('admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('books.create') }}"><i class="fas fa-pen mr-1"></i><span class="d-none d-md-inline">投稿する</span></a>
      </li>
      <li class="content_list">
        <form id="logout-button" method="POST" action="{{ route('admin.logout') }}">
          <button form="logout-button" type="submit" class="btn btn-outline-dark btn-sm">ログアウト</button>
          @csrf
        </form>
      </li>

    @elseauth('user')
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

    @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endauth
  </ul>
</nav>
