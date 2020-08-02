@extends('app')

@section('title', $user->name)

@section('content')

  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex flex-row">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-3x"></i>
          </a>
        </div>
        <h2 class="h5 card-title m-0">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
          </a>
        </h2>
      </div>
    </div>
    <ul class="nav nav-tabs nav-justified mt-3" id="userTabs" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link text-muted active"
          id="likes-tab"
          data-toggle="tab"
          role="tab"
          aria-controls="likes"
          aria-selected="true"
          href="#nav-likes"
        >
          いいね
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link text-muted"
          id="history-tab"
          data-toggle="tab"
          role="tab"
          aria-controls="history"
          aria-selected="false"
          href="#nav-history"
        >
          貸出履歴
        </a>
      </li>
      <li class="nav-item">
        <div
          class="nav-link text-muted"
          id="bookings-tab"
          data-toggle="tab"
          role="tab"
          aria-controls="bookings"
          aria-selected="false"
          href="#nav-bookings"
        >
          予約一覧
        </div>
      </li>
    </ul>
    <div class="tab-content" id="userTabsContent">
      <div
        class="tab-pane fade show active"
        id="nav-likes"
        role="tabpanel"
        aria-labelledby="nav-likes-tab"
      >
        <div class="row mb-5 mt-3">
          @foreach($books_like as $book)
            @include('books.card')
          @endforeach
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="nav-history"
        role="tabpanel"
        aria-labelledby="nav-history-tab"
      >
        <div class="row mb-5 mt-3">
          @foreach($books_booking as $book)
            @include('books.card')
          @endforeach
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="nav-bookings"
        role="tabpanel"
        aria-labelledby="nav-bookings-tab"
      >
        <div class="row mb-5 mt-3">
        @foreach($books_history as $book)
          @include('books.card')
        @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
