@extends('app')

@section('title', 'パスワード再設定')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">パスワード再設定</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input class="form-control" type="hidden" id="token" name="token" required readonly value="{{ $token }}">

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="email" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="password">メールアドレス</label>
                  <input class="form-control" type="password" id="password" name="password" required value="{{ old('password') }}">
                </div>

                <div class="md-form">
                  <label for="password_confirmation">メールアドレス（再入力）</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required value="{{ old('password_confirmation') }}">
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">送信</button>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
