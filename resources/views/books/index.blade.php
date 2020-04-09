@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($books as $book)
      <div class="card mt-3">
        <div class="card-body flex-row">
          <p>タイトル</p>
          <div>{{ $book->title }}</div>
          <p>著者名</p>
          <div>{{ $book->author }}</div>
          <p>出版社名</p>
          <p>{{ $book->description }}</p>
          <p></p>
        </div>
      </div>
    @endforeach
  </div>
@endsection