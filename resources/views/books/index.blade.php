@extends('app')

@section('title', 'メイン画面')

@section('content')
<div class="container">
  @foreach($books as $book)
    <p>タイトル</p>
    <div>{{ $book->title }}</div>
    <p>著者名</p>
    <div>{{ $book->author }}</div>
    <p>出版社名</p>
    <p>{{ $book->description }}</p>
    <p></p>
  @endforeach
</div>
@endsection