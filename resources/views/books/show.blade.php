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
    <booking-date-input
      endpoint="{{ route('bookings.store') }}"
      token="{{ csrf_token() }}"
      book-id="{{ $book->id }}"
      :bookings='@json($bookings ?? [])'
    />
  @endslot
  @endcomponent
  <!-- ここまでmodal -->

</div>
@endsection
