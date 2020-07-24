@extends('app')

@section('title', '管理画面')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="col-2 mt-4">
        <ul>
          <li class="content_list mt-2"><a href="{{ route('admin.index') }}">貸出書籍</a></li>
          <li class="content_list mt-2"><a href="{{ route('admin.user') }}">ユーザー</a></li>
          <li class="content_list mt-2"><a href="{{ route('admin.apply') }}">申請状況</a></li>
        </ul>
      </div>
      <div class="row col-10 mt-4">
        @foreach($books as $book)
          @include('books.card')
        @endforeach
      </div>
    </div>
  </div>
@endsection

<style>
.content_list {
  list-style: none;
}
</style>