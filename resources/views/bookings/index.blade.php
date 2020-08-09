@extends('app')

@section('title', '申請一覧')

@section('content')
<div class="container">

  <div class="mt-4">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('books.index') }}">貸出書籍</a></li>
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('users.index') }}">ユーザー</a></li>
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('bookings.index') }}">申請状況</a></li>
    </ul>
  </div>
  
  <!-- ページネーションの情報 -->
  <div class="mt-3 text-right">
    {{ $applies->firstItem() }} - {{ $applies->lastItem() }} / {{ $applies->total() }}件
  </div>


  <div>
    <table class="table table-borderless">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">ユーザー名</th>
          <th scope="col">書籍名</th>
          <th scope="col">貸出日</th>
          <th scope="col">状態</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <!-- ユーザー一覧を表示 -->
        @foreach($applies as $apply)
        <tr class="border-bottom border-primary">
          <th scope="row" class="align-middle py-0">
            <i class="fas fa-user text-primary"></i>
          </th>
          <td class="align-middle py-0">{{ $apply->user->name }}</td>
          <td class="align-middle py-0">{{ str_limit($apply->book->title, 60, '...') }}</td>
          <td class="align-middle py-0">{{ $apply->booking_date_from }}</td>
          @if($apply->is_approved === 0)
            <td class="align-middle py-0">未承認</td>
          @else
            <td class="align-middle py-0">承認済</td>
          @endif
          <td class="align-middle py-0 text-right">
            <a href="{{ route('bookings.show') }}">
              <button type="button" class="btn btn-outline-primary btn-sm">詳細</button>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>

    <!-- ページネーション -->
    <div>
      {{ $applies->links() }}
    </div>
  </div>
</div>
@endsection
