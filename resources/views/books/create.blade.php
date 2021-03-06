@extends('app')

@section('title', '本の登録')

@section('content')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body pt-0">
        @include('error_card_list')
        <div class="card-text">
          <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" >
            @include('books.form')
            <button type="submit" class="btn blue-gradient btn-block">登録する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
