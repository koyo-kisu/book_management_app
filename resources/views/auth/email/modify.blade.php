@extends('app')

@section('title', 'メールアドレス変更')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">メールアドレス変更</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('email.modify') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="email_confirmation">メールアドレス(再入力)</label>
                  <input class="form-control" type="text" id="email_confirmation" name="email_confirmation" required value="{{ old('email_confirmation') }}">
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
