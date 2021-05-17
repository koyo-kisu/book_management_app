@extends('app')

@section('title', 'ユーザー一覧')

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
    {{ $users->firstItem() }} - {{ $users->lastItem() }} / {{ $users->total() }}件
  </div>

  <div>
    <div class="table-scroll-wrapper">
      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">ユーザー名</th>
            <th scope="col">メールアドレス</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <!-- ユーザー一覧を表示 -->
          @foreach($users as $user)
          <tr class="border-bottom border-primary">
            <th scope="row" class="align-middle py-0">
              <i class="fas fa-user text-primary"></i>
            </th>
            <td class="align-middle py-0">
              <a href="{{ route('users.show', ['name' => $user->name]) }}">{{ $user->name }}</a>
            </td>
            <td class="align-middle py-0">{{ $user->email }}</td>
            <td class="align-middle py-0 text-right">
              <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">削除</button>

              <!-- 削除モーダル -->
                @component('components.dialog', ['id' => 'modal-delete-'.$user->id])
                @slot('body')
                  <form method="POST" action="{{ route('users.destroy', ['name' => $user->name]) }}">
                    @csrf
                    <!-- methodフィールド：postメソッドではなくdeleteメソッドとして解釈 -->
                    @method('DELETE')
                    <div class="modal-body text-left">
                      {{ $user->name }}を削除します。よろしいですか？
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                      <button type="submit" class="btn btn-danger">削除する</button>
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

    <!-- ページネーション -->
    <div>
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection
