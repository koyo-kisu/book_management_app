@extends('app')

@section('title', 'パスワード変更')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">パスワード変更</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('password.modify') }}">
                @csrf

                <div class="mb-5">
                  <div class="md-form">
                    <label for="current_password">現在のパスワード</label>
                    <input class="form-control" type="password" id="current_password" name="current_password" required>
                  </div>
                </div>

                <div class="md-form">
                  <label for="password">変更後パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <div class="md-form">
                  <label for="password_confirmation">変更後パスワード(再入力)</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">変更する</button>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
