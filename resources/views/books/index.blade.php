@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($books as $book)
      <div class="card mt-3">
        <div class="card-body flex-row">
          <p>【タイトル】</p>
          <div>{{ $book->title }}</div>
          <p>【著者名】</p>
          <div>{{ $book->author }}</div>
          <p>【出版社名】</p>
          <p>{{ $book->publisher }}</p>
          <p>【本の情報】</p>
          <p>{{ $book->description }}</p>
          <p>【本の表紙画像】</p>
          <p>{{ $book->book_image }}</p>
          <p>【本の状態】</p>
          @if( $book->state === "1" )
            <p>貸出可能</p>
          @else
            <p>貸出不可能</p>
          @endif
        </div>
      </div>
    @endforeach
  </div>
@endsection