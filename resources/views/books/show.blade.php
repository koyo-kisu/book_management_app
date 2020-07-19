@extends('app')

@section('title', '詳細画面')

@section('content')
@include('nav')
<div class="container">
  <div class="row mb-5 mt-3">
    @include('books.detail')
  </div>

  <!-- ここからmodal -->
  @component('components.dialog', ['id' => 'modal-booking-'.$book->id])
  @slot('title')
  予約申請
  @endslot
  @slot('body')
  <form method="POST" action="{{ route('bookings.store') }}">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <div class="modal-body mx-3">
      <booking-date-input />
      <div class="md-form mb-5">
        <input type="text" name="start_on" value="2020-07-20">
      </div>
      <div class="md-form mb-5">
        <input type="text" name="end_on" value="2020-07-26">
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
      <button type="submit" class="btn btn-primary">予約する</button>
    </div>
  </form>
  @endslot
  @endcomponent
  <!-- ここまでmodal -->

</div>
@endsection
