@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
          <div class="card-text text-right">
            {{ $tag->books->count() }}件見つかりました
          </div>
      </div>
    </div>
    <div class="row mb-5 mt-3">
      @foreach($tag->books as $book)
        @include('books.card')
      @endforeach
    </div>
  </div>
@endsection