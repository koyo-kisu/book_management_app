@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
</div>
<div class="md-form">
  <label>著者名</label>
  <input type="text" name="title" class="form-control" required value="{{ old('author') }}">
</div>
<div class="md-form">
  <label>出版社</label>
  <input type="text" name="title" class="form-control" required value="{{ old('publisher') }}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="この書籍の説明">{{ old('description') }}</textarea>
</div>