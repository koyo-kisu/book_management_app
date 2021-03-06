<!-- ここから表紙画像 -->
<div class="col-lg-4">
  <p>
    @if(!empty($book->book_image))
      <div class="image-wrapper">
        <a href="{{ asset('storage/images/' . $book->book_image ) }}" class="image-responsive" target="_blank" rel="noopener noreferrer">
          <img src="{{ asset('storage/images/' . $book->book_image ) }}" alt="image" class="card-img-top image-fit">
        </a>
      </div>
    @else
      <div class='image-wrapper'>
        <div class="image-responsive">
          <img src="http://placehold.it/200x270" alt="ダミー画像" class="card-img-top image-fit">
        </div>
      </div>
    @endif
  </p>
</div>
<!-- ここまで表紙画像 -->

<!-- ここから詳細情報 -->
<div class="col-lg-8 col-md-12 mb-lg-0">
  @auth('admin')
    <!-- ここからdropdown -->
    <div class="ml-auto card-text text-right">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-link text-muted m-0 p-2">
            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route("books.edit", ['book' => $book]) }}">
            <i class="fas fa-pen mr-1"></i>記事を更新する
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $book->id }}">
            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
          </a>
        </div>
      </div>
    </div>
    <!-- ここまでdropdown -->

    <!-- ここからmodal -->
    @component('components.dialog', ['id' => 'modal-delete-'.$book->id])
      @slot('body')
        <form method="POST" action="{{ route('books.destroy', ['book' => $book]) }}">
            @csrf
            <!-- methodフィールド：postメソッドではなくdeleteメソッドとして解釈 -->
            @method('DELETE')
            <div class="modal-body">
            {{ $book->title }}を削除します。よろしいですか？
            </div>
            <div class="modal-footer justify-content-between">
            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
            <button type="submit" class="btn btn-danger">削除する</button>
            </div>
        </form>
      @endslot
    @endcomponent
    <!-- ここまでmodal -->
  @endauth
  <div class="mt-3">
    <h4 class="border-bottom">タイトル</h4>
    <div class="mb-5">{{ $book->title }}</div>

    <h4 class="border-bottom">著者</h4>
    <div class="mb-5">{{ $book->author }}</div>

    <h4 class="border-bottom">出版社</h4>
    <div class="mb-5">{{ $book->publisher }}</div>

    <h4 class="border-bottom">タグ</h4>
    <div class="mb-5">
      @foreach($book->tags as $tag)
        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
          {{ $tag->hashtag }}
        </a>
      @endforeach
    </div>

    <h4 class="border-bottom">詳細</h4>
    <div class="detail_text mb-5 text-break">{{ $book->description }}</div>

    <h4 class="border-bottom">予約状況</h4>
    <div class="bookings-scroll-area mb-5">
      @if(count($user_bookings))
      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">貸出日</th>
            <th scope="col">返却日</th>
            <th scope="col">ユーザー名</th>
          </tr>
        </thead>
        <tbody>
          <!-- 一覧を表示 -->
          @foreach ($user_bookings as $user_booking)
          <tr class="border-bottom border-primary">
            <td class="align-middle py-0">
              {{ date('Y年m月d日', strtotime($user_booking->pivot->booking_date_from)) }}
            </td>
            <td class="align-middle py-0">
              {{ date('Y年m月d日', strtotime($user_booking->pivot->booking_date_to)) }}
            </td>
            <td class="align-middle py-0">
              @auth('admin')
                <a href="{{ route('users.show', ['name' => $user_booking->name]) }}">{{ $user_booking->name }}</a>
              @else
                <span>{{ $user_booking->name }}</span>
              @endauth
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <p>予約がありません。</p>
      @endif
    </div>


    @auth('user')
      <div>
          <button type="button" class="btn btn-teal btn-rounded btn-sm m-0" data-toggle="modal" data-target="#modal-booking-{{ $book->id }}">予約する</button>
      </div>
    @endauth
  </div>
</div>
<!-- ここまで詳細情報 -->
