@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
</div>
<div class="md-form">
  <label>著者名</label>
  <input type="text" name="author" class="form-control" value="{{ old('author') }}">
</div>
<div class="md-form">
  <label>出版社</label>
  <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
</div>
<div class="md-form">
  <label>表紙画像</label>
  <input type="text" name="book_image" class="form-control" value="{{ old('book_image') }}">
</div>
<div class="md-form">
  <input type="radio" name="state" class="form-control" value="1" checked="checked">貸出できます
  <input type="radio" name="state" class="form-control" value="2">貸出できません
</div>
<div class="form-group">
  <label>本の情報</label>
  <textarea name="description" required class="form-control" rows="16" placeholder="この書籍の説明">{{ old('description') }}</textarea>
</div>