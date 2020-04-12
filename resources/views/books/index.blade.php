@extends('app')

@section('title', 'メイン画面')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($books as $book)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
        <h3 class="h4 card-title">
          {{ $book->title }}
        </h3>

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
        </div>
        <!-- ここまでmodal -->

        <div class="card-body pt-0">
          <div class="card-text">
            <div>{{ $book->author }}</div>
            <div>{{ $book->publisher }}</div>
            <div>{{ $book->description }}</div>
            <div>{{ $book->book_image }}</div>
            @if( $book->state === "1" )
              <div>貸出可能</div>
            @else
              <div>貸出不可能</div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection