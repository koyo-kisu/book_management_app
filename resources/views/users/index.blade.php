@extends('app')

@section('title', 'メイン画面')

@section('content')
@include('nav')
<div class="container">
  <div class="row mb-5 mt-3">
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
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $user->name }}">削除</button>

            <!-- 削除モーダル -->
            @component('components.dialog', ['id' => 'modal-delete-'.$user->name])
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
            @endcomponent
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
