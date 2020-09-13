@extends('app')

@section('title', $user->name)

@section('content')

  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex">
          <div>
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
          <div class="ml-auto align-self-end">
            <div class="d-md-inline-block text-right">
              <a href="{{ route('email.modify') }}">メールアドレス変更</a>
            </div>
            <div class="d-md-inline-block ml-3 text-right">
              <a href="{{ route('password.modify') }}">パスワード変更</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- タブリスト -->
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
    </ul>
    <!-- end.タブリスト -->

    <!-- タブ内容 -->
    <div class="tab-content" id="userTabsContent">

      <!-- お気に入り -->
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
      <!-- end.お気に入り -->

      <!-- 予約一覧 -->
      <div
        class="tab-pane fade"
        id="nav-bookings"
        role="tabpanel"
        aria-labelledby="nav-bookings-tab"
      >

        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">書籍名</th>
              <th scope="col">貸出日</th>
              <th scope="col">返却日</th>
              <th scope="col">状態</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <!-- 一覧を表示 -->
            @foreach($books_booking as $book)
            <tr class="border-bottom border-primary">
              <td class="align-middle py-0">{{ str_limit($book->title, 60, '...') }}</td>
              <td class="align-middle py-0">{{ $book->pivot->booking_date_from }}</td>
              <td class="align-middle py-0">{{ $book->pivot->booking_date_to }}</td>
              @if($book->pivot->status === 0)
                <td class="align-middle py-0">未承認</td>
              @else
                <td class="align-middle py-0">承認済</td>
              @endif
              <td class="align-middle py-0 text-right">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-cancel-{{ $book->pivot->id }}">キャンセル</button>

                <!-- 削除モーダル -->
                  @component('components.dialog', ['id' => 'modal-cancel-'.$book->pivot->id])
                  @slot('body')
                    <form method="POST" action="{{ route('bookings.cancel', ['booking' => $book->pivot->id]) }}">
                      @csrf
                      <!-- methodフィールド：postメソッドではなくdeleteメソッドとして解釈 -->
                      @method('DELETE')
                      <div class="modal-body text-left">
                        予約をキャンセルします。よろしいですか？
                      </div>
                      <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-grey" data-dismiss="modal">やめる</a>
                        <button type="submit" class="btn btn-danger">キャンセルする</button>
                      </div>
                    </form>
                  @endslot
                @endcomponent
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
      <!-- end.予約一覧 -->

      <!-- 貸出履歴 -->
      <div
        class="tab-pane fade"
        id="nav-history"
        role="tabpanel"
        aria-labelledby="nav-history-tab"
      >
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">書籍名</th>
              <th scope="col">貸出日</th>
              <th scope="col">返却日</th>
            </tr>
          </thead>
          <tbody>
            <!-- 一覧を表示 -->
            @foreach($books_history as $book)
            <tr class="border-bottom border-primary">
              <td class="align-middle py-0">{{ str_limit($book->title, 60, '...') }}</td>
              <td class="align-middle py-0">{{ $book->pivot->booking_date_from }}</td>
              <td class="align-middle py-0">{{ $book->pivot->booking_date_to }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- end.貸出履歴 -->
    </div>
    <!-- end.タブ内容 -->
  </div>
@endsection
