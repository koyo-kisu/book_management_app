@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($books as $book)
      @include('books.card')
    @endforeach
  </div>
@endsection