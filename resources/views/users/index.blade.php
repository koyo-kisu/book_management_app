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
            <td class="align-middle py-0">{{ $user->name }}</td>
            <td class="align-middle py-0">{{ $user->email }}</td>
            <td class="align-middle py-0 text-right">
              <button type="button" class="btn btn-outline-primary btn-sm">削除</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
