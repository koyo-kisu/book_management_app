<!-- ここから表紙画像 -->
<div class="col-lg-4">
  <p>
    @if(!empty($book->book_image))
      <div class="image-wrapper">
        <img src="{{ asset('storage/images' . $book->book_image ) }}" alt="image" class="card-img-top">        
      </div>
    @else
      <div class='image-wrapper'>
        <img src="http://placehold.it/200x270" alt="ダミー画像">
      </div>
    @endif
  </p>
</div>
<!-- ここまで表紙画像 -->

<!-- ここから詳細情報 -->
<div class="col-lg-8 col-md-12 mb-lg-0">
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
        <a href="" class="border p-1 mr-1 mt-1 text-muted">
          {{ $tag->name }}
        </a>
      @endforeach
    </div>
    
    <h4 class="border-bottom">詳細</h4>
    <div class="detail_text mb-5 text-break">{{ $book->description }}</div>
    
    <h4 class="border-bottom">貸出状況</h4>
    <div>
      @if( $book->state === "1" )
        <button type="button" class="btn btn-teal btn-rounded btn-sm m-0">予約する</button>
      @else
        <button type="button" class="btn btn-teal btn-rounded btn-sm m-0" disabled>予約できません</button>
      @endif
    </div>
  </div>
</div>
<!-- ここまで詳細情報 -->