@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row mb-5 mt-3">
      @foreach($books as $book)
        @include('books.card')
      @endforeach
    </div>
  </div>
@endsection