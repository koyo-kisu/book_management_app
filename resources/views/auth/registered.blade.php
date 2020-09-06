@extends('app')

@section('title', '仮登録完了')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">仮登録完了</h2>

            <div class="card-text">
              <div>
                <p>ご登録ありがとうございます。</p>
                <p>
                  ご本人様確認のため、ご登録いただいたメールアドレスに<br>
                  メール認証のご案内が届きます。
                </p>
                <p>
                  メール内のURLにアクセスし、認証を完了させてください。
                </p>
              </div>

              <div>
                <p>
                  メールが届かない方は、お手数ですが<br>
                  メールアドレスをご確認の上、最初からやり直してください。
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
