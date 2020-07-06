@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
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
