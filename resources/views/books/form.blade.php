@csrf
<div class="row">
  <div class="col-lg-4">
    <book-image-input
      :img-src='@json(isset($img_src) ? $img_src : "")'
    />
  </div>

  <div class="col-lg-8">
    <div class="md-form">
      <label>タイトル</label>
      <input type="text" name="title" class="form-control" required value="{{ $book->title ?? old('title') }}">
    </div>
    <div class="md-form">
      <label>著者名</label>
      <input type="text" name="author" class="form-control" value="{{ $book->author ?? old('author') }}">
    </div>
    <div class="md-form">
      <label>出版社</label>
      <input type="text" name="publisher" class="form-control" value="{{ $book->publisher ?? old('publisher') }}">
    </div>
    <div class="form-group">
      <article-tags-input
        :initial-tags='@json($tagNames ?? [])'
        :autocomplete-items='@json($allTagNames ?? [])'
      >
      </article-tags-input>
    </div>
    <div class="form-group">
      <label>本の情報</label>
      <textarea name="description" class="form-control" rows="16" placeholder="この書籍の説明">{{ $book->description ?? old('description') }}</textarea>
    </div>
  </div>
</div>
