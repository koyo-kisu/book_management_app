<!-- ここからCardColumn -->
<div class="col-lg-4 col-md-12 mb-lg-0 mb-4">
  
  <!-- ここからCard -->
  <div class="card card-cascade wider card-ecommerce mb-4">

    <!-- ここからCardImage -->
    <div class="view view-cascade overlay">
      
      <!-- /public/storage配下に保存している画像を表示 -->
      @if(!empty($book->book_image))
      <div class="image-wrapper">
        <img src="{{ asset('storage/images' . $book->book_image ) }}" alt="image" class="card-img-top">        
      </div>
      @else
      <div class='image-wrapper'>
        <img src="http://placehold.it/289.98x200" alt="ダミー画像">
      </div>
      @endif

    </div>
    <!-- ここまでCardImage -->

    <!-- 管理者にのみ表示させるアイコンなので、ユーザー判定が今後必要 -->
    <!-- ここからdropdown -->
    <div class="ml-auto card-text">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-link text-muted m-0 p-2">
            <i class="fas fa-ellipsis-v"></i>
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
    <div id="modal-delete-{{ $book->id }}" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">×</span>
            </button>
          </div>
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
        </div>
      </div>
    </div>
    <!-- ここまでmodal -->

    <!-- ここからCardContent -->
    <div class="card-body card-body-cascade text-center">
      <p class="card-title">
        <a class="text-dark" href="{{ route('books.show', ['book' => $book]) }}">
          {{ $book->title }}
        </a>
      </p>

      <!-- ここからCardText -->
      <div class="card-text">
        <div>{{ $book->author }}</div>
        <!-- @if( $book->state === "1" )
          <div>貸出可能</div>
        @else
          <div>貸出不可能</div>
        @endif -->

        <hr>
        <span class="float-left mt-3">
          <i class="fas fa-heart ml-1">10</i>
        </span>
        <span class="float-right mt-3">
          <p>予約する</p>
        </span>
      </div>
      <!-- ここまでCardText -->
    </div>
    <!-- ここまでCardContent -->
  </div>
  <!-- ここまでCard -->
</div>
<!-- ここまでCardColumn -->