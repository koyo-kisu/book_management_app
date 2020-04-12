@csrf
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
<div class="md-form">
  <label>表紙画像</label>
  <input type="text" name="book_image" class="form-control" value="{{ $book->book_image ?? old('book_image') }}">
</div>
<div class="md-form">
  <input type="radio" name="state" class="form-control" value="1">貸出できます
  <input type="radio" name="state" class="form-control" value="2">貸出できません
</div>
<div class="form-group">
  <label>本の情報</label>
  <textarea name="description" class="form-control" rows="16" placeholder="この書籍の説明">{{ $book->description ?? old('description') }}</textarea>
</div>