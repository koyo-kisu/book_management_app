@extends('app')

@section('title', '予約詳細画面')

@section('content')
<div class="container">

  <div class="mt-4">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('books.index') }}">貸出書籍</a></li>
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('users.index') }}">ユーザー</a></li>
      <li class="list-group-item list-group-item-action text-center col-4"><a href="{{ route('bookings.index') }}">申請状況</a></li>
    </ul>
  </div>

  <div class="mt-4">
    <div class="card">
      <div class="card-body">
        <p class="border-bottom">ユーザー名</p>
        <h5 class="card-text">{{ $bookings->user->name }}</h5>
        
        <p class="border-bottom mt-4">タイトル</p>
        <h5 class="card-text">{{ $bookings->book->title }}</h5>

        <p class="border-bottom mt-4">貸出日</p>
        <h5 class="card-text">{{ $booking_start }}</h5>

        <p class="border-bottom mt-4">返却日</p>
        <h5 class="card-text">{{ $booking_end }}</h5>

        <p class="border-bottom mt-4">申請日</p>
        <h5 class="card-text">{{ $booking_created_date }}</h5>
        
        <form method="POST" action="{{ route('bookings.approve', ['bookings' => $bookings]) }}">
          @method('PATCH')
          <p class="mt-4">備考</p>
          <textarea name="reply_comment" cols="100" class="form-control" rows="5"></textarea>
        </form>
        <div>
          <!-- 未承認 -->
          @if($bookings->is_approved === 0)
            <button href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
              取消
            </button>

            <!-- ここからModal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $bookings->user->name }}さんの予約を本当に取り消しますか？</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark" data-dismiss="modal">キャンセル</button>
                      <button type="button" class="btn btn-outline-danger">取消実行</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- ここまでModal -->

            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#acceptModal">
              承認
            </button>

            <!-- ここからModal -->
            <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $bookings->user->name }}さんの予約を本当に承認しますか？</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-outline-primary">承認</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- ここまでModal -->


          <!-- 承認済 -->
          @else
            <button type="button" class="btn btn-outline-dark" disable>承認済</button>
          @endif
        </div>

      </div>
      <!-- ここまでcard-body -->
    </div>
    <!-- ここまでcard -->
  </div>
  <!-- ここまでmt-4 -->
</div>
<!-- ここまでcontainer -->
@endsection
