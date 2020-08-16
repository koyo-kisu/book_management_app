@extends('app')

@section('title', '登録情報更新')

@section('content')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body pt-0">
        @include('error_card_list')
        <div class="card-text">
          <!-- updateアクションに変数bookを渡す -->
          <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" enctype="multipart/form-data">
            <!-- methodフィールド：postメソッドではなくpatchメソッドとして解釈 -->
            @method('PATCH')
            @include('books.form')
            <button type="submit" class="btn blue-gradient btn-block">更新する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
