@extends('app')

@section('title', '詳細画面')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row mb-5 mt-3">
      @include('books.detail')  
    </div>
  </div>
@endsection