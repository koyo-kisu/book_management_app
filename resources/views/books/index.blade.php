@extends('app')

@section('title', 'メイン画面')

@section('content')
  <div class="container">
    <div class="mt-4">
      <!-- ログイン済み管理者用 -->
      @auth('admin')
        <ul class="list-group list-group-horizontal">
          <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('books.index') }}">貸出書籍</a></li>
          <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('users.index') }}">ユーザー</a></li>
          <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('bookings.index') }}">申請状況</a></li>
        </ul>
      @endauth
    </div>
    <div class="row mb-5 mt-3">
      <div class="col-12 col-md-6 offset-md-6">
        <form action="{{ route('books.index') }}" method="GET">
          <label for="search-book-title">書籍名を検索</label>
          <div class="input-group mb-3">
            <input id="search-book-title" type="text" name="title" value="{{ $query }}"
              class="form-control" placeholder="例　独習 PHP" aria-describedby="button-search">
            <div class="input-group-append">
              <button class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="button-search">検索</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12">
        <div class="text-right">
          @if ($books->count())
            {{ $books->count() }}件見つかりました。
          @else
            書籍が見つかりませんでした。
          @endif
        </div>
      </div>
    </div>
    <div class="row mb-5">
      @foreach($books as $book)
        @include('books.card')
      @endforeach
    </div>
  </div>
@endsection
