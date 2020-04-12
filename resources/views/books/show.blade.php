@extends('app')

@section('title', '本の詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('books.card')
  </div>
@endsection