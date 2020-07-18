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
  @csrf
  @slot('title')
  予約申請
  @endslot
  @slot('body')
  <form method="POST" action="">
    <div class="modal-body mx-3">
      <div class="md-form mb-5">
        <input type="text" name="start_on" value="2020-07-20">
      </div>
      <div class="md-form mb-5">
        <input type="text" name="end_on" value="2020-07-26">
      </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
      <button class="btn btn-default">submit</button>
    </div>
  </form>
  @endslot
  @endcomponent
  <!-- ここまでmodal -->

</div>
@endsection
