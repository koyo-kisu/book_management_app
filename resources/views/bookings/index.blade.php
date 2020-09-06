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

  <div class="row mb-5 mt-3">
    <div class="col-12 col-md-6 offset-md-6">
      <form action="{{ route('bookings.index') }}" method="GET">
        <label for="search-book-id">ID検索</label>
        <div class="input-group mb-3">
        <input id="search-book-id" type="text" name="book_id" value="{{ $query['book_id'] }}"
            class="form-control" placeholder="書籍IDを入力してください" aria-describedby="button-search">
          </div>

          <select name="status">
            <option value="">未選択</option>
            @foreach (config('master.status') as $key => $value)
              <option value="{{$key}}" @if($query['status'] === (string)$key) selected @endif>{{$value}}</option>
            @endforeach
          </select>

          <div class="input-group-append">
            <button class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="button-search">検索</button>
          </div>
      </form>
    </div>
  </div>

    <table class="table table-borderless">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">ユーザー名</th>
          <th scope="col">書籍ID</th>
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
          <td class="align-middle py-0">{{ $apply->book->id }}</td>
          <td class="align-middle py-0">{{ str_limit($apply->book->title, 60, '...') }}</td>
          <td class="align-middle py-0">{{ $apply->booking_date_from->format('Y年m月d日') }}</td>
          @if($apply->status === 0)
            <td class="align-middle py-0">未承認</td>
          @elseif($apply->status === 1)
            <td class="align-middle py-0">承認済</td>
          @elseif($apply->status === 2)
            <td class="align-middle py-0">貸出中</td>
          @else
            <td class="align-middle py-0">返却済</td>
          @endif
          <td class="align-middle py-0 text-right">
            <a href="{{ route('bookings.show', ['booking' => $apply]) }}">
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
