@extends('app')

@section('title', 'パスワードを忘れた方')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">パスワードを忘れた方</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div>
                  <p>ご入力いただいたメールアドレスに、パスワード再設定用のメールが送信されます。</p>
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
